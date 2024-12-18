<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Install\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException as ShieldValidationException;
use Config\Database;
use Config\Services;
use Dotenv\Dotenv;
use Dotenv\Exception\ValidationException;
use Modules\Auth\Models\UserModel;
use Override;
use Psr\Log\LoggerInterface;
use Throwable;
use ViewThemes\Theme;

class InstallController extends Controller
{
    /**
     * @var list<string>
     */
    protected $helpers = ['form', 'components', 'svg', 'misc', 'setting'];

    #[Override]
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        Theme::setTheme('install');
    }

    /**
     * Every operation goes through this method to handle the install logic.
     *
     * If all required actions have already been performed, the install route will show a 404 page.
     */
    public function index(): string
    {
        if (! file_exists(ROOTPATH . '.env')) {
            // create empty .env file
            try {
                $envFile = fopen(ROOTPATH . '.env', 'w');
                fclose($envFile);
            } catch (Throwable) {
                // Could not create the .env file, redirect to a view with instructions on how to add it manually
                return view('manual_config');
            }
        }

        // Check if .env has all required fields
        $dotenv = Dotenv::createUnsafeImmutable(ROOTPATH);
        $dotenv->load();

        // Check if the created .env file is writable to continue install process
        if (is_really_writable(ROOTPATH . '.env')) {
            try {
                $dotenv->required(['app.baseURL', 'analytics.salt', 'admin.gateway', 'auth.gateway']);
            } catch (ValidationException) {
                // form to input instance configuration
                return $this->instanceConfigView();
            }

            try {
                $dotenv->required([
                    'database.default.hostname',
                    'database.default.database',
                    'database.default.username',
                    'database.default.password',
                    'database.default.DBPrefix',
                ]);
            } catch (ValidationException) {
                return $this->databaseConfigView();
            }

            try {
                $dotenv->required('cache.handler');
            } catch (ValidationException) {
                return $this->cacheConfigView();
            }
        } else {
            try {
                $dotenv->required([
                    'app.baseURL',
                    'analytics.salt',
                    'admin.gateway',
                    'auth.gateway',
                    'database.default.hostname',
                    'database.default.database',
                    'database.default.username',
                    'database.default.password',
                    'database.default.DBPrefix',
                    'cache.handler',
                ]);
            } catch (ValidationException) {
                return view('manual_config');
            }
        }

        try {
            $db = db_connect();

            // Check if instance owner has been created, meaning install was completed
            if ($db->tableExists('users') && (new UserModel())->where('is_owner', true)
                ->first() instanceof User
            ) {
                // if so, show a 404 page
                throw PageNotFoundException::forPageNotFound();
            }
        } catch (DatabaseException) {
            // Could not connect to the database
            // show database config view to fix value
            session()
                ->setFlashdata('error', lang('Install.messages.databaseConnectError'));

            return $this->databaseConfigView();
        }

        // migrate if no user has been created
        $this->migrate();

        // Check if all seeds have succeeded
        $this->seed();

        return $this->createSuperAdminView();
    }

    public function instanceConfigView(): string
    {
        return view('instance_config');
    }

    public function instanceConfigAction(): RedirectResponse
    {
        $rules = [
            'hostname'       => 'required|valid_url_strict',
            'media_base_url' => 'permit_empty|valid_url_strict',
            'admin_gateway'  => 'required',
            'auth_gateway'   => 'required|differs[admin_gateway]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->to((host_url() ?? config('App') ->baseURL) . config('Install')->gateway)
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $baseUrl = $validData['hostname'];
        $mediaBaseUrl = $validData['media_base_url'];
        self::writeEnv([
            'app.baseURL'    => $baseUrl,
            'media.baseURL'  => $mediaBaseUrl === '' ? $baseUrl : $mediaBaseUrl,
            'analytics.salt' => generate_random_salt(64),
            'admin.gateway'  => $validData['admin_gateway'],
            'auth.gateway'   => $validData['auth_gateway'],
        ]);

        helper('text');

        // redirect to full install url with new baseUrl input
        return redirect()->to(reduce_double_slashes($baseUrl . '/' . config('Install')->gateway));
    }

    public function databaseConfigView(): string
    {
        return view('database_config');
    }

    public function databaseConfigAction(): RedirectResponse
    {
        $rules = [
            'db_hostname' => 'required',
            'db_name'     => 'required',
            'db_username' => 'required',
            'db_password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        self::writeEnv([
            'database.default.hostname' => $validData['db_hostname'],
            'database.default.database' => $validData['db_name'],
            'database.default.username' => $validData['db_username'],
            'database.default.password' => $validData['db_password'],
            'database.default.DBPrefix' => $this->request->getPost('db_prefix'),
        ]);

        return redirect()->back();
    }

    public function cacheConfigView(): string
    {
        return view('cache_config');
    }

    public function cacheConfigAction(): RedirectResponse
    {
        $rules = [
            'cache_handler' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        self::writeEnv([
            'cache.handler' => $validData['cache_handler'],
        ]);

        return redirect()->back();
    }

    /**
     * Runs all database migrations required for instance.
     */
    public function migrate(): void
    {
        $migrate = Services::migrations();

        $migrate->setNamespace(null)
            ->latest();
    }

    /**
     * Runs all database seeds required for instance.
     */
    public function seed(): void
    {
        $seeder = Database::seeder();

        // Seed database
        $seeder->call('AppSeeder');
    }

    /**
     * Returns the form to create a the first superadmin user for the instance.
     */
    public function createSuperAdminView(): string
    {
        return view('create_superadmin');
    }

    /**
     * Creates the first superadmin user or redirects back to form if any error.
     *
     * After creation, user is redirected to login page to input its credentials.
     */
    public function createSuperAdminAction(): RedirectResponse
    {
        // validate user password
        $rules = [
            'username' => 'required',
            'email'    => 'required',
            'password' => 'required|strong_password',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        // Save the user
        $user = new User([
            'username' => $validData['username'],
            'email'    => $validData['email'],
            'password' => $validData['password'],
            'is_owner' => true,
        ]);

        $userModel = new UserModel();
        try {
            $userModel->save($user);
        } catch (ShieldValidationException) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        $user = $userModel->findById($userModel->getInsertID());

        // set newly created user as most powerful instance group (superadmin)
        $user->addGroup(setting('AuthGroups.mostPowerfulGroup'));

        // Success!
        // set redirect_url session as admin area to go to after login
        session()
            ->set('redirect_url', route_to('admin'));

        return redirect()
            ->route('admin')
            ->with('message', lang('Install.messages.createSuperAdminSuccess'));
    }

    /**
     * writes config values in .env file overwrites any existing key and appends new ones
     *
     * @param array<string, string> $configData key/value config pairs
     */
    public static function writeEnv(array $configData): void
    {
        $envData = file(ROOTPATH . '.env'); // reads an array of lines

        foreach ($configData as $key => $value) {
            $replaced = false;
            $keyVal = $key . '="' . $value . '"' . PHP_EOL;
            $envData = array_map(
                static function ($line) use ($key, $keyVal, &$replaced) {
                    if (str_starts_with($line, $key)) {
                        $replaced = true;
                        return $keyVal;
                    }

                    return $line;
                },
                $envData
            );

            if (! $replaced) {
                $envData[] = $keyVal;
            }
        }

        file_put_contents(ROOTPATH . '.env', implode('', $envData));
    }
}
