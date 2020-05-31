<?php namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;
use RuntimeException;

class Podcast extends BaseController
{
    public function index()
    {
        return view('podcast/index.php');
    }

    public function create()
    {
        $model = new PodcastModel();

        if (!$this->validate([
            'title' => 'required',
            'name' => 'required|alpha_dash',
            'description' => 'required|max_length[4000]',
            'image' => 'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|max_dims[image,3000,3000]',
            'owner_email' => 'required|valid_email|permit_empty',
            'type' => 'required',
        ])) {
            $langs = explode(',', $this->request->getServer('HTTP_ACCEPT_LANGUAGE'));
            $browser_lang = '';
            if (!empty($langs)) {
                $browser_lang = substr($langs[0], 0, 2);
            }

            $languageModel = new LanguageModel();
            $categoryModel = new CategoryModel();
            $data = [
                'languages' => $languageModel->findAll(),
                'categories' => $categoryModel->findAll(),
                'browser_lang' => $browser_lang,
            ];

            echo view('podcast/create', $data);
        } else {
            $image = $this->request->getFile('image');
            if (!$image->isValid()) {
                throw new RuntimeException($image->getErrorString() . '(' . $image->getError() . ')');
            }
            $image_path = $image->store();

            $model->save([
                'title' => $this->request->getVar('title'),
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'episode_description_footer' => $this->request->getVar('episode_description_footer'),
                'image' => $image_path,
                'language' => $this->request->getVar('language'),
                'category' => $this->request->getVar('category'),
                'explicit' => $this->request->getVar('explicit') or false,
                'author' => $this->request->getVar('author'),
                'owner_name' => $this->request->getVar('owner_name'),
                'owner_email' => $this->request->getVar('owner_email'),
                'type' => $this->request->getVar('type'),
                'copyright' => $this->request->getVar('copyright'),
                'block' => $this->request->getVar('block') or false,
                'complete' => $this->request->getVar('complete') or false,
                'custom_html_head' => $this->request->getVar('custom_html_head'),
            ]);

            echo view('podcast/success');
        }
    }
}
