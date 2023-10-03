<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Class ActionController
 *
 * A generic controller to handle Authentication Actions.
 */
class InteractController extends Controller
{
    public function attemptInteractAsActor(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required|numeric',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        helper('auth');

        set_interact_as_actor((int) $validData['actor_id']);

        return redirect()->back();
    }
}
