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
use Exception;

class BlockController extends Controller
{
    /**
     * @var list<string>
     */
    protected $helpers = ['fediverse'];

    public function attemptBlockActor(): RedirectResponse
    {
        $rules = [
            'handle' => 'required|regex_match[/^@?([\w\.\-]+)@([\w\.\-]+)(:[\d]+)?$/]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $handle = $validData['handle'];

        if ($parts = split_handle($handle)) {
            try {
                $actor = get_or_create_actor($parts['username'], $parts['domain']);
            } catch (Exception) {
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

        $validData = $this->validator->getValidated();

        model('ActorModel', false)
            ->unblockActor((int) $validData['actor_id']);

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.unblockActorSuccess'));
    }

    public function attemptBlockDomain(): RedirectResponse
    {
        $rules = [
            'domain' => 'required|regex_match[/^[\w\-\.]+[\w]+(:[\d]+)?/]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $domain = $validData['domain'];
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

        $validData = $this->validator->getValidated();

        $domain = $validData['domain'];
        model('BlockedDomainModel', false)
            ->unblockDomain($domain);

        return redirect()->back()
            ->with('message', lang('Fediverse.messages.unblockDomainSuccess', [
                'domain' => $domain,
            ]));
    }
}
