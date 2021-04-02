<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.embeddable_player.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.embeddable_player.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_label(lang('Episode.embeddable_player.label'), 'label') ?>

<div class="flex w-full mt-6 mb-6">
    <?php foreach ($themes as $themeKey => $theme): ?>
        <button style="<?= $theme[
            'style'
        ] ?>" class="w-12 h-12 mr-1 border-2 border-gray-400 rounded-lg hover:border-white" title="<?= lang(
    "Episode.embeddable_player.{$themeKey}",
) ?>" data-type="theme-picker" data-url="<?= $episode->getEmbeddablePlayer(
    $themeKey,
) ?>"></button>
    <?php endforeach; ?>
</div>

<iframe name="embeddable_player" id="embeddable_player" class="w-full h-48 max-w-xl" frameborder="0" scrolling="no" style="width: 100%;  overflow: hidden;" src="<?= $episode->embeddable_player ?>"></iframe>

<div class="flex items-center w-full mt-8">
    <?= form_textarea(
        [
            'id' => 'iframe',
            'name' => 'iframe',
            'class' => 'form-textarea w-full h-20 mr-2',
        ],
        "<iframe width=\"100%\" height=\"280\" frameborder=\"0\" scrolling=\"no\" style=\"width: 100%; height: 280px; overflow: hidden;\" src=\"{$episode->embeddable_player}\"></iframe>",
    ) ?>
    <?= icon_button(
        'file-copy',
        lang('Episode.embeddable_player.clipboard_iframe'),
        null,
        ['variant' => 'default'],
        ['data-type' => 'clipboard-copy', 'data-clipboard-target' => 'iframe'],
    ) ?>
</div>

<div class="flex items-center w-full mt-4">
    <?= form_textarea(
        [
            'id' => 'url',
            'name' => 'url',
            'class' => 'form-textarea w-full h-10 mr-2',
        ],
        $episode->embeddable_player,
    ) ?>
    <?= icon_button(
        'file-copy',
        lang('Episode.embeddable_player.clipboard_url'),
        null,
        ['variant' => 'default'],
        ['data-type' => 'clipboard-copy', 'data-clipboard-target' => 'url'],
    ) ?>
</div>

<?= $this->endSection() ?>
