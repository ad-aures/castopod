<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\URI;
use ActivityPub\Core\Activity;
use Config\Services;
use CodeIgniter\I18n\Time;
use phpseclib\Crypt\RSA;

class ActivityRequest
{
    /**
     * @var CURLRequest
     */
    protected $request;

    /**
     * @var URI
     */
    protected $uri;

    /**
     * @var Activity|null
     */
    protected $activity;

    /**
     * @var array
     */
    protected $options = [
        'headers' => [
            'Content-Type' => 'application/activity+json',
            'Accept' => 'application/activity+json', // TODO: outgoing and incoming requests
        ],
    ];

    /**
     * @param string $uri
     * @param string $activityPayload
     */
    public function __construct($uri, $activityPayload = null)
    {
        $this->request = Services::curlrequest();

        if ($activityPayload) {
            $this->request->setBody($activityPayload);
        }

        $this->uri = new URI($uri);
    }

    public function post(): void
    {
        // send Message to Fediverse instance
        $this->request->post($this->uri, $this->options);
    }

    public function get(): ResponseInterface
    {
        return $this->request->get($this->uri, $this->options);
    }

    public function getDomain(): string
    {
        return $this->uri->getHost() .
            ($this->uri->getPort() ? ':' . $this->uri->getPort() : '');
    }

    public function sign($keyId, $privateKey): void
    {
        $rsa = new RSA();
        $rsa->loadKey($privateKey); // private key
        $rsa->setHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        $path =
            $this->uri->getPath() .
            ($this->uri->getQuery() !== '' ? "?{$this->uri->getQuery()}" : '');
        $host = $this->uri->getHost();
        $date = Time::now('GMT')->format('D, d M Y H:i:s T');
        $digest = 'SHA-256=' . base64_encode($this->getBodyDigest());
        $contentType = $this->options['headers']['Content-Type'];
        $contentLength = strval(strlen($this->request->getBody()));
        $userAgent = 'Castopod';

        $plainText = "(request-target): post {$path}\nhost: {$host}\ndate: {$date}\ndigest: {$digest}\ncontent-type: {$contentType}\ncontent-length: {$contentLength}\nuser-agent: {$userAgent}";

        $signature = $rsa->sign($plainText);

        $signatureHeader =
            'keyId="' .
            $keyId .
            '",algorithm="rsa-sha256",headers="(request-target) host date digest content-type content-length user-agent",signature="' .
            base64_encode($signature) .
            '"';

        $this->options = [
            'headers' => [
                'Content-Type' => $contentType,
                'Content-Length' => $contentLength,
                'Authorization' => "Signature {$signatureHeader}",
                'Signature' => $signatureHeader,
                'Host' => $host,
                'Date' => $date,
                'User-Agent' => $userAgent,
                'Digest' => $digest,
            ],
        ];
    }

    protected function getBodyDigest(): string
    {
        return hash('sha256', $this->request->getBody(), true);
    }
}
