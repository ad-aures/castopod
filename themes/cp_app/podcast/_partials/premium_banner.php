<?php declare(strict_types=1);

if ($podcast->is_premium): ?>
    <?php
        $isUnlocked = service('premium_podcasts')
            ->isUnlocked($podcast->handle);
    // @icon('lock-unlock-fill')
    // @icon('lock-fill')
    $shownIcon = $isUnlocked ? 'lock-unlock-fill' : 'lock-fill';
    $hiddenIcon = $isUnlocked ? 'lock-fill' : 'lock-unlock-fill';
    ?>
    <div class="flex flex-col items-center justify-between col-start-2 px-2 py-1 mt-2 sm:px-1 md:mt-4 rounded-conditional-full gap-y-2 sm:flex-row bg-accent-base gap-x-2 text-accent-contrast">
        <p class="inline-flex items-center text-sm md:pl-4 gap-x-2"><?= $isUnlocked ? lang('PremiumPodcasts.banner_lock') : lang('PremiumPodcasts.banner_unlock') ?></p>
        <?php if ($subscriptionLink = service('settings')->get('Subscription.link', 'podcast:' . $podcast->id)): ?>
            <div class="flex items-center self-end gap-x-2">
                <x-Button
                    variant="primary"
                    class="group"
                    size="small"
                    uri="<?= $isUnlocked ? route_to('premium-podcast-lock', $podcast->handle) : route_to('premium-podcast-unlock', $podcast->handle) ?>"
                >
                    <?= icon($shownIcon, [
                        'class' => 'text-sm group-focus:hidden group-hover:hidden',
                    ]) ?>
                    <?= icon($hiddenIcon, [
                        'class' => 'hidden text-sm group-focus:block group-hover:block',
                    ]) ?>
                    <?= $isUnlocked ? lang('PremiumPodcasts.lock') : lang('PremiumPodcasts.unlock') ?>
                </x-Button>
                <?php // @icon('external-link-fill')?>
                <x-Button
                    iconLeft="external-link-fill"
                    target="_blank"
                    rel="noopener noreferrer"
                    variant="secondary"
                    size="small"
                    class="tracking-wider uppercase"
                    uri="<?= $subscriptionLink ?>"><?= lang('PremiumPodcasts.subscribe') ?></x-Button>
            </div>
        <?php else: ?>
            <x-Button
                variant="primary"
                class="self-end group"
                size="small"
                uri="<?= $isUnlocked ? route_to('premium-podcast-lock', $podcast->handle) : route_to('premium-podcast-unlock', $podcast->handle) ?>"
            >
                <?= icon($shownIcon, [
                    'class' => 'text-sm group-focus:hidden group-hover:hidden',
                ]) ?>
                <?= icon($hiddenIcon, [
                    'class' => 'hidden text-sm group-focus:block group-hover:block',
                ]) ?>
                <?= $isUnlocked ? lang('PremiumPodcasts.lock') : lang('PremiumPodcasts.unlock') ?>
            </x-Button>
        <?php endif; ?>
    </div>
<?php endif; ?>