<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Entities\Page;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PageModel;

class PageController extends BaseController
{
    /**
     * @var Page|null
     */
    protected $page;

    public function _remap($method, ...$params)
    {
        if (count($params) === 0) {
            return $this->$method();
        }

        if ($this->page = (new PageModel())->find($params[0])) {
            return $this->$method();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    function list()
    {
        $data = [
            'pages' => (new PageModel())->findAll(),
        ];

        return view('admin/page/list', $data);
    }

    function view()
    {
        return view('admin/page/view', ['page' => $this->page]);
    }

    function create()
    {
        helper('form');

        return view('admin/page/create');
    }

    function attemptCreate()
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

    function edit()
    {
        helper('form');

        replace_breadcrumb_params([0 => $this->page->title]);
        return view('admin/page/edit', ['page' => $this->page]);
    }

    function attemptEdit()
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

    public function delete()
    {
        (new PageModel())->delete($this->page->id);

        return redirect()->route('page-list');
    }
}
