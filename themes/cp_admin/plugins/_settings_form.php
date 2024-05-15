<form method="POST" action="<?= $action ?>" class="flex flex-col max-w-xl gap-4 p-4 sm:p-6 md:p-8 bg-elevated border-3 border-subtle rounded-xl" >
<?= csrf_field() ?>
<?php $hasDatetime = false; ?>
<?php foreach ($fields as $field): ?>
    <?php switch ($field->type): case 'checkbox': ?>
        <x-Forms.Checkbox
            name="<?= $field->key ?>"
            hint="<?= esc($field->hint) ?>"
            isChecked="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ? 'true' : 'false' ?>"
            ><?= $field->label ?></x-Forms.Checkbox>
    <?php break;
    case 'toggler': ?>
        <x-Forms.Toggler
            name="<?= $field->key ?>"
            hint="<?= esc($field->hint) ?>"
            isChecked="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ? 'true' : 'false' ?>"
            ><?= $field->label ?></x-Forms.Toggler>
    <?php break;
    case 'radio-group': ?>
        <x-Forms.RadioGroup
            label="<?= $field->label ?>"
            name="<?= $field->key ?>"
            options="<?= esc(json_encode($field->getOptionsArray())) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'select': ?>
        <x-Forms.Field
            as="Select"
            name="<?= $field->key ?>"
            label="<?= $field->label ?>"
            options="<?= esc(json_encode($field->getOptionsArray())) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'select-multiple': ?>
        <x-Forms.Field
            as="SelectMulti"
            name="<?= $field->key ?>"
            label="<?= $field->label ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            options="<?= esc(json_encode($field->getOptionsArray())) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= esc(json_encode(get_plugin_option($plugin->getKey(), $field->key, $context))) ?>"
        />
    <?php break;
    case 'email': ?>
        <x-Forms.Field
            as="Input"
            type="email"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'url': ?>
        <x-Forms.Field
            as="Input"
            type="url"
            placeholder="https://…"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'number': ?>
        <x-Forms.Field
            as="Input"
            type="number"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'textarea': ?>
        <x-Forms.Field
            as="Textarea"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'markdown': ?>
        <x-Forms.Field
            as="MarkdownEditor"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    case 'datetime': ?>
        <?php $hasDatetime = true ?>
        <x-Forms.Field
            as="DatetimePicker"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php break;
    default: ?>
        <x-Forms.Field
            as="Input"
            name="<?= $field->key ?>"
            label="<?= esc($field->label) ?>"
            hint="<?= esc($field->hint) ?>"
            helper="<?= esc($field->helper) ?>"
            isRequired="<?= $field->optional ? 'false' : 'true' ?>"
            value="<?= get_plugin_option($plugin->getKey(), $field->key, $context) ?>"
        />
    <?php endswitch; ?>

<?php endforeach; ?>

<?php if ($hasDatetime): ?>
<input type="hidden" name="client_timezone" value="UTC" />
<?php endif; ?>

<x-Button class="self-end mt-4" variant="primary" type="submit"><?= lang('Common.forms.save') ?></x-Button>
</form>