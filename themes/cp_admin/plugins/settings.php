<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>
<form method="POST" action="<?= route_to('plugins-settings-action', $plugin->getKey()) ?>" class="flex flex-col max-w-sm gap-4" >
<?= csrf_field() ?>
<?php foreach ($plugin->options['settings'] as $option): ?>
<Forms.Field
name="<?= $option['key'] ?>"
label="<?= $option['name'] ?>"
hint="<?= $option['description'] ?>"
/>
<?php endforeach; ?>
<Button class="self-end mt-4" variant="primary" type="submit"><?= lang('Plugins.form.save') ?></Button>
</form>
<?= $this->endSection() ?>
