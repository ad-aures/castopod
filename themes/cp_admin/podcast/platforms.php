<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang("Platforms.title.{$platformType}") ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang("Platforms.title.{$platformType}") ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button form="platforms-form" variant="primary" type="submit" class="self-end"><?= lang('Platforms.submit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="platforms-form" action="<?= route_to('platforms-save', $podcast->id, $platformType) ?>" method="POST" class="flex flex-col max-w-md gap-y-8">
<?= csrf_field() ?>

<?php foreach ($platforms as $platform): ?>

<div class="relative flex-col items-start p-4 rounded-lg bg-elevated border-3 <?= $platform->link_url ? 'border-accent-base' : 'border-subtle' ?>">
    <?= $platform->link_url ? anchor(
        route_to(
            'podcast-platform-remove',
            $podcast->id,
            esc($platform->slug),
        ),
        icon('delete-bin', 'mx-auto'),
        [
            'class'        => 'absolute right-0 top-0 -mt-4 -mr-4 p-2 border-red-700 border-2 bg-red-100 rounded-full text-red-700 hover:text-red-900',
            'data-tooltip' => 'bottom',
            'title'        => lang('Platforms.remove', [
                'platformName' => $platform->label,
            ]),
        ],
    )
        : '' ?>
    <div class="flex items-center gap-x-4">
        <?= icon(
            esc($platform->slug),
            'text-skin-muted text-4xl',
            $platform->type
        ) ?>
        <h2 class="text-xl font-semibold"><?= $platform->label ?></h2>
    </div>
    <div class="flex flex-col flex-1 mt-4">
            <div class="inline-flex ml-12 gap-x-2">
                <?= anchor($platform->home_url, icon('external-link', 'mx-auto') . lang('Platforms.website'), [
                    'class'        => 'gap-x-1 flex-shrink-0 inline-flex items-center justify-center font-semibold shadow-xs rounded-full focus:ring-accent px-2 py-1 text-sm border-2 border-accent-base text-accent-base bg-white hover:border-accent-hover hover:text-accent-hover',
                    'target'       => '_blank',
                    'rel'          => 'noopener noreferrer',
                    'data-tooltip' => 'bottom',
                    'title'        => lang('Platforms.home_url', [
                        'platformName' => $platform->label,
                    ]),
                ]) ?>
                <?= $platform->submit_url ? anchor(
                    $platform->submit_url,
                    icon('add') . lang('Platforms.register'),
                    [
                        'class'        => 'gap-x-1 flex-shrink-0 inline-flex items-center justify-center font-semibold shadow-xs rounded-full focus:ring-accent px-2 py-1 text-sm border-2 border-accent-base text-accent-base bg-white hover:border-accent-hover hover:text-accent-hover',
                        'target'       => '_blank',
                        'rel'          => 'noopener noreferrer',
                        'data-tooltip' => 'bottom',
                        'title'        => lang('Platforms.submit_url', [
                            'platformName' => $platform->label,
                        ]),
                    ]
                ) : '' ?>
            </div>
            <fieldset>
                <Forms.Field
                    label="<?= esc(lang('Platforms.your_link')) ?>"
                    class="w-full mt-4"
                    id="<?= esc($platform->slug) . '_link_url' ?>"
                    name="<?= 'platforms[' . esc($platform->slug) . '][url]' ?>"
                    value="<?= esc($platform->link_url) ?>"
                    type="url"
                    placeholder="https://…" />
                <Forms.Field
                    label="<?= esc(lang("Platforms.your_id.{$platform->type}")) ?>"
                    class="w-full mt-2"
                    id="<?= esc($platform->slug) . '_account_id' ?>"
                    name="<?= 'platforms[' . esc($platform->slug) . '][account_id]' ?>"
                    value="<?= esc($platform->account_id) ?>"
                    placeholder="<?= lang("Platforms.description.{$platform->type}") ?>" />
                <Forms.Toggler size="small" class="mt-4 text-sm" id="<?= esc($platform->slug) . '_visible' ?>" name="<?= 'platforms[' . esc($platform->slug) . '][visible]'?>" value="yes" checked="<?= old(esc($platform->slug) . '_visible', $platform->is_visible ? 'true' : 'false') ?>"><?= lang('Platforms.visible') ?></Forms.Toggler>
        </fieldset>
    </div>
</div>

<?php endforeach; ?>

</form>

<?= $this->endSection() ?>
