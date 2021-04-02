<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Platforms.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('platforms-save', $podcast->id, $platformType), [
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<?php foreach ($platforms as $platform): ?>

<div class="relative flex items-start mb-8">
    <div class="flex flex-col items-center w-12 mr-4">
        <?= anchor(
            $platform->submit_url,
            icon(
                $platform->type . '/' . $platform->slug,
                'text-gray-600 text-4xl',
            ),
            [
                'class' => 'mb-1 text-gray-600 hover:text-gray-900',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => lang('Platforms.submit_url', [
                    'platformName' => $platform->label,
                ]),
            ],
        ) ?>
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
                ? anchor($platform->submit_url, icon('add', 'mx-auto'), [
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
                route_to(
                    'podcast-platform-remove',
                    $podcast->id,
                    $platform->slug,
                ),
                icon('delete-bin', 'mx-auto'),
                [
                    'class' =>
                        'absolute right-0 p-1 bg-red-200 rounded-full text-red-700 hover:text-red-900',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => lang('Platforms.remove', [
                        'platformName' => $platform->label,
                    ]),
                ],
            )
            : '' ?>
        <?= form_label($platform->label, $platform->slug, [
            'class' => 'font-semibold mb-2',
        ]) ?>
        <?= form_input([
            'id' => $platform->slug . '_link_url',
            'name' => 'platforms[' . $platform->slug . '][url]',
            'class' => 'form-input mb-1 w-full',
            'value' => old($platform->slug . '_link_url', $platform->link_url),
            'type' => 'url',
            'placeholder' => 'https://...',
        ]) ?>
        <?= form_input([
            'id' => $platform->slug . '_link_content',
            'name' => 'platforms[' . $platform->slug . '][content]',
            'class' => 'form-input mb-1 w-full',
            'value' => old(
                $platform->slug . '_link_content',
                $platform->link_content,
            ),
            'type' => 'text',
            'placeholder' => lang("Platforms.description.{$platform->type}"),
        ]) ?>
        <?= form_switch(
            lang('Platforms.visible'),
            [
                'id' => $platform->slug . '_visible',
                'name' => 'platforms[' . $platform->slug . '][visible]',
            ],
            'yes',
            old(
                $platform->slug . '_visible',
                $platform->is_visible ? $platform->is_visible : false,
            ),
            'text-sm mb-1',
        ) ?>
        <?= form_switch(
            lang('Platforms.on_embeddable_player'),
            [
                'id' => $platform->slug . '_on_embeddable_player',
                'name' =>
                    'platforms[' . $platform->slug . '][on_embeddable_player]',
            ],
            'yes',
            old(
                $platform->slug . '_on_embeddable_player',
                $platform->is_on_embeddable_player
                    ? $platform->is_on_embeddable_player
                    : false,
            ),
            'text-sm',
        ) ?>
    </div>
</div>

<?php endforeach; ?>

<?= button(
    lang('Platforms.submit'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
