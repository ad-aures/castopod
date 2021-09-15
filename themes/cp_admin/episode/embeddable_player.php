<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.embeddable_player.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.embeddable_player.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<p><?= lang('Episode.embeddable_player.label') ?></p>

<div class="flex w-full mt-6">
    <?php foreach ($themes as $themeKey => $theme): ?>
        <button style="<?= $theme[
            'style'
        ] ?>" class="w-12 h-12 mr-1 border-2 border-gray-400 rounded-lg hover:border-white" title="<?= lang(
            "Episode.embeddable_player.{$themeKey}",
        ) ?>" data-type="theme-picker" data-url="<?= $episode->getEmbeddablePlayerUrl(
            $themeKey,
        ) ?>"></button>
    <?php endforeach; ?>
</div>

<iframe name="embeddable_player" id="embeddable_player" class="w-full max-w-xl mt-6 h-36" frameborder="0" scrolling="no" style="width: 100%;  overflow: hidden;" src="<?= $episode->embeddable_player_url ?>"></iframe>

<div class="flex items-center mt-8 gap-x-2">
    <Forms.Textarea readonly="true" class="w-full max-w-xl" name="iframe" rows="2" value="<?= esc("<iframe width=\"100%\" height=\"280\" frameborder=\"0\" scrolling=\"no\" style=\"width: 100%; height: 280px; overflow: hidden;\" src=\"{$episode->embeddable_player_url}\"></iframe>") ?>" />
    <IconButton glyph="file-copy" data-type="clipboard-copy" data-clipboard-target="iframe"><?= lang('Episode.embeddable_player.clipboard_iframe') ?></IconButton>
</div>

<div class="flex items-center mt-4 gap-x-2">
    <Forms.Input readonly="true" class="w-full max-w-xl" name="url" value="<?= $episode->embeddable_player_url ?>" />
    <IconButton glyph="file-copy" data-type="clipboard-copy" data-clipboard-target="url"><?= lang('Episode.embeddable_player.clipboard_url') ?></IconButton>
</div>

<?= $this->endSection() ?>
