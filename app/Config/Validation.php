<?php

declare(strict_types=1);

namespace Config;

use App\Validation\FileRules as AppFileRules;
use App\Validation\Rules as AppRules;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use Myth\Auth\Authentication\Passwords\ValidationRules as PasswordRules;

class Validation extends BaseConfig
{
    /**
     * Stores the classes that contain the rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        AppRules::class,
        AppFileRules::class,
        PasswordRules::class,
    ];

    /**
     * Specifies the views that are used to display the errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];
}
