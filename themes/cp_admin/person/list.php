<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.all_persons') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.all_persons') ?> (<?= count($persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Person.create'),
    route_to('person-create'),
    ['variant' => 'primary', 'iconLeft' => 'add'],
    ['class' => 'mr-2'],
) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap">
    <?php if ($persons !== null): ?>
        <?php foreach ($persons as $person): ?>
            <article class="w-48 h-full mb-4 mr-4 overflow-hidden bg-white border rounded shadow">
            <img
            alt="<?= $person->full_name ?>"
            src="<?= $person->image
                ->thumbnail_url ?>" class="object-cover w-full" />
            <div class="p-2">
                <a href="<?= route_to(
                    'person-view',
                    $person->id,
                ) ?>" class="hover:underline">
                    <h2 class="font-semibold"><?= $person->full_name ?></h2>
                </a>
            </div>
            <footer class="flex items-center justify-end p-2">
                <a class="inline-flex p-2 mr-2 text-teal-700 bg-teal-100 rounded-full shadow-xs hover:bg-teal-200" href="<?= route_to(
                    'person-edit',
                    $person->id,
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Person.edit',
) ?>"><?= icon('edit') ?></a>
                <a class="inline-flex p-2 mr-2 text-gray-700 bg-red-100 rounded-full shadow-xs hover:bg-gray-200" href="<?= route_to(
                    'person-delete',
                    $person->id,
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Person.delete',
) ?>"><?= icon('delete-bin') ?></a>
                <a class="inline-flex p-2 text-gray-700 bg-gray-100 rounded-full shadow-xs hover:bg-gray-200" href="<?= route_to(
                    'person-view',
                    $person->id,
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Person.view',
) ?>"><?= icon('eye') ?></a>
            </footer>
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Person.no_person') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
