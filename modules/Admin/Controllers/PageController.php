<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Page;
use App\Models\PageModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class PageController extends BaseController
{
    protected ?Page $page = null;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (($this->page = (new PageModel())->find($params[0])) instanceof Page) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        $data = [
            'pages' => (new PageModel())->findAll(),
        ];

        return view('page/list', $data);
    }

    public function view(): string
    {
        return view('page/view', [
            'page' => $this->page,
        ]);
    }

    public function create(): string
    {
        helper('form');

        return view('page/create');
    }

    public function attemptCreate(): RedirectResponse
    {
        $page = new Page([
            'title'            => $this->request->getPost('title'),
            'slug'             => $this->request->getPost('slug'),
            'content_markdown' => $this->request->getPost('content'),
        ]);

        $pageModel = new PageModel();

        if (! $pageModel->insert($page)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $pageModel->errors());
        }

        return redirect()
            ->route('page-list')
            ->with('message', lang('Page.messages.createSuccess', [
                'pageTitle' => $page->title,
            ]));
    }

    public function edit(): string
    {
        helper('form');

        replace_breadcrumb_params([
            0 => $this->page->title,
        ]);
        return view('page/edit', [
            'page' => $this->page,
        ]);
    }

    public function attemptEdit(): RedirectResponse
    {
        $this->page->title = $this->request->getPost('title');
        $this->page->slug = $this->request->getPost('slug');
        $this->page->content_markdown = $this->request->getPost('content');

        $pageModel = new PageModel();

        if (! $pageModel->update($this->page->id, $this->page)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $pageModel->errors());
        }

        return redirect()->route('page-edit', [$this->page->id])->with('message', lang('Page.messages.editSuccess'));
    }

    public function delete(): RedirectResponse
    {
        (new PageModel())->delete($this->page->id);

        return redirect()->route('page-list');
    }
}
