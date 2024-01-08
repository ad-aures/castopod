<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Person;
use App\Models\PersonModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Media\Models\MediaModel;

class PersonController extends BaseController
{
    protected ?Person $person;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ($this->person = (new PersonModel())->getPersonById((int) $params[0])) instanceof Person
        ) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        $data = [
            'persons' => (new PersonModel())->orderBy('full_name')
                ->findAll(),
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
            'avatar' => 'is_image[avatar]|ext_in[avatar,jpg,jpeg,png]|min_dims[avatar,400,400]|is_image_ratio[avatar,1,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $db->transStart();

        $person = new Person([
            'created_by'      => user_id(),
            'updated_by'      => user_id(),
            'full_name'       => $this->request->getPost('full_name'),
            'unique_name'     => $this->request->getPost('unique_name'),
            'information_url' => $this->request->getPost('information_url'),
            'avatar'          => $this->request->getFile('avatar'),
        ]);

        $personModel = new PersonModel();
        if (! $personModel->insert($person)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        $db->transComplete();

        return redirect()->route('person-list')
            ->with('message', lang('Person.messages.createSuccess'));
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
            'avatar' => 'is_image[avatar]|ext_in[avatar,jpg,jpeg,png]|min_dims[avatar,400,400]|is_image_ratio[avatar,1,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->person->updated_by = user_id();
        $this->person->full_name = $this->request->getPost('full_name');
        $this->person->unique_name = $this->request->getPost('unique_name');
        $this->person->information_url = $this->request->getPost('information_url');
        $this->person->setAvatar($this->request->getFile('avatar'));

        $personModel = new PersonModel();
        if (! $personModel->update($this->person->id, $this->person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-edit', [$this->person->id])->with(
            'message',
            lang('Person.messages.editSuccess')
        );
    }

    public function delete(): RedirectResponse
    {
        if ($this->person->avatar_id !== null) {
            // delete avatar to prevent collision if recreating person
            (new MediaModel())->deleteMedia($this->person->avatar);
        }

        (new PersonModel())->delete($this->person->id);

        return redirect()->route('person-list')
            ->with('message', lang('Person.messages.deleteSuccess'));
    }
}
