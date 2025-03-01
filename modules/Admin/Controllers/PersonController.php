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
    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ($person = (new PersonModel())->getPersonById((int) $params[0])) instanceof Person
        ) {
            return $this->{$method}($person);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        $data = [
            'persons' => (new PersonModel())->orderBy('full_name')
                ->findAll(),
        ];

        $this->setHtmlHead(lang('Person.all_persons'));
        return view('person/list', $data);
    }

    public function view(Person $person): string
    {
        $data = [
            'person' => $person,
        ];

        $this->setHtmlHead($person->full_name);
        replace_breadcrumb_params([
            0 => $person->full_name,
        ]);
        return view('person/view', $data);
    }

    public function createView(): string
    {
        helper(['form']);

        $this->setHtmlHead(lang('Person.create'));
        return view('person/create');
    }

    public function createAction(): RedirectResponse
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

    public function editView(Person $person): string
    {
        helper('form');

        $data = [
            'person' => $person,
        ];

        $this->setHtmlHead(lang('Person.edit'));
        replace_breadcrumb_params([
            0 => $person->full_name,
        ]);
        return view('person/edit', $data);
    }

    public function editAction(Person $person): RedirectResponse
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

        $person->updated_by = user_id();
        $person->full_name = $this->request->getPost('full_name');
        $person->unique_name = $this->request->getPost('unique_name');
        $person->information_url = $this->request->getPost('information_url');
        $person->setAvatar($this->request->getFile('avatar'));

        $personModel = new PersonModel();
        if (! $personModel->update($person->id, $person)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $personModel->errors());
        }

        return redirect()->route('person-edit', [$person->id])->with(
            'message',
            lang('Person.messages.editSuccess'),
        );
    }

    public function deleteAction(Person $person): RedirectResponse
    {
        if ($person->avatar_id !== null) {
            // delete avatar to prevent collision if recreating person
            (new MediaModel())->deleteMedia($person->avatar);
        }

        (new PersonModel())->delete($person->id);

        return redirect()->route('person-list')
            ->with('message', lang('Person.messages.deleteSuccess'));
    }
}
