<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.credits') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
<?php foreach ($credits as $groupSlug => $groups): ?>
    <?php if ($groupSlug): ?>
    <div class="col-span-1 mt-12 mb-2 text-xl font-semibold text-gray-500 md:text-2xl md:col-span-2 "><?= $groups[
        'group_label'
    ] ?></div>
    <?php endif; ?>
    <?php foreach ($groups['persons'] as $personId => $persons): ?>
        <div class="flex mt-2 mb-2">
            <img
            src="<?= $persons['thumbnail_url'] ?>"
            alt="<?= $persons['full_name'] ?>"
            class="object-cover w-16 h-16 border-4 rounded-full md:h-24 md:w-24 border-gray" />
            <div class="flex flex-col ml-3 mr-4">
                <span class="text-lg font-semibold text-gray-700 md:text-xl">
                    <?= $persons['full_name'] ?>
                </span>
                <?php if (!empty($persons['information_url'])): ?>
                <a href="<?= $persons['information_url'] ?>"
                class="text-sm text-blue-800 hover:underline" target="_blank" rel="noreferrer noopener"><?= $persons[
                    'information_url'
                ] ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="flex flex-col">
        <?php foreach ($persons['roles'] as $role_slug => $role_array): ?>
            <?= $role_array['role_label'] ?>
            
            <?php foreach ($role_array['is_in'] as $isIn): ?>
               <a
               href="<?= $isIn['link'] ?>"
               class="text-sm text-gray-500 hover:underline"><?= $isIn[
                   'title'
               ] ?></a>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
</div>

<?php $this->endSection(); ?>
