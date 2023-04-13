<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;
use Modules\Media\FileManagers\FileManagerInterface;

class MediaController extends Controller
{
    public function serve(string ...$key): Response
    {
        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        return $fileManager->serve(implode('/', $key));
    }
}
