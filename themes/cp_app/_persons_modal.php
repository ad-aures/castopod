<div id="persons-list" class="fixed top-0 left-0 z-50 flex items-center justify-center hidden w-screen h-screen">
    <div
    class="absolute w-full h-full bg-pine-800/75"
    role="button"
    data-toggle="persons-list"
    data-toggle-class="hidden"
    aria-label="<?= lang('Common.close') ?>"></div>
    <div class="z-10 w-full max-w-xl bg-white rounded-lg shadow-2xl">
        <div class="flex justify-between px-4 py-2 border-b">
            <h3 class="self-center text-lg"><?= $title ?></h3>
            <button
            data-toggle="persons-list"
            data-toggle-class="hidden"
            aria-label="<?= lang('Common.close') ?>"
            class="self-start p-1 text-2xl"><?= icon('close') ?></button>
        </div>
        <div class="flex flex-col items-start p-4 gap-y-4">
            <?php foreach ($persons as $person): ?>
                <div class="flex gap-x-2">
                    <img src="<?= $person->image->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-10 h-10 rounded-full" />
                    <div class="flex flex-col">
                        <h4 class="text-sm font-semibold hover:underline focus:ring">
                            <?php if ($person->information_url): ?>
                                <a href="<?= $person->information_url ?>" target="_blank" rel="noopener noreferrer"><?= $person->full_name ?></a>
                            <?php else: ?>
                                <?= $person->full_name ?>
                            <?php endif; ?>
                        </h4>
                        <p class="text-xs text-gray-500"><?= implode(
    ', ',
    array_map(function ($role) {
        return lang(
            'PersonsTaxonomy.persons.' .
                                            $role->group .
                                            '.roles.' .
                                            $role->role .
                                            '.label',
        );
    }, $person->roles),
) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>