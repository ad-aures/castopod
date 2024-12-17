<?php

declare(strict_types=1);

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PodcastImport\Controllers;

use App\Entities\Podcast;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use Exception;
use Modules\Admin\Controllers\BaseController;
use Modules\PodcastImport\Entities\PodcastImportTask;
use Modules\PodcastImport\Entities\TaskStatus;

class PodcastImportController extends BaseController
{
    public function list(): string
    {
        helper('podcast_import');

        $this->setHtmlHead(lang('Podcast.all_imports'));
        return view('import/queue', [
            'podcastImportsQueue' => get_import_tasks(),
        ]);
    }

    public function podcastList(int $podcastId): string
    {
        if (! ($podcast = (new PodcastModel())->getPodcastById($podcastId)) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('podcast_import');

        $this->setHtmlHead(lang('Podcast.all_imports'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('import/podcast_queue', [
            'podcast'             => $podcast,
            'podcastImportsQueue' => get_import_tasks($podcast->handle),
        ]);
    }

    public function addToQueueView(): string
    {
        helper(['form', 'misc']);

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang'     => get_browser_language($this->request->getServer('HTTP_ACCEPT_LANGUAGE')),
        ];

        $this->setHtmlHead(lang('Podcast.import'));
        return view('import/add_to_queue', $data);
    }

    public function addToQueueAction(): RedirectResponse
    {
        $rules = [
            'handle'            => 'required|regex_match[/^[a-zA-Z0-9\_]{1,32}$/]',
            'imported_feed_url' => 'required|valid_url_strict',
            'language'          => 'required',
            'category'          => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        // TODO: check that handle is not already in use

        $importTask = new PodcastImportTask([
            'handle'     => $validData['handle'],
            'feed_url'   => $validData['imported_feed_url'],
            'language'   => $validData['language'],
            'category'   => $validData['category'],
            'status'     => TaskStatus::Queued,
            'created_by' => user_id(),
            'updated_by' => user_id(),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ]);

        $importTask->save();

        return redirect()->route('all-podcast-imports')
            ->with('message', lang('PodcastImport.messages.importTaskQueued'));
    }

    public function syncImport(int $podcastId): string
    {
        if (! ($podcast = (new PodcastModel())->getPodcastById($podcastId)) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');

        $this->setHtmlHead(lang('PodcastImport.syncForm.title'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('import/podcast_sync', [
            'podcast' => $podcast,
        ]);
    }

    public function syncImportAttempt(int $podcastId): RedirectResponse
    {
        if (! ($podcast = (new PodcastModel())->getPodcastById($podcastId)) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'feed_url' => 'valid_url_strict',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        // create update task in podcastImport
        $importTask = new PodcastImportTask([
            'handle'     => $podcast->handle,
            'feed_url'   => $validData['feed_url'],
            'language'   => $podcast->language_code,
            'category'   => $podcast->category_id,
            'status'     => TaskStatus::Queued,
            'created_by' => user_id(),
            'updated_by' => user_id(),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ]);

        $importTask->save();

        return redirect()->route('podcast-imports', [$podcastId])
            ->with('message', lang('PodcastImport.messages.syncTaskQueued'));
    }

    public function taskAction(string $taskId, string $action): RedirectResponse
    {
        /** @var array<string, PodcastImportTask> $importQueue */
        $importQueue = service('settings')
            ->get('Import.queue') ?? [];

        if (! array_key_exists($taskId, $importQueue)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $importTask = $importQueue[$taskId];
        switch ($action) {
            case 'cancel':
                if ($importTask->status === TaskStatus::Running || $importTask->status === TaskStatus::Queued) {
                    $importTask->cancel();

                    return redirect()->back()
                        ->with('message', lang('PodcastImport.messages.canceled'));
                }

                return redirect()->back()
                    ->with('error', lang('PodcastImport.messages.notRunning'));
            case 'retry':
                if ($importTask->status === TaskStatus::Running || $importTask->status === TaskStatus::Queued) {
                    return redirect()->back()
                        ->with('error', lang('PodcastImport.messages.alreadyRunning'));
                }

                $newImportTask = new PodcastImportTask([
                    'handle'     => $importTask->handle,
                    'feed_url'   => $importTask->feed_url,
                    'language'   => $importTask->language,
                    'category'   => $importTask->category,
                    'status'     => TaskStatus::Queued,
                    'created_by' => user_id(),
                    'updated_by' => user_id(),
                    'created_at' => Time::now(),
                    'updated_at' => Time::now(),
                ]);

                $newImportTask->save();

                return redirect()->back()
                    ->with('message', lang('PodcastImport.messages.retried'));
            case 'delete':
                $importTask->delete();
                return redirect()->back()
                    ->with('message', lang('PodcastImport.messages.deleted'));
            default:
                throw new Exception('Task action ' . $action . ' was not implemented');
        }
    }
}
