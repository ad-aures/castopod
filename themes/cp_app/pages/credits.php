<?= $this->extend('pages/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.credits') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
    <?php foreach ($credits as $groupSlug => $groups): ?>
        <?php if ($groupSlug): ?>
            <h2 class="col-span-1 mt-12 mb-2 text-xl font-semibold text-skin-muted md:text-2xl md:col-span-2 "><?= $groups[
                'group_label'
            ] ?></h2>
        <?php endif; ?>
        <?php foreach ($groups['persons'] as $persons): ?>
            <div class="flex mt-2 mb-2">
                <img src="<?= $persons['thumbnail_url'] ?>" alt="<?= esc($persons[
    'full_name'
]) ?>" class="object-cover w-16 rounded-full aspect-square md:h-24 md:w-24 border-gray" loading="lazy" />
                <div class="flex flex-col ml-3 mr-4">
                    <span class="text-lg font-semibold text-skin-muted md:text-xl">
                        <?= esc($persons['full_name']) ?>
                    </span>
                    <?php if ($persons['information_url'] !== null): ?>
                        <a href="<?= esc($persons[
                            'information_url'
                        ]) ?>" class="text-sm font-semibold text-accent-base hover:underline" target="_blank" rel="noreferrer noopener"><?= $persons[
    'information_url'
] ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex flex-col">
                <?php foreach ($persons['roles'] as $role): ?>
                    <?= $role['role_label'] ?>

                    <?php foreach ($role['is_in'] as $in): ?>
                        <a href="<?= esc($in[
                            'link'
                        ]) ?>" class="text-sm text-skin-muted hover:underline"><?= $in['title'] ?></a>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<?php $this->endSection(); ?>
