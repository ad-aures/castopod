<?php

declare(strict_types=1);

namespace Modules\Media\FileManagers;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;
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
                'ContentType' => $file->getMimeType(),
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
        return url_to('media-serve', $key);
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
        return $this->delete($oldKey);
    }

    public function getFileContents(string $key): string|false
    {
        try {
            $result = $this->s3->getObject([
                'Bucket' => $this->config->s3['bucket'],
                'Key' => $this->prefixKey($key),
            ]);
        } catch (Exception) {
            return false;
        }

        return (string) $result->get('Body');
    }

    public function getFileInput(string $key): string
    {
        return $this->getUrl($key);
    }

    public function deletePodcastImageSizes(string $podcastHandle): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll('podcasts/' . $podcastHandle, "*_*{$ext}");
        }

        return true;
    }

    public function deletePersonImagesSizes(): bool
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $this->deleteAll('persons', "*_*{$ext}");
        }

        return true;
    }

    public function deleteAll(string $prefix, ?string $pattern = '*'): bool
    {
        $prefix = rtrim($this->prefixKey($prefix), '/') . '/'; // make sure that there is a trailing slash
        $pattern = $prefix . $pattern;

        $results = $this->s3->getPaginator('ListObjectsV2', [
            'Bucket' => $this->config->s3['bucket'],
            'prefix' => $prefix,
        ]);

        $objectsToDelete = [];
        foreach ($results as $result) {
            if ($result['Contents'] === null) {
                continue;
            }

            foreach ($result['Contents'] as $object) {
                if (fnmatch($pattern, $object['Key'])) {
                    $objectsToDelete[] = [
                        'Key' => $object['Key'],
                    ];
                }
            }
        }

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

    public function serve(string $key): Response
    {
        $response = service('response');

        try {
            $result = $this->s3->getObject([
                'Bucket' => $this->config->s3['bucket'],
                'Key' => $this->prefixKey($key),
            ]);
        } catch (Exception) {
            throw new PageNotFoundException();
        }

        // Remove Cache-Control header before redefining it
        header_remove('Cache-Control');

        return $response->setCache([
            'max-age' => DECADE,
            'last-modified' => $result->get('LastModified'),
            'etag' => $result->get('ETag'),
            'public' => true,
        ])->setContentType($result->get('ContentType'))
            ->setBody((string) $result->get('Body')->getContents());
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
