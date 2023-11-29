<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Shield\Config\AuthToken as ShieldAuthToken;

/**
 * Configuration for Token Auth and HMAC Auth
 */
class AuthToken extends ShieldAuthToken
{
    /**
     * --------------------------------------------------------------------
     * Record Login Attempts for Token Auth and HMAC Auth
     * --------------------------------------------------------------------
     * Specify which login attempts are recorded in the database.
     *
     * Valid values are:
     * - Auth::RECORD_LOGIN_ATTEMPT_NONE
     * - Auth::RECORD_LOGIN_ATTEMPT_FAILURE
     * - Auth::RECORD_LOGIN_ATTEMPT_ALL
     */
    public int $recordLoginAttempt = Auth::RECORD_LOGIN_ATTEMPT_FAILURE;

    /**
     * --------------------------------------------------------------------
     * Name of Authenticator Header
     * --------------------------------------------------------------------
     * The name of Header that the Authorization token should be found.
     * According to the specs, this should be `Authorization`, but rare
     * circumstances might need a different header.
     */
    public array $authenticatorHeader = [
        'tokens' => 'Authorization',
        'hmac'   => 'Authorization',
    ];

    /**
     * --------------------------------------------------------------------
     * Unused Token Lifetime
     * --------------------------------------------------------------------
     * Determines the amount of time, in seconds, that an unused token can
     * be used.
     */
    public int $unusedTokenLifetime = YEAR;

    /**
     * --------------------------------------------------------------------
     * HMAC secret key byte size
     * --------------------------------------------------------------------
     * Specify in integer the desired byte size of the
     * HMAC SHA256 byte size
     */
    public int $hmacSecretKeyByteSize = 32;

    /**
     * --------------------------------------------------------------------
     * HMAC encryption Keys
     * --------------------------------------------------------------------
     * This sets the key to be used when encrypting a user's HMAC Secret Key.
     *
     * 'keys' is an array of keys which will facilitate key rotation. Valid
     *  keyTitles must include only [a-zA-Z0-9_] and should be kept to a
     *  max of 8 characters.
     *
     * Each keyTitle is an associative array containing the required 'key'
     *  value, and the optional 'driver' and 'digest' values. If the
     *  'driver' and 'digest' values are not specified, the default 'driver'
     *  and 'digest' values will be used.
     *
     * Old keys will are used to decrypt existing Secret Keys. It is encouraged
     *  to run 'php spark shield:hmac reencrypt' to update existing Secret
     *  Key encryptions.
     *
     * @see https://codeigniter.com/user_guide/libraries/encryption.html
     *
     * @var array<string, array{key: string, driver?: string, digest?: string}>|string
     *
     * NOTE: The value becomes temporarily a string when setting value as JSON
     *       from environment variable.
     *
     * [key_name => ['key' => key_value]]
     * or [key_name => ['key' => key_value, 'driver' => driver, 'digest' => digest]]
     */
    public $hmacEncryptionKeys = [
        'k1' => [
            'key' => '',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * HMAC Current Encryption Key Selector
     * --------------------------------------------------------------------
     * This specifies which of the encryption keys should be used.
     */
    public string $hmacEncryptionCurrentKey = 'k1';

    /**
     * --------------------------------------------------------------------
     * HMAC Encryption Key Driver
     * --------------------------------------------------------------------
     * This specifies which of the encryption drivers should be used.
     *
     * Available drivers:
     *     - OpenSSL
     *     - Sodium
     */
    public string $hmacEncryptionDefaultDriver = 'OpenSSL';

    /**
     * --------------------------------------------------------------------
     * HMAC Encryption Key Driver
     * --------------------------------------------------------------------
     * THis specifies the type of encryption to be used.
     *     e.g. 'SHA512' or 'SHA256'.
     */
    public string $hmacEncryptionDefaultDigest = 'SHA512';
}
