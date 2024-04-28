<?php

declare(strict_types=1);

/**
 * This file is based on the HttpSignature file from the ActivityPhp package. It is adapted to work with CodeIgniter4
 *
 * More info: https://github.com/landrok/activitypub
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\I18n\Time;
use Config\Services;
use Exception;
use phpseclib\Crypt\RSA;

/**
 * HTTP signatures tool
 */
class HttpSignature
{
    /**
     * @var string
     */
    private const SIGNATURE_PATTERN = '/
        (?=.*(keyId="(?P<keyId>https?:\/\/[\w\-\.]+[\w]+(:[\d]+)?[\w\-\.#\/@]+)"))
        (?=.*(signature="(?P<signature>[\w+\/]+={0,2})"))
        (?=.*(headers="\(request-target\)(?P<headers>[\w\\-\s]+)"))?
        (?=.*(algorithm="(?P<algorithm>[\w\-]+)"))?
    /x';

    protected IncomingRequest $request;

    public function __construct(IncomingRequest $request = null)
    {
        if (! $request instanceof IncomingRequest) {
            $request = Services::request();
        }

        $this->request = $request;
    }

    /**
     * Verify an incoming message based upon its HTTP signature
     *
     * @return bool True if signature has been verified. Otherwise false
     */
    public function verify(): bool
    {
        if (! ($dateHeader = $this->request->header('date'))) {
            throw new Exception('Request must include a date header.');
        }

        // verify that request has been made within the last hour
        $currentTime = Time::now();
        $requestTime = Time::createFromFormat('D, d M Y H:i:s T', $dateHeader->getValue());

        $diff = $requestTime->difference($currentTime);
        $diffSeconds = $diff->getSeconds();
        if ($diffSeconds > 3600 || $diffSeconds < 0) {
            throw new Exception('Request must be made within the last hour.');
        }

        // check that digest header is set
        if (! ($digestHeader = $this->request->header('digest'))) {
            throw new Exception('Request must include a digest header');
        }

        // compute body digest and compare with header digest
        $bodyDigest = hash('sha256', (string) $this->request->getBody(), true);
        $digest = 'SHA-256=' . base64_encode($bodyDigest);
        if ($digest !== $digestHeader->getValue()) {
            throw new Exception('Request digest is incorrect.');
        }

        // read the Signature header
        if (($signature = $this->request->getHeaderLine('signature')) === '') {
            // Signature header not found
            throw new Exception('Request must include a signature header');
        }

        // Split it into its parts (keyId, headers and signature)
        if (! ($parts = $this->splitSignature($signature))) {
            throw new Exception('Malformed signature string.');
        }

        // set $keyId, $headers and $signature variables
        $keyId = $parts['keyId'];
        $algorithm = $parts['algorithm'];
        $headers = $parts['headers'] ?? 'date';
        $signature = $parts['signature'];

        // Fetch the public key linked from keyId
        $actorRequest = new ActivityRequest($keyId);
        $actorResponse = $actorRequest->get();
        $actor = json_decode((string) $actorResponse->getBody(), false, 512, JSON_THROW_ON_ERROR);

        $publicKeyPem = (string) $actor->publicKey->publicKeyPem;

        // Create a comparison string from the plaintext headers we got
        // in the same order as was given in the signature header,
        $data = $this->getPlainText(explode(' ', trim($headers)));

        // Verify the data string using the public key and the original signature.
        return $this->verifySignature($publicKeyPem, $data, $signature, $algorithm);
    }

    /**
     * Split HTTP signature into its parts (keyId, headers and signature)
     *
     * @return array<string, string>|false
     */
    private function splitSignature(string $signature): bool|array
    {
        if (! preg_match(self::SIGNATURE_PATTERN, $signature, $matches, PREG_UNMATCHED_AS_NULL)) {
            // Signature pattern failed
            return false;
        }

        // Headers are optional
        if (! isset($matches['headers']) || $matches['headers'] === '') {
            $matches['headers'] = 'date';
        }

        return $matches;
    }

    /**
     * Get plain text that has been originally signed
     *
     * @param string[] $headers HTTP header keys
     */
    private function getPlainText(array $headers): string
    {
        $strings = [];
        $strings[] = sprintf(
            '(request-target): %s %s%s',
            $this->request->getMethod(),
            '/' . $this->request->getUri()->getPath(),
            $this->request->getUri()
                ->getQuery() !== ''
                ? '?' . $this->request->getUri()->getQuery()
                : '',
        );

        foreach ($headers as $key) {
            if ($this->request->hasHeader($key)) {
                $strings[] = "{$key}: {$this->request->getHeaderLine($key)}";
            }
        }

        return implode("\n", $strings);
    }

    /**
     * Verifies the signature depending on the algorithm sent
     */
    private function verifySignature(
        string $publicKeyPem,
        string $data,
        string $signature,
        string $algorithm = 'rsa-sha256'
    ): bool {
        if ($algorithm === 'rsa-sha512' || $algorithm === 'rsa-sha256') {
            $hash = substr($algorithm, strpos($algorithm, '-') + 1);
            $rsa = new RSA();
            $rsa->setHash($hash);
            $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
            $rsa->loadKey($publicKeyPem);

            return $rsa->verify($data, (string) base64_decode($signature, true));
        }

        // not implemented
        return false;
    }
}
