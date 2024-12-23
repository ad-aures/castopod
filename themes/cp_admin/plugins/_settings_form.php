<form method="POST" action="<?= $action ?>" class="flex flex-col max-w-xl gap-4 p-4 sm:p-6 md:p-8 bg-elevated border-3 border-subtle rounded-xl" >
<?= csrf_field() ?>
<?php $hasDatetime = false; ?>
<?php foreach ($fields as $field): ?>
    <?php if ($field->type === 'datetime') {
        $hasDatetime = true;
    } ?>
    <?php if ($field->multiple):
        if ($field->type === 'group'): ?>
            <div class="flex flex-col gap-4" data-field-array="<?= $field->key ?>">
                <fieldset class="flex flex-col gap-6 rounded" data-field-array-container="<?= $field->key ?>">
                    <legend class="relative z-10 mb-4 font-bold text-heading-foreground font-display before:w-full before:absolute before:h-1/2 before:left-0 before:bottom-0 before:rounded-full before:bg-heading-background before:z-[-10] tracking-wide text-base"><?= $field->label ?></legend>
                    <?php
                    $fieldArrayValues = get_plugin_setting($plugin->getKey(), $field->key, $context) ?? [''];
            foreach ($fieldArrayValues as $index => $value): ?>
                        <fieldset class="relative flex flex-col border border-subtle p-4 rounded-tl-none rounded-md gap-2 bg-base" data-field-array-item="<?= $index ?>">
                            <legend class="absolute font-mono left-0 -top-px -ml-6 rounded-l-full rounded-r-none w-6 text-xs h-6 inline-flex items-center justify-center font-semibold border border-subtle bg-base"><span class="sr-only"><?= $field->label ?></span> <span data-field-array-number><?= $index + 1 ?></span></legend>
                            <?php foreach ($field->fields as $subfield): ?>
                                <?= $subfield->render(sprintf('%s[%s][%s]', $field->key, $index, $subfield->key), $value[$subfield->key] ?? null, 'flex-1'); ?>
                            <?php endforeach; ?>
                            <x-IconButton variant="danger" glyph="delete-bin-fill" data-field-array-delete="<?= $index ?>" class="absolute right-0 top-0 -mt-4 -mr-4"><?= lang('Common.forms.fieldArray.remove') ?></x-IconButton>
                        </fieldset>
                    <?php endforeach; ?>
                </fieldset>
                <x-Button iconLeft="add-fill" data-field-array-add="<?= $field->key ?>" variant="secondary" type="button" class="mt-2"><?= lang('Common.forms.fieldArray.add') ?></x-Button>
            </div>
        <?php else: ?>
        <div class="flex flex-col gap-4" data-field-array="<?= $field->key ?>">
            <fieldset class="flex flex-col gap-2" data-field-array-container="<?= $field->key ?>">
                <?php $fieldArrayValue = get_plugin_setting($plugin->getKey(), $field->key, $context) ?? [''];
            foreach ($fieldArrayValue as $index => $value): ?>
                    <div class="relative flex items-end" data-field-array-item="<?= $index ?>">
                        <span class="self-start mr-1 -ml-5 w-4 rtl text-sm before:content-['.']" data-field-array-number style="direction:rtl"><?= $index + 1 ?></span>
                        <?= $field->render(sprintf('%s[%s]', $field->key, $index), $value, 'flex-1'); ?>
                        <x-IconButton variant="danger" glyph="delete-bin-fill" data-field-array-delete="<?= $index ?>" type="button" class="mb-2 ml-2"><?= lang('Common.forms.fieldArray.remove') ?></x-IconButton>
                    </div>
                <?php endforeach; ?>
            </fieldset>
            <x-Button iconLeft="add-fill" data-field-array-add="<?= $field->key ?>" variant="secondary" type="button" class="mt-2"><?= lang('Common.forms.fieldArray.add') ?></x-Button>
        </div>
        <?php endif; ?>
    <?php elseif ($field->type === 'group'):
        $value = get_plugin_setting($plugin->getKey(), $field->key, $context); ?>
        <fieldset class="flex flex-col border border-subtle p-4 rounded-tl-none rounded-md gap-2 bg-base">
            <legend class="relative z-10 font-bold text-heading-foreground font-display before:w-full before:absolute before:h-1/2 before:left-0 before:bottom-0 before:rounded-full before:bg-heading-background before:z-[-10] tracking-wide text-base"><?= $field->label ?></legend>
                <?php foreach ($field->fields as $subfield): ?>
                    <?= $subfield->render(sprintf('%s[%s]', $field->key, $subfield->key), $value[$subfield->key] ?? null, 'flex-1'); ?>
                <?php endforeach; ?>
        </fieldset>
    <?php else: ?>
        <?= $field->render($field->key, get_plugin_setting($plugin->getKey(), $field->key, $context)); ?>
    <?php endif; ?>
<?php endforeach; ?>

<?php if ($hasDatetime): ?>
<input type="hidden" name="client_timezone" value="UTC" />
<?php endif; ?>

<x-Button class="self-end mt-4" variant="primary" type="submit"><?= lang('Common.forms.save') ?></x-Button>
</form>

