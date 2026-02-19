<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Stores the default settings for the ContentSecurityPolicy, if you choose to use it. The values here will be read in
 * and set as defaults for the site. If needed, they can be overridden on a page-by-page basis.
 *
 * Suggested reference for explanations:
 *
 * @see https://www.html5rocks.com/en/tutorials/security/content-security-policy/
 */
class ContentSecurityPolicy extends BaseConfig
{
    /**
     * Default CSP report context
     */
    public bool $reportOnly = false;

    /**
     * Specifies a URL where a browser will send reports when a content security policy is violated.
     */
    public ?string $reportURI = null;

    /**
     * Specifies a reporting endpoint to which violation reports ought to be sent.
     */
    public ?string $reportTo = null;

    /**
     * Instructs user agents to rewrite URL schemes, changing HTTP to HTTPS. This directive is for websites with large
     * numbers of old URLs that need to be rewritten.
     */
    public bool $upgradeInsecureRequests = false;

    // -------------------------------------------------------------------------
    // CSP DIRECTIVES SETTINGS
    // NOTE: once you set a policy to 'none', it cannot be further restricted
    // -------------------------------------------------------------------------

    /**
     * Will default to `'self'` if not overridden
     *
     * @var list<string>|string|null
     */
    public string | array | null $defaultSrc = null;

    /**
     * Lists allowed scripts' URLs.
     *
     * @var list<string>|string
     */
    public string | array $scriptSrc = 'self';

    /**
     * Specifies valid sources for JavaScript <script> elements.
     *
     * @var list<string>|string
     */
    public array|string $scriptSrcElem = 'self';

    /**
     * Specifies valid sources for JavaScript inline event
     * handlers and JavaScript URLs.
     *
     * @var list<string>|string
     */
    public array|string $scriptSrcAttr = 'self';

    /**
     * Lists allowed stylesheets' URLs.
     *
     * @var list<string>|string
     */
    public string | array $styleSrc = 'self';

    /**
     * Specifies valid sources for stylesheets <link> elements.
     *
     * @var list<string>|string
     */
    public array|string $styleSrcElem = 'self';

    /**
     * Specifies valid sources for stylesheets inline
     * style attributes and `<style>` elements.
     *
     * @var list<string>|string
     */
    public array|string $styleSrcAttr = 'self';

    /**
     * Defines the origins from which images can be loaded.
     *
     * @var list<string>|string
     */
    public string | array $imageSrc = 'self';

    /**
     * Restricts the URLs that can appear in a page's `<base>` element.
     *
     * Will default to self if not overridden
     *
     * @var list<string>|string|null
     */
    public string | array | null $baseURI = null;

    /**
     * Lists the URLs for workers and embedded frame contents
     *
     * @var list<string>|string
     */
    public string | array $childSrc = 'self';

    /**
     * Limits the origins that you can connect to (via XHR, WebSockets, and EventSource).
     *
     * @var list<string>|string
     */
    public string | array $connectSrc = 'self';

    /**
     * Specifies the origins that can serve web fonts.
     *
     * @var list<string>|string
     */
    public string | array $fontSrc;

    /**
     * Lists valid endpoints for submission from `<form>` tags.
     *
     * @var list<string>|string
     */
    public string | array $formAction = 'self';

    /**
     * Specifies the sources that can embed the current page. This directive applies to `<frame>`, `<iframe>`,
     * `<embed>`, and `<applet>` tags. This directive can't be used in `<meta>` tags and applies only to non-HTML
     * resources.
     *
     * @var list<string>|string|null
     */
    public string | array | null $frameAncestors = null;

    /**
     * The frame-src directive restricts the URLs which may be loaded into nested browsing contexts.
     *
     * @var list<string>|string|null
     */
    public string | array | null $frameSrc = null;

    /**
     * Restricts the origins allowed to deliver video and audio.
     *
     * @var list<string>|string|null
     */
    public string | array | null $mediaSrc = null;

    /**
     * Allows control over Flash and other plugins.
     *
     * @var list<string>|string
     */
    public string | array $objectSrc = 'self';

    /**
     * @var list<string>|string|null
     */
    public string | array | null $manifestSrc = null;

    /**
     * @var list<string>|string
     */
    public array|string $workerSrc = [];

    /**
     * Limits the kinds of plugins a page may invoke.
     *
     * @var list<string>|string|null
     */
    public string | array | null $pluginTypes = null;

    /**
     * List of actions allowed.
     *
     * @var list<string>|string|null
     */
    public string | array | null $sandbox = null;

    /**
     * Nonce placeholder for style tags.
     */
    public string $styleNonceTag = '{csp-style-nonce}';

    /**
     * Nonce placeholder for script tags.
     */
    public string $scriptNonceTag = '{csp-script-nonce}';

    /**
     * Replace nonce tag automatically?
     */
    public bool $autoNonce = true;
}
