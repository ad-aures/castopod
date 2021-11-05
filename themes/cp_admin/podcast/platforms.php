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
        <?= anchor(
    $platform->submit_url,
    icon(
        $platform->type . '/' . $platform->slug,
        'text-skin-muted text-4xl',
    ),
    [
        'class' => 'mb-1 text-skin-muted hover:text-skin-base',
        'target' => '_blank',
        'rel' => 'noopener noreferrer',
        'data-tooltip' => 'bottom',
        'title' => lang('Platforms.submit_url', [
            'platformName' => $platform->label,
        ]),
    ],
) ?>
        <div class="inline-flex bg-highlight">
            <?= anchor($platform->home_url, icon('external-link', 'mx-auto'), [
                'class' => 'flex-1 text-skin-muted hover:text-skin-base',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-tooltip' => 'bottom',
                'title' => lang('Platforms.home_url', [
                    'platformName' => $platform->label,
                ]),
            ]) ?>
            <?= $platform->submit_url
                ? anchor($platform->submit_url, icon('add', 'mx-auto'), [
                    'class' => 'flex-1 text-skin-muted hover:text-skin-base',
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer',
                    'data-tooltip' => 'bottom',
                    'title' => lang('Platforms.submit_url', [
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
                    $platform->slug,
                ),
                icon('delete-bin', 'mx-auto'),
                [
                    'class' =>
                        'absolute right-0 p-1 bg-red-100 rounded-full text-red-700 hover:text-red-900',
                    'data-tooltip' => 'bottom',
                    'title' => lang('Platforms.remove', [
                        'platformName' => $platform->label,
                    ]),
                ],
            )
            : '' ?>
        <fieldset>
            <legend class="mb-2 font-semibold"><?= $platform->label ?></legend>
            <Forms.Input
                class="w-full mb-1"
                id="<?= $platform->slug . '_link_url' ?>"
                name="<?= 'platforms[' . $platform->slug . '][url]' ?>"
                value="<?= $platform->link_url ?>"
                type="url"
                placeholder="https://…" />
            <Forms.Input
                class="w-full mb-1"
                id="<?= $platform->slug . '_link_content' ?>"
                name="<?= 'platforms[' . $platform->slug . '][content]' ?>"
                value="<?= $platform->link_content ?>"
                placeholder="<?= lang("Platforms.description.{$platform->type}") ?>" />
            <Forms.Toggler size="small" class="text-sm" id="<?= $platform->slug . '_visible' ?>" name="<?= 'platforms[' . $platform->slug . '][visible]'?>" value="yes" checked="<?= old($platform->slug . '_visible', $platform->is_visible ? $platform->is_visible : false) ?>"><?= lang('Platforms.visible') ?></Forms.Toggler>
            <Forms.Toggler size="small" class="text-sm" id="<?= $platform->slug . '_on_embed' ?>" name="<?= 'platforms[' . $platform->slug . '][on_embed]'?>" value="yes" checked="<?= old($platform->slug . '_on_embed', $platform->is_on_embed ? $platform->is_on_embed : false) ?>"><?= lang('Platforms.on_embed') ?></Forms.Toggler>
        </fieldset>
    </div>
</div>

<?php endforeach; ?>

</form>

<?= $this->endSection() ?>
