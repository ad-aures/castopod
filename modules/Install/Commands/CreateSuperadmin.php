<?php

declare(strict_types=1);

namespace Modules\Install\Commands;

use CodeIgniter\Shield\Commands\BaseCommand;
use CodeIgniter\Shield\Commands\Exceptions\BadInputException;
use CodeIgniter\Shield\Commands\Exceptions\CancelException;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Validation\ValidationRules;
use Override;

class CreateSuperadmin extends BaseCommand
{
    /**
     * @var string
     */
    protected $group = 'Install';

    /**
     * @var string
     */
    protected $name = 'install:create-superadmin';

    /**
     * @var string
     */
    protected $description = 'Creates the instance superadmin.';

    /**
     * Validation rules for user fields
     *
     * @var array<string, array<string, array{rules: string[]}>>
     */
    private array $validationRules = [];

    #[Override]
    public function run(array $params): void
    {
        // first, check that super admin does not exist
        $userModel = model('UserModel');
        $isSuperAdminCreated = $userModel->where('is_owner', true)
            ->countAllResults();

        if ($isSuperAdminCreated > 0) {
            $this->write('Super admin was already created!', 'red');

            exit(EXIT_ERROR);
        }

        $this->setValidationRules();

        $username = $params['n'] ?? null;
        $email = $params['e'] ?? null;

        $data = [
            'is_owner' => true,
        ];

        if ($username === null) {
            $username = $this->prompt('Username', null, $this->validationRules['username']['rules']);
        }

        $data['username'] = $username;

        if ($email === null) {
            $email = $this->prompt('Email', null, $this->validationRules['email']['rules']);
        }

        $data['email'] = $email;

        $password = $this->prompt('Password', null, $this->validationRules['password']['rules']);
        $passwordConfirm = $this->prompt(
            'Password confirmation',
            null,
            $this->validationRules['password']['rules'],
        );

        if ($password !== $passwordConfirm) {
            throw new BadInputException("The passwords don't match");
        }

        $data['password'] = $password;

        // Run validation if the user has passed username and/or email via command line
        $validation = service('validation');
        $validation->setRules($this->validationRules);

        if (! $validation->run($data)) {
            foreach ($validation->getErrors() as $message) {
                $this->write($message, 'red');
            }

            throw new CancelException('Super admin creation aborted');
        }

        $userModel = model('UserModel');

        $user = new User($data);
        $userModel->save($user);

        $user = $userModel->findById($userModel->getInsertID());

        // set newly created user as most powerful instance group (superadmin)
        $user->addGroup(setting('AuthGroups.mostPowerfulGroup'));

        $this->write('Super admin "' . $username . '" created', 'green');
    }

    private function setValidationRules(): void
    {
        $validationRules = new ValidationRules();

        $rules = $validationRules->getRegistrationRules();

        // Remove `strong_password` because it only supports use cases
        // to check the user's own password.
        $passwordRules = $rules['password']['rules'];
        if (is_string($passwordRules)) {
            $passwordRules = explode('|', $passwordRules);
        }

        if (($key = array_search('strong_password[]', $passwordRules, true)) !== false) {
            unset($passwordRules[$key]);
        }

        if (($key = array_search('strong_password', $passwordRules, true)) !== false) {
            unset($passwordRules[$key]);
        }

        $config = config('Auth');

        // Add `min_length`
        $passwordRules[] = 'min_length[' . $config->minimumPasswordLength . ']';

        $rules['password']['rules'] = $passwordRules;

        $this->validationRules = [
            'username' => $rules['username'],
            'email'    => $rules['email'],
            'password' => $rules['password'],
        ];
    }
}
