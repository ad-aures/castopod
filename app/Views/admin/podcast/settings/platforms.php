<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('platforms', $podcast->id), [
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<?php foreach ($platforms as $platform): ?>

<div class="relative flex items-start mb-4">
    <div class="flex flex-col w-12 mr-4">
        <?= platform_icon($platform->icon_filename, 'w-full mb-1') ?>
        <div class="inline-flex bg-gray-200">
            <?= anchor($platform->home_url, icon('external-link', 'mx-auto'), [
                'class' => 'flex-1 text-gray-600 hover:text-gray-900',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => lang('Platforms.home_url', [
                    'platformName' => $platform->label,
                ]),
            ]) ?>
            <?= $platform->submit_url
                ? anchor($platform->submit_url, icon('upload', 'mx-auto'), [
                    'class' => 'flex-1 text-gray-600 hover:text-gray-900',
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
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
                route_to('platforms-remove', $podcast->id, $platform->id),
                icon('delete-bin', 'mx-auto'),
                [
                    'class' =>
                        'absolute right-0 p-1 bg-red-200 rounded-full text-red-700 hover:text-red-900',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => lang('Platforms.remove', [
                        'platformName' => $platform->label,
                    ]),
                ]
            )
            : '' ?>
        <?= form_label($platform->label, $platform->name, [
            'class' => 'font-semibold mb-2',
        ]) ?>
        <?= form_input([
            'id' => $platform->name,
            'name' => 'platforms[' . $platform->name . '][url]',
            'class' => 'form-input mb-1 w-full',
            'value' => old($platform->name, $platform->link_url),
            'type' => 'url',
            'placeholder' => 'https://...',
        ]) ?>
        <label class="inline-flex items-center mb-4 text-sm">
            <?= form_checkbox(
                [
                    'id' => $platform->name . '_visible',
                    'name' => 'platforms[' . $platform->name . '][visible]',
                    'class' => 'form-checkbox',
                ],
                'yes',
                old(
                    $platform->name . '_visible',
                    $platform->visible ? $platform->visible : false
                )
            ) ?>
            <span class="ml-2"><?= lang('Platforms.visible') ?></span>
        </label>
    </div>
</div>

<?php endforeach; ?>

<?= button(
    lang('Platforms.submit'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
