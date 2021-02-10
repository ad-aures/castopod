<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\PersonModel;

class Person extends BaseController
{
    /**
     * @var \App\Entities\Person|null
     */
    protected $person;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (
                !($this->person = (new PersonModel())->getPersonById(
                    $params[0]
                ))
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function index()
    {
        $data = ['persons' => (new PersonModel())->findAll()];

        return view('admin/person/list', $data);
    }

    public function view()
    {
        $data = ['person' => $this->person];

        replace_breadcrumb_params([0 => $this->person->full_name]);
        return view('admin/person/view', $data);
    }

    public function create()
    {
        helper(['form']);

        return view('admin/person/create');
    }

    public function attemptCreate()
    {
        $rules = [
            'image' =>
                'is_image[image]|ext_in[image,jpg,jpeg,png]|min_dims[image,400,400]|is_image_squared[image]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $person = new \App\Entities\Person([
            'full_name' => $this->request->getPost('full_name'),
            'unique_name' => $this->request->getPost('unique_name'),
            'information_url' => $this->request->getPost('information_url'),
            'image' => $this->request->getFile('image'),
            'created_by' => user()->id,
            'updated_by' => user()->id,
        ]);

        $personModel = new PersonModel();

        if (!$personModel->insert($person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-list');
    }

    public function edit()
    {
        helper('form');

        $data = [
            'person' => $this->person,
        ];

        replace_breadcrumb_params([0 => $this->person->full_name]);
        return view('admin/person/edit', $data);
    }

    public function attemptEdit()
    {
        $rules = [
            'image' =>
                'is_image[image]|ext_in[image,jpg,jpeg,png]|min_dims[image,400,400]|is_image_squared[image]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->person->full_name = $this->request->getPost('full_name');
        $this->person->unique_name = $this->request->getPost('unique_name');
        $this->person->information_url = $this->request->getPost(
            'information_url'
        );
        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $this->person->image = $image;
        }

        $this->updated_by = user();

        $personModel = new PersonModel();
        if (!$personModel->update($this->person->id, $this->person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-view', [$this->person->id]);
    }

    public function delete()
    {
        (new PersonModel())->delete($this->person->id);

        return redirect()->route('person-list');
    }
}
