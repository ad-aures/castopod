<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Person;
use App\Models\PersonModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class PersonController extends BaseController
{
    protected ?Person $person;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ($this->person = (new PersonModel())->getPersonById((int) $params[0])) !== null
        ) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        $data = [
            'persons' => (new PersonModel())->findAll(),
        ];

        return view('person/list', $data);
    }

    public function view(): string
    {
        $data = [
            'person' => $this->person,
        ];

        replace_breadcrumb_params([
            0 => $this->person->full_name,
        ]);
        return view('person/view', $data);
    }

    public function create(): string
    {
        helper(['form']);

        return view('person/create');
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'avatar' =>
                'is_image[avatar]|ext_in[avatar,jpg,jpeg,png]|min_dims[avatar,400,400]|is_image_ratio[avatar,1,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $person = new Person([
            'avatar' => $this->request->getFile('avatar'),
            'full_name' => $this->request->getPost('full_name'),
            'unique_name' => $this->request->getPost('unique_name'),
            'information_url' => $this->request->getPost('information_url'),
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        $personModel = new PersonModel();

        if (! $personModel->insert($person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-list');
    }

    public function edit(): string
    {
        helper('form');

        $data = [
            'person' => $this->person,
        ];

        replace_breadcrumb_params([
            0 => $this->person->full_name,
        ]);
        return view('person/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        $rules = [
            'avatar' =>
                'is_image[avatar]|ext_in[avatar,jpg,jpeg,png]|min_dims[avatar,400,400]|is_image_ratio[avatar,1,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->person->full_name = $this->request->getPost('full_name');
        $this->person->unique_name = $this->request->getPost('unique_name');
        $this->person->information_url = $this->request->getPost('information_url');

        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile !== null && $avatarFile->isValid()) {
            $this->person->avatar = new Image($avatarFile);
        }

        $this->person->updated_by = user_id();

        $personModel = new PersonModel();
        if (! $personModel->update($this->person->id, $this->person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-view', [$this->person->id]);
    }

    public function delete(): RedirectResponse
    {
        (new PersonModel())->delete($this->person->id);

        return redirect()->route('person-list');
    }
}
