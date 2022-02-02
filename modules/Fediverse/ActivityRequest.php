<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse;

use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;
use Config\Services;
use Modules\Fediverse\Core\Activity;
use phpseclib\Crypt\RSA;

class ActivityRequest
{
    protected CURLRequest $request;

    protected URI $uri;

    protected ?Activity $activity = null;

    /**
     * @var array<string, mixed>
     */
    protected array $options = [];

    public function __construct(string $uri, ?string $activityPayload = null)
    {
        $this->request = Services::curlrequest();

        if ($activityPayload !== null) {
            $this->request->setBody($activityPayload);
        }

        $this->options = [
            'headers' => [
                'Content-Type' => 'application/activity+json',
                'Accept' => 'application/activity+json',
                'User-Agent' => 'Castopod/' . CP_VERSION . '; +' . base_url('', 'https'),
                // TODO: outgoing and incoming requests
            ],
        ];

        $this->uri = new URI($uri);
    }

    public function post(): void
    {
        // outgoing message to Fediverse instance
        $this->request->post((string) $this->uri, $this->options);
    }

    public function get(): ResponseInterface
    {
        return $this->request->get((string) $this->uri, $this->options);
    }

    public function getDomain(): string
    {
        return $this->uri->getHost() .
            ($this->uri->getPort() ? ':' . $this->uri->getPort() : '');
    }

    public function sign(string $keyId, string $privateKey): void
    {
        $rsa = new RSA();
        $rsa->loadKey($privateKey);
        $rsa->setHash('sha256');
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);

        $path =
            $this->uri->getPath() .
            ($this->uri->getQuery() !== '' ? "?{$this->uri->getQuery()}" : '');
        $host = $this->uri->getHost();
        $date = Time::now('GMT')->format('D, d M Y H:i:s T');
        $digest = 'SHA-256=' . base64_encode($this->getBodyDigest());
        $contentType = $this->options['headers']['Content-Type'];
        $contentLength = (string) strlen($this->request->getBody());
        $userAgent = 'Castopod/' . CP_VERSION . '; +' . base_url('', 'https');

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
