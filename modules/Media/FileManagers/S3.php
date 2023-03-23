<?php

declare(strict_types=1);

namespace Modules\Media\FileManagers;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\URI;
use Exception;
use Modules\Media\Config\Media as MediaConfig;

class S3 implements FileManagerInterface
{
    public S3Client $s3;

    public function __construct(
        protected MediaConfig $config
    ) {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => $config->s3['region'],
            'endpoint' => $config->s3['endpoint'],
            'credentials' => new Credentials((string) $config->s3['key'], (string) $config->s3['secret']),
            'debug' => $config->s3['debug'],
            'use_path_style_endpoint' => $config->s3['pathStyleEndpoint'],
        ]);
    }

    public function save(File $file, string $key): string|false
    {
        try {
            $this->s3->putObject([
                'Bucket' => $this->config->s3['bucket'],
                'Key' => $this->prefixKey($key),
                'SourceFile' => $file,
            ]);
        } catch (Exception) {
            return false;
        }

        // delete file after storage in s3
        unlink($file->getRealPath());

        return $key;
    }

    public function delete(string $key): bool
    {
        try {
            $this->s3->deleteObject([
                'Bucket' => $this->config->s3['bucket'],
                'Key' => $this->prefixKey($key),
            ]);
        } catch (Exception) {
            return false;
        }

        return true;
    }

    public function getUrl(string $key): string
    {
        $url = new URI((string) $this->config->s3['endpoint']);

        if ($this->config->s3['pathStyleEndpoint'] === true) {
            $url->setPath($this->config->s3['bucket'] . '/' . $this->prefixKey($key));
            return (string) $url;
        }

        $url->setHost($this->config->s3['bucket'] . '.' . $url->getHost());
        $url->setPath($this->prefixKey($key));
        return (string) $url;
    }

    public function rename(string $oldKey, string $newKey): bool
    {
        try {
            // copy old object with new key
            $this->s3->copyObject([
                'Bucket' => $this->config->s3['bucket'],
                'CopySource' => $this->config->s3['bucket'] . '/' . $this->prefixKey($oldKey),
                'Key' => $this->prefixKey($newKey),
            ]);
        } catch (Exception) {
            return false;
        }

        // delete old object
        return $this->delete($this->prefixKey($oldKey));
    }

    public function getFileContents(string $key): string
    {
        $result = $this->s3->getObject([
            'Bucket' => $this->config->s3['bucket'],
            'Key' => $this->prefixKey($key),
        ]);

        return (string) $result->get('Body');
    }

    public function getFileInput(string $key): string
    {
        return $this->getUrl($key);
    }

    public function deletePodcastImageSizes(string $podcastHandle): bool
    {
        $results = $this->s3->getPaginator('ListObjectsV2', [
            'Bucket' => $this->config->s3['bucket'],
            'Prefix' => $this->prefixKey('podcasts/' . $podcastHandle . '/'),
        ]);

        $keys = [];
        foreach ($results as $result) {
            $key = array_map(static function ($object) {
                return $object['Key'];
            }, $result['Contents']);

            $prefixedPodcasts = $this->prefixKey('podcasts');

            array_push(
                $keys,
                ...preg_grep("~^{$prefixedPodcasts}\/{$podcastHandle}\/.*_.*.\.(jpe?g|png|webp)$~", $key)
            );
        }

        $objectsToDelete = array_map(static function ($key): array {
            return [
                'Key' => $key,
            ];
        }, $keys);

        if ($objectsToDelete === []) {
            return true;
        }

        try {
            $this->s3->deleteObjects([
                'Bucket' => $this->config->s3['bucket'],
                'Delete' => [
                    'Objects' => $objectsToDelete,
                ],
            ]);
        } catch (Exception) {
            return false;
        }

        return true;
    }

    public function deletePersonImagesSizes(): bool
    {
        $results = $this->s3->getPaginator('ListObjectsV2', [
            'Bucket' => $this->config->s3['bucket'],
            'prefix' => $this->prefixKey('persons/'),
        ]);

        $keys = [];
        foreach ($results as $result) {
            $key = array_map(static function ($object) {
                return $object['Key'];
            }, $result['Contents']);

            $prefixedPersons = $this->prefixKey('persons');

            array_push($keys, ...preg_grep("~^{$prefixedPersons}\/.*_.*.\.(jpe?g|png|webp)$~", $key));
        }

        $objectsToDelete = array_map(static function ($key): array {
            return [
                'Key' => $key,
            ];
        }, $keys);

        if ($objectsToDelete === []) {
            return true;
        }

        try {
            $this->s3->deleteObjects([
                'Bucket' => $this->config->s3['bucket'],
                'Delete' => [
                    'Objects' => $objectsToDelete,
                ],
            ]);
        } catch (Exception) {
            return false;
        }

        return true;
    }

    public function isHealthy(): bool
    {
        // check that bucket exists
        if (! $this->s3->doesBucketExist((string) $this->config->s3['bucket'])) {
            return false;
        }

        try {
            // ok if bucket exists and you have permission to access it
            $this->s3->headBucket([
                'Bucket' => $this->config->s3['bucket'],
            ]);
        } catch (Exception) {
            return false;
        }

        return true;
    }

    private function prefixKey(string $key): string
    {
        if ($this->config->s3['keyPrefix'] === '') {
            return $key;
        }

        $keyPrefix = rtrim((string) $this->config->s3['keyPrefix']);

        return $keyPrefix . '/' . $key;
    }
}
