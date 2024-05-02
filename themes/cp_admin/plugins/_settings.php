<form method="POST" action="<?= $action ?>" class="flex flex-col max-w-sm gap-4" >
<?= csrf_field() ?>
<?php foreach ($plugin->settings[$type] as $field): ?>
<Forms.Field
    name="<?= $field['key'] ?>"
    label="<?= $field['name'] ?>"
    hint="<?= $field['description'] ?>"
    value="<?= get_plugin_option($plugin->getKey(), $field['key'], $context) ?>"
/>
<?php endforeach; ?>
<Button class="self-end mt-4" variant="primary" type="submit"><?= lang('Common.forms.save') ?></Button>
</form>