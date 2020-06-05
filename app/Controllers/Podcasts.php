<?php namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;
use RuntimeException;

class Podcasts extends BaseController
{
    public function index()
    {
        return view('podcast/index.php');
    }

    public function create()
    {
        $model = new PodcastModel();
        helper(['form', 'url']);

        if (!$this->validate([
            'title' => 'required',
            'name' => 'required|regex_match[^[a-z0-9\_]{1,191}$]',
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

            echo view('podcasts/create', $data);
        } else {
            $image = $this->request->getFile('image');
            if (!$image->isValid()) {
                throw new RuntimeException($image->getErrorString() . '(' . $image->getError() . ')');
            }
            $podcast_name = $this->request->getVar('name');
            $image_name = 'cover.' . $image->getExtension();
            $image_storage_folder = 'media/' . $podcast_name . '/';
            $image->move($image_storage_folder, $image_name);

            $model->save([
                'title' => $this->request->getVar('title'),
                'name' => $podcast_name,
                'description' => $this->request->getVar('description'),
                'episode_description_footer' => $this->request->getVar('episode_description_footer'),
                'image' => $image_storage_folder . $image_name,
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

            return redirect()->to(base_url('/@' . $podcast_name));
        }
    }

    public function podcastByHandle($handle)
    {
        $model = new PodcastModel();

        $podcast_name = substr($handle, 1);

        $data['podcast'] = $model->where('name', $podcast_name)->first();

        return view('podcasts/view.php', $data);
    }
}
