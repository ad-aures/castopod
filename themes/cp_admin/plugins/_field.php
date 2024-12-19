<?php switch ($type): case 'checkbox': ?>
    <x-Forms.Checkbox
        class="<?= $class ?>"
        name="<?= $name ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        value="<?= $value ? 'yes' : '' ?>"
        defaultValue="<?= $defaultValue ?>"
        ><?= $label ?></x-Forms.Checkbox>
<?php break;
case 'toggler': ?>
    <x-Forms.Toggler
    class="<?= $class ?>"
        name="<?= $name ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        value="<?= $value ? 'yes' : '' ?>"
        defaultValue="<?= $defaultValue ?>"
        ><?= $label ?></x-Forms.Toggler>
<?php break;
case 'radio-group': ?>
    <x-Forms.RadioGroup
    class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        options="<?= $options ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'select': ?>
    <x-Forms.Field
        as="Select"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        options="<?= $options ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'select-multiple': ?>
    <x-Forms.Field
        as="SelectMulti"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        options="<?= $options ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'email': ?>
    <x-Forms.Field
        as="Input"
        class="<?= $class ?>"
        type="email"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'url': ?>
    <x-Forms.Field
        as="Input"
        class="<?= $class ?>"
        type="url"
        placeholder="https://…"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'number': ?>
    <x-Forms.Field
        as="Input"
        class="<?= $class ?>"
        type="number"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'textarea': ?>
    <x-Forms.Field
        as="Textarea"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'html': ?>
    <x-Forms.Field
        as="CodeEditor"
        lang="html"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= htmlspecialchars($value) ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'markdown': ?>
    <x-Forms.Field
        as="MarkdownEditor"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'rss': ?>
    <x-Forms.Field
        as="CodeEditor"
        lang="xml"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= htmlspecialchars($value) ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
case 'datetime': ?>
    <x-Forms.Field
        as="DatetimePicker"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php break;
default: ?>
    <x-Forms.Field
        as="Input"
        class="<?= $class ?>"
        name="<?= $name ?>"
        label="<?= $label ?>"
        hint="<?= $hint ?>"
        helper="<?= $helper ?>"
        isRequired="<?= $optional ? 'false' : 'true' ?>"
        value="<?= $value ?>"
        defaultValue="<?= $defaultValue ?>"
    />
<?php endswitch; ?>
