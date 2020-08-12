<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;
use Dotenv\Dotenv;
use Exception;

class Install extends BaseController
{
    /**
     * Every operation goes through this method to handle
     * the install logic.
     *
     * If all required actions have already been performed,
     * the install route will show a 404 page.
     */
    public function index()
    {
        try {
            // Check if .env is created and has all required fields
            $dotenv = Dotenv::createImmutable(ROOTPATH);

            $dotenv->load();
            $dotenv->required([
                'app.baseURL',
                'app.adminGateway',
                'app.authGateway',
                'database.default.hostname',
                'database.default.database',
                'database.default.username',
                'database.default.password',
                'database.default.DBPrefix',
            ]);
        } catch (\Throwable $e) {
            // Invalid .env file
            return $this->createEnv();
        }

        // Check if database configuration is ok
        try {
            $db = db_connect();

            // Check if superadmin has been created, meaning migrations and seeds have passed
            if (
                $db->tableExists('users') &&
                (new UserModel())->countAll() > 0
            ) {
                // if so, show a 404 page
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // return an error view to
            return view('install/error', [
                'error' => lang('Install.messages.databaseConnectError'),
            ]);
        }

        // migrate if no user has been created
        $this->migrate();

        // Check if all seeds have succeeded
        $this->seed();

        return $this->createSuperAdmin();
    }

    /**
     * Returns the form to generate the .env config file for the instance.
     */
    public function createEnv()
    {
        helper('form');

        return view('install/env');
    }

    /**
     * Verifies that all fields have been submitted correctly and
     * creates the .env file after user submits the install form.
     */
    public function attemptCreateEnv()
    {
        if (
            !$this->validate([
                'hostname' => 'required|valid_url',
                'admin_gateway' => 'required|differs[auth_gateway]',
                'auth_gateway' => 'required|differs[admin_gateway]',
                'db_hostname' => 'required',
                'db_name' => 'required',
                'db_username' => 'required',
                'db_password' => 'required',
            ])
        ) {
            return redirect()
                ->back()
                ->with('errors', $this->validator->getErrors());
        }

        // Create .env file with post data
        try {
            $envFile = fopen(ROOTPATH . '.env', 'w');
            if (!$envFile) {
                throw new Exception('File open failed.');
            }

            $envMapping = [
                [
                    'key' => 'app.baseURL',
                    'value' => $this->request->getPost('hostname'),
                ],
                [
                    'key' => 'app.adminGateway',
                    'value' => $this->request->getPost('admin_gateway'),
                ],
                [
                    'key' => 'app.authGateway',
                    'value' => $this->request->getPost('auth_gateway'),
                ],
                [
                    'key' => 'database.default.hostname',
                    'value' => $this->request->getPost('db_hostname'),
                ],
                [
                    'key' => 'database.default.database',
                    'value' => $this->request->getPost('db_name'),
                ],
                [
                    'key' => 'database.default.username',
                    'value' => $this->request->getPost('db_username'),
                ],
                [
                    'key' => 'database.default.password',
                    'value' => $this->request->getPost('db_password'),
                ],
                [
                    'key' => 'database.default.DBPrefix',
                    'value' => $this->request->getPost('db_prefix'),
                ],
            ];

            foreach ($envMapping as $envVar) {
                if ($envVar['value']) {
                    fwrite(
                        $envFile,
                        $envVar['key'] . '="' . $envVar['value'] . '"' . PHP_EOL
                    );
                }
            }

            return redirect()->back();
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        } finally {
            fclose($envFile);
        }
    }

    /**
     * Runs all database migrations required for instance.
     */
    public function migrate()
    {
        $migrations = \Config\Services::migrations();

        if (
            !$migrations->setNamespace('Myth\Auth')->latest() or
            !$migrations->setNamespace(APP_NAMESPACE)->latest()
        ) {
            return view('install/error', [
                'error' => lang('Install.messages.migrationError'),
            ]);
        }
    }

    /**
     * Runs all database seeds required for instance.
     */
    public function seed()
    {
        try {
            $seeder = \Config\Database::seeder();

            // Seed database
            $seeder->call('AppSeeder');
        } catch (\Throwable $e) {
            return view('install/error', [
                'error' => lang('Install.messages.seedError'),
            ]);
        }
    }

    /**
     * Returns the form to create a the first superadmin user for the instance.
     */
    public function createSuperAdmin()
    {
        helper('form');

        return view('install/superadmin');
    }

    /**
     * Creates the first superadmin user or redirects back to form if any error.
     *
     * After creation, user is redirected to login page to input its credentials.
     */
    public function attemptCreateSuperAdmin()
    {
        $userModel = new UserModel();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = array_merge(
            $userModel->getValidationRules(['only' => ['username']]),
            [
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|strong_password',
            ]
        );

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $user = new \App\Entities\User($this->request->getPost());

        // Activate user
        $user->activate();

        $db = \Config\Database::connect();

        $db->transStart();
        if (!($userId = $userModel->insert($user, true))) {
            $db->transComplete();

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
        // set redirect url to admin page after being redirected to login page
        $_SESSION['redirect_url'] = route_to('admin');

        return redirect()
            ->route('login')
            ->with('message', lang('Install.messages.createSuperAdminSuccess'));
    }
}
