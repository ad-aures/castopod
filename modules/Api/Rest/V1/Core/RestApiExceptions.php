<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Core;

use CodeIgniter\Debug\Exceptions;
use Override;
use Throwable;

class RestApiExceptions extends Exceptions
{
    #[Override]
    protected function render(Throwable $exception, int $statusCode): void
    {
        header('Content-Type: application/json');
        $data = [
            'status'   => $statusCode,
            'error'    => $statusCode,
            'messages' => [
                'error' => 'Unexpected error',
            ],
        ];
        if (ENVIRONMENT === 'development') {
            $data['messages'] = array_merge($data['messages'], [
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'trace'   => $exception->getTrace(),
            ]);
        }

        echo json_encode($data);
    }
}
