<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class BlockController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['fediverse'];

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
                ($actor = get_or_create_actor($parts['username'], $parts['domain'])) === null
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', lang('Fediverse.messages.actorNotFound'));
            }

            model('ActorModel', false)
                ->blockActor($actor->id);
        }

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.blockActorSuccess', [
                'actor' => $handle,
            ]));
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

        model('ActorModel', false)
            ->unblockActor((int) $this->request->getPost('actor_id'));

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.unblockActorSuccess'));
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

        $domain = $this->request->getPost('domain');
        model('BlockedDomainModel', false)
            ->blockDomain($domain);

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.blockDomainSuccess', [
                'domain' => $domain,
            ]));
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

        $domain = $this->request->getPost('domain');
        model('BlockedDomainModel', false)
            ->unblockDomain($domain);

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.unblockDomainSuccess', [
                'domain' => $domain,
            ]));
    }
}
