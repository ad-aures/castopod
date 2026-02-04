<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Media file server with HTTP Range support for seeking
 * This is needed because PHP's built-in development server doesn't support Range requests
 */
class MediaController extends Controller
{
    public function serve(string ...$segments): ResponseInterface
    {
        $path = implode('/', $segments);
        
        // Security: prevent directory traversal
        $path = str_replace(['..', "\0"], '', $path);
        
        // Build the file path - path already includes 'media/' prefix
        $filePath = ROOTPATH . 'public/' . $path;
        
        // Check if file exists
        if (!file_exists($filePath) || !is_file($filePath)) {
            return $this->response->setStatusCode(404)->setBody('File not found');
        }
        
        // Get file info
        $fileSize = filesize($filePath);
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
        
        // Handle Range requests
        $start = 0;
        $end = $fileSize - 1;
        $length = $fileSize;
        $statusCode = 200;
        
        $rangeHeader = $this->request->getHeaderLine('Range');
        if ($rangeHeader !== '') {
            // Parse Range header
            if (preg_match('/bytes=(\d*)-(\d*)/', $rangeHeader, $matches)) {
                $start = $matches[1] !== '' ? intval($matches[1]) : 0;
                $end = $matches[2] !== '' ? intval($matches[2]) : $fileSize - 1;
                
                // Validate range
                if ($start > $end || $start >= $fileSize) {
                    return $this->response
                        ->setStatusCode(416)
                        ->setHeader('Content-Range', "bytes */$fileSize");
                }
                
                $end = min($end, $fileSize - 1);
                $length = $end - $start + 1;
                $statusCode = 206;
                
                $this->response->setHeader('Content-Range', "bytes $start-$end/$fileSize");
            }
        }
        
        // Set headers
        $this->response
            ->setStatusCode($statusCode)
            ->setHeader('Accept-Ranges', 'bytes')
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Length', (string) $length)
            ->setHeader('Cache-Control', 'public, max-age=31536000');
        
        // Read and send file content
        $fp = fopen($filePath, 'rb');
        if ($fp) {
            fseek($fp, $start);
            $content = fread($fp, $length);
            fclose($fp);
            $this->response->setBody($content);
        }
        
        return $this->response;
    }
}
