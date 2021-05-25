<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Typically this will be your base URL,
     * WITH a trailing slash:
     *
     *    http://example.com/
     *
     * If this is not set then CodeIgniter will try guess the protocol, domain
     * and path to your installation. However, you should always configure this
     * explicitly and never rely on auto-guessing, especially in production
     * environments.
     */
    public string $baseURL = 'http://localhost:8080/';

    /**
     * --------------------------------------------------------------------------
     * Media Base URL
     * --------------------------------------------------------------------------
     *
     * URL to your media root. Typically this will be your base URL,
     * WITH a trailing slash:
     *
     *    http://cdn.example.com/
     */
    public string $mediaBaseURL = 'http://localhost:8080/';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     *
     * Typically this will be your index.php file, unless you've renamed it to
     * something else. If you are using mod_rewrite to remove the page set this
     * variable so that it is blank.
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * This item determines which getServer global should be used to retrieve the
     * URI string.  The default setting of 'REQUEST_URI' works for most servers.
     * If your links do not seem to work, try one of the other delicious flavors:
     *
     * 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
     * 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
     * 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
     *
     * WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     *
     * The Locale roughly represents the language and location that your visitor
     * is viewing the site from. It affects the language strings and other
     * strings (like currency markers, numbers, etc), that your program
     * should run under for this request.
     */
    public string $defaultLocale = 'en';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     *
     * If true, the current Request object will automatically determine the
     * language to use based on the value of the Accept-Language header.
     *
     * If false, no automatic detection will be performed.
     */
    public bool $negotiateLocale = true;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * If $negotiateLocale is true, this array lists the locales supported
     * by the application in descending order of priority. If no match is
     * found, the first locale will be used.
     *
     * @var string[]
     */
    public array $supportedLocales = ['en', 'fr'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * The default timezone that will be used in your application to display
     * dates with the date helper, and can be retrieved through app_timezone()
     */
    public string $appTimezone = 'UTC';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     *
     * This determines which character set is used by default in various methods
     * that require a character set to be provided.
     *
     * @see http://php.net/htmlspecialchars for a list of supported charsets.
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * If true, this will force every request made to this application to be
     * made via a secure connection (HTTPS). If the incoming request is not
     * secure, the user will be redirected to a secure version of the page
     * and the HTTP Strict Transport Security header will be set.
     */
    public bool $forceGlobalSecureRequests = true;

    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     *
     * The session storage driver to use:
     * - `CodeIgniter\Session\Handlers\FileHandler`
     * - `CodeIgniter\Session\Handlers\DatabaseHandler`
     * - `CodeIgniter\Session\Handlers\MemcachedHandler`
     * - `CodeIgniter\Session\Handlers\RedisHandler`
     */
    public string $sessionDriver = FileHandler::class;

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     *
     * The session cookie name, must contain only [0-9a-z_-] characters
     */
    public string $sessionCookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration
     * --------------------------------------------------------------------------
     *
     * The number of SECONDS you want the session to last.
     * Setting to 0 (zero) means expire when the browser is closed.
     */
    public int $sessionExpiration = 7200;

    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     *
     * The location to save sessions to and is driver dependent.
     *
     * For the 'files' driver, it's a path to a writable directory.
     * WARNING: Only absolute paths are supported!
     *
     * For the 'database' driver, it's a table name.
     * Please read up the manual for the format with other session drivers.
     *
     * IMPORTANT: You are REQUIRED to set a valid save path!
     */
    public string $sessionSavePath = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     *
     * Whether to match the user's IP address when reading the session data.
     *
     * WARNING: If you're using the database driver, don't forget to update
     *          your session table's PRIMARY KEY when changing this setting.
     */
    public bool $sessionMatchIP = false;

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     *
     * How many seconds between CI regenerating the session ID.
     */
    public int $sessionTimeToUpdate = 300;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     *
     * Whether to destroy session data associated with the old session ID
     * when auto-regenerating the session ID. When set to FALSE, the data
     * will be later deleted by the garbage collector.
     */
    public bool $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     *
     * If your server is behind a reverse proxy, you must whitelist the proxy
     * IP addresses from which CodeIgniter should trust headers such as
     * HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
     * the visitor's IP address.
     *
     * You can use both an array or a comma-separated list of proxy addresses,
     * as well as specifying whole subnets. Here are a few examples:
     *
     * Comma-separated:	'10.0.1.200,192.168.5.0/24'
     * Array: ['10.0.1.200', '192.168.5.0/24']
     *
     * @var string|string[]
     */
    public string | array $proxyIPs = '';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * Enables the Response's Content Secure Policy to restrict the sources that
     * can be used for images, scripts, CSS files, audio, video, etc. If enabled,
     * the Response object will populate default values for the policy from the
     * `ContentSecurityPolicy.php` file. Controllers can always add to those
     * restrictions at run time.
     *
     * For a better understanding of CSP, see these documents:
     *
     * @see http://www.html5rocks.com/en/tutorials/security/content-security-policy/
     * @see http://www.w3.org/TR/CSP/
     */
    public bool $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Media root folder
     * --------------------------------------------------------------------------
     * Defines the root folder for media files storage
     */
    public string $mediaRoot = 'media';

    /**
     * --------------------------------------------------------------------------
     * Admin gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all admin pages
     */
    public string $adminGateway = 'cp-admin';

    /**
     * --------------------------------------------------------------------------
     * Auth gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all authentication related pages
     */
    public string $authGateway = 'cp-auth';

    /**
     * --------------------------------------------------------------------------
     * Install gateway
     * --------------------------------------------------------------------------
     * Defines a base route for instance installation
     */
    public string $installGateway = 'cp-install';
}
