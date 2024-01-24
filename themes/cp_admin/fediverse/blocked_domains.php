<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Fediverse.blocked_domains') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Fediverse.blocked_domains') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('fediverse-attempt-block-domain') ?>" method="POST" class="flex flex-col max-w-md">
    <?= csrf_field() ?>

    <Forms.Field
        name="domain"
        label="<?= esc(lang('Fediverse.block_lists_form.domain')) ?>"
        required="true" />
    <Button variant="primary" type="submit" class="self-end"><?= lang('Fediverse.block_lists_form.submit') ?></Button>
</form>

<?= data_table(
    [
        [
            'header' => lang('Fediverse.list.actor'),
            'cell'   => function ($blockedDomain) {
                return esc($blockedDomain->name);
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($blockedDomain) {
                return '<form action="' .
                    route_to('fediverse-attempt-unblock-domain') .
                    '" method="POST">' .
                    '<input name="domain" type="hidden" value="' .
                    esc($blockedDomain->name) .
                    '" />' .
                    csrf_field() .
                    '<Button uri="' . route_to('fediverse-unblock-domain', esc($blockedDomain->name)) . '" variant="info" size="small" type="submit">' . lang('Fediverse.list.unblock') . '</Button>' .
                    '</form>';
            },
        ],
    ],
    $blockedDomains,
    'mt-8'
) ?>

<?= $this->endSection() ?>
