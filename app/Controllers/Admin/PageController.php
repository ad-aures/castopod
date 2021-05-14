<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RedirectResponse;
use App\Entities\Page;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PageModel;

class PageController extends BaseController
{
    /**
     * @var Page|null
     */
    protected $page;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            return $this->$method();
        }

        if ($this->page = (new PageModel())->find($params[0])) {
            return $this->$method();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    function list(): string
    {
        $data = [
            'pages' => (new PageModel())->findAll(),
        ];

        return view('admin/page/list', $data);
    }

    function view(): string
    {
        return view('admin/page/view', ['page' => $this->page]);
    }

    function create(): string
    {
        helper('form');

        return view('admin/page/create');
    }

    function attemptCreate(): RedirectResponse
    {
        $page = new Page([
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'content_markdown' => $this->request->getPost('content'),
        ]);

        $pageModel = new PageModel();

        if (!$pageModel->insert($page)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $pageModel->errors());
        }

        return redirect()
            ->route('page-list')
            ->with(
                'message',
                lang('Page.messages.createSuccess', [
                    'pageTitle' => $page->title,
                ]),
            );
    }

    function edit(): string
    {
        helper('form');

        replace_breadcrumb_params([0 => $this->page->title]);
        return view('admin/page/edit', ['page' => $this->page]);
    }

    function attemptEdit(): RedirectResponse
    {
        $this->page->title = $this->request->getPost('title');
        $this->page->slug = $this->request->getPost('slug');
        $this->page->content_markdown = $this->request->getPost('content');

        $pageModel = new PageModel();

        if (!$pageModel->update($this->page->id, $this->page)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $pageModel->errors());
        }

        return redirect()->route('page-list');
    }

    public function delete(): RedirectResponse
    {
        (new PageModel())->delete($this->page->id);

        return redirect()->route('page-list');
    }
}
