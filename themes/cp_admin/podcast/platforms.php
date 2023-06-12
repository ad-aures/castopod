<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button form="platforms-form" variant="primary" type="submit" class="self-end"><?= lang('Platforms.submit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="platforms-form" action="<?= route_to('platforms-save', $podcast->id, $platformType) ?>" method="POST" class="flex flex-col max-w-md">
<?= csrf_field() ?>

<?php foreach ($platforms as $platform): ?>

<div class="relative flex items-start mb-8">
    <div class="flex flex-col items-center w-12 mr-4">
        <?php if ($platform->submit_url === ''): ?>
            <?= icon(
                esc($platform->slug),
                'text-skin-muted text-4xl',
                $platform->type
            ) ?>
        <?php else: ?>
            <?= anchor(
                $platform->submit_url,
                icon(
                    esc($platform->slug),
                    'text-skin-muted text-4xl',
                    $platform->type
                ),
                [
                    'class'        => 'text-skin-muted hover:text-skin-base',
                    'target'       => '_blank',
                    'rel'          => 'noopener noreferrer',
                    'data-tooltip' => 'bottom',
                    'title'        => lang('Platforms.submit_url', [
                        'platformName' => $platform->label,
                    ]),
                ],
            ) ?>
        <?php endif; ?>
        <div class="inline-flex mt-1 bg-highlight">
            <?= anchor($platform->home_url, icon('external-link', 'mx-auto'), [
                'class'        => 'flex-1 text-skin-muted hover:text-skin-base',
                'target'       => '_blank',
                'rel'          => 'noopener noreferrer',
                'data-tooltip' => 'bottom',
                'title'        => lang('Platforms.home_url', [
                    'platformName' => $platform->label,
                ]),
            ]) ?>
            <?= $platform->submit_url
                            ? anchor($platform->submit_url, icon('add', 'mx-auto'), [
                                'class'        => 'flex-1 text-skin-muted hover:text-skin-base',
                                'target'       => '_blank',
                                'rel'          => 'noopener noreferrer',
                                'data-tooltip' => 'bottom',
                                'title'        => lang('Platforms.submit_url', [
                                    'platformName' => $platform->label,
                                ]),
                            ])
                            : '' ?>
        </div>
    </div>
    <div class="flex flex-col flex-1">
        <?= $platform->link_url
                        ? anchor(
                            route_to(
                                'podcast-platform-remove',
                                $podcast->id,
                                esc($platform->slug),
                            ),
                            icon('delete-bin', 'mx-auto'),
                            [
                                'class'        => 'absolute right-0 p-1 bg-red-100 rounded-full text-red-700 hover:text-red-900',
                                'data-tooltip' => 'bottom',
                                'title'        => lang('Platforms.remove', [
                                    'platformName' => $platform->label,
                                ]),
                            ],
                        )
                        : '' ?>
        <fieldset>
            <legend class="mb-2 font-semibold"><?= $platform->label ?></legend>
            <Forms.Input
                class="w-full mb-1"
                id="<?= esc($platform->slug) . '_link_url' ?>"
                name="<?= 'platforms[' . esc($platform->slug) . '][url]' ?>"
                value="<?= esc($platform->link_url) ?>"
                type="url"
                placeholder="https://…" />
            <Forms.Input
                class="w-full mb-1"
                id="<?= esc($platform->slug) . '_account_id' ?>"
                name="<?= 'platforms[' . esc($platform->slug) . '][account_id]' ?>"
                value="<?= esc($platform->account_id) ?>"
                placeholder="<?= lang("Platforms.description.{$platform->type}") ?>" />
            <Forms.Toggler size="small" class="text-sm" id="<?= esc($platform->slug) . '_visible' ?>" name="<?= 'platforms[' . esc($platform->slug) . '][visible]'?>" value="yes" checked="<?= old(esc($platform->slug) . '_visible', $platform->is_visible ? 'true' : 'false') ?>"><?= lang('Platforms.visible') ?></Forms.Toggler>
        </fieldset>
    </div>
</div>

<?php endforeach; ?>

</form>

<?= $this->endSection() ?>
