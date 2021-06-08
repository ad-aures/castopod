<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class BlockController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['activitypub'];

    public function attemptBlockActor(): RedirectResponse
    {
        $rules = [
            'handle' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $handle = $this->request->getPost('handle');

        if ($parts = split_handle($handle)) {
            if (
                ($actor = get_or_create_actor($parts['username'], $parts['domain'],)) === null
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Actor not found.');
            }

            model('ActorModel')
                ->blockActor($actor->id);
        }

        return redirect()->back();
    }

    public function attemptBlockDomain(): RedirectResponse
    {
        $rules = [
            'domain' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        model('BlockedDomainModel')
            ->blockDomain($this->request->getPost('domain'));

        return redirect()->back();
    }

    public function attemptUnblockActor(): RedirectResponse
    {
        $rules = [
            'actor_id' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        model('ActorModel')
            ->unblockActor($this->request->getPost('actor_id'));

        return redirect()->back();
    }

    public function attemptUnblockDomain(): RedirectResponse
    {
        $rules = [
            'domain' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        model('BlockedDomainModel')
            ->unblockDomain($this->request->getPost('domain'));

        return redirect()->back();
    }
}
