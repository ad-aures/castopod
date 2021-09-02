<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Install\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Config\Services;
use Dotenv\Dotenv;
use Dotenv\Exception\ValidationException;
use Modules\Auth\Entities\User;
use Psr\Log\LoggerInterface;
use Throwable;
use ViewThemes\Theme;

class InstallController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['form', 'components', 'svg'];

    /**
     * Constructor.
     */
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
                $dotenv->required(['app.baseURL', 'admin.gateway', 'auth.gateway']);
            } catch (ValidationException) {
                // form to input instance configuration
                return $this->instanceConfig();
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
                return $this->databaseConfig();
            }

            try {
                $dotenv->required('cache.handler');
            } catch (ValidationException) {
                return $this->cacheConfig();
            }
        } else {
            try {
                $dotenv->required([
                    'app.baseURL',
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

            // Check if superadmin has been created, meaning migrations and seeds have passed
            if (
                $db->tableExists('users') &&
                (new UserModel())->countAll() > 0
            ) {
                // if so, show a 404 page
                throw PageNotFoundException::forPageNotFound();
            }
        } catch (DatabaseException) {
            // Could not connect to the database
            // show database config view to fix value
            session()
                ->setFlashdata('error', lang('Install.messages.databaseConnectError'));

            return view('database_config');
        }

        // migrate if no user has been created
        $this->migrate();

        // Check if all seeds have succeeded
        $this->seed();

        return $this->createSuperAdmin();
    }

    public function instanceConfig(): string
    {
        return view('instance_config');
    }

    public function attemptInstanceConfig(): RedirectResponse
    {
        $rules = [
            'hostname' => 'required|validate_url',
            'media_base_url' => 'permit_empty|validate_url',
            'admin_gateway' => 'required',
            'auth_gateway' => 'required|differs[admin_gateway]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->to((host_url() === null ? config('App') ->baseURL : host_url()) . config('Install')->gateway)
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $baseUrl = $this->request->getPost('hostname');
        $mediaBaseUrl = $this->request->getPost('media_base_url');
        self::writeEnv([
            'app.baseURL' => $baseUrl,
            'app.mediaBaseURL' =>
                $mediaBaseUrl === '' ? $baseUrl : $mediaBaseUrl,
            'admin.gateway' => $this->request->getPost('admin_gateway'),
            'auth.gateway' => $this->request->getPost('auth_gateway'),
        ]);

        helper('text');

        // redirect to full install url with new baseUrl input
        return redirect()->to(reduce_double_slashes($baseUrl . '/' . config('Install')->gateway));
    }

    public function databaseConfig(): string
    {
        return view('database_config');
    }

    public function attemptDatabaseConfig(): RedirectResponse
    {
        $rules = [
            'db_hostname' => 'required',
            'db_name' => 'required',
            'db_username' => 'required',
            'db_password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        self::writeEnv([
            'database.default.hostname' => $this->request->getPost('db_hostname'),
            'database.default.database' => $this->request->getPost('db_name'),
            'database.default.username' => $this->request->getPost('db_username'),
            'database.default.password' => $this->request->getPost('db_password'),
            'database.default.DBPrefix' => $this->request->getPost('db_prefix'),
        ]);

        return redirect()->back();
    }

    public function cacheConfig(): string
    {
        return view('cache_config');
    }

    public function attemptCacheConfig(): RedirectResponse
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

        self::writeEnv([
            'cache.handler' => $this->request->getPost('cache_handler'),
        ]);

        return redirect()->back();
    }

    /**
     * Runs all database migrations required for instance.
     */
    public function migrate(): void
    {
        $migrations = Services::migrations();

        $migrations->setNamespace('Myth\Auth')
            ->latest();
        $migrations->setNamespace('Modules\Fediverse')
            ->latest();
        $migrations->setNamespace(APP_NAMESPACE)
            ->latest();
        $migrations->setNamespace('Modules\Auth')
            ->latest();
        $migrations->setNamespace('Modules\Analytics')
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
    public function createSuperAdmin(): string
    {
        return view('create_superadmin');
    }

    /**
     * Creates the first superadmin user or redirects back to form if any error.
     *
     * After creation, user is redirected to login page to input its credentials.
     */
    public function attemptCreateSuperAdmin(): RedirectResponse
    {
        $userModel = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = array_merge(
            $userModel->getValidationRules([
                'only' => ['username'],
            ]),
            [
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|strong_password',
            ],
        );

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $user = new User($this->request->getPost());

        // Activate user
        $user->activate();

        $db = db_connect();

        $db->transStart();
        if (! ($userId = $userModel->insert($user, true))) {
            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        // add newly created user to superadmin group
        $authorization = Services::authorization();
        $authorization->addUserToGroup($userId, 'superadmin');

        $db->transComplete();

        // Success!
        // set redirect_url session as admin area to go to after login
        session()
            ->set('redirect_url', route_to('admin'));

        return redirect()
            ->route('login')
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
                function ($line) use ($key, $keyVal, &$replaced) {
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
