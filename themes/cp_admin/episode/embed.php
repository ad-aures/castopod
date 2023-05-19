<?php declare(strict_types=1);

$embedHeight = config('Embed')
->height;

?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.embed.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.embed.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<p><?= lang('Episode.embed.label') ?></p>

<div class="flex w-full mt-6">
    <?php foreach ($themes as $themeKey => $theme): ?>
        <button style="<?= $theme[
            'style'
        ] ?>" class="w-12 h-12 mr-1 border-2 border-gray-400 rounded-lg hover:border-white" title="<?= lang(
            "Episode.embed.{$themeKey}",
        ) ?>" data-type="theme-picker" data-url="<?= $episode->getEmbedUrl(
            $themeKey,
        ) ?>"></button>
    <?php endforeach; ?>
</div>

<iframe name="embed" id="embed" class="w-full max-w-xl mt-6 h-28" frameborder="0" scrolling="no" style="width: 100%;  overflow: hidden;" src="<?= $episode->embed_url ?>"></iframe>

<div class="flex items-center mt-8 gap-x-2">
    <Forms.Textarea readonly="true" class="w-full max-w-xl" name="iframe" rows="2" value="<?= esc("<iframe width=\"100%\" height=\"{$embedHeight}\" frameborder=\"0\" scrolling=\"no\" style=\"width: 100%; height: {$embedHeight}px; overflow: hidden;\" src=\"{$episode->embed_url}\"></iframe>") ?>" />
    <IconButton glyph="file-copy" data-type="clipboard-copy" data-clipboard-target="iframe"><?= lang('Episode.embed.clipboard_iframe') ?></IconButton>
</div>

<div class="flex items-center mt-4 gap-x-2">
    <Forms.Input readonly="true" class="w-full max-w-xl" name="url" value="<?= esc($episode->embed_url) ?>" />
    <IconButton glyph="file-copy" data-type="clipboard-copy" data-clipboard-target="url"><?= lang('Episode.embed.clipboard_url') ?></IconButton>
</div>

<?= $this->endSection() ?>
