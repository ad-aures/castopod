<form method="POST" action="<?= $action ?>" class="flex flex-col max-w-sm gap-4" >
<?= csrf_field() ?>
<?php foreach ($plugin->settings[$type] as $field): ?>
<Forms.Field
    name="<?= esc($field['key']) ?>"
    label="<?= esc($field['label']) ?>"
    hint="<?= esc($field['hint']) ?>"
    helper="<?= esc($field['helper']) ?>"
    required="<?= $field['optional'] === 'true' ? 'false' : 'true' ?>"
    value="<?= get_plugin_option($plugin->getKey(), $field['key'], $context) ?>"
/>
<?php endforeach; ?>
<Button class="self-end mt-4" variant="primary" type="submit"><?= lang('Common.forms.save') ?></Button>
</form>