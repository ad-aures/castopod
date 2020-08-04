<?php

helper('html'); ?>

<article class="flex w-full max-w-lg mb-4 bg-white border rounded shadow">
    <img src="<?= $episode->image_url ?>" alt="<?= $episode->title ?>" class="object-cover w-32 h-32 rounded-l" />
    <div class="flex flex-col flex-1 px-4 py-2">
        <a href="<?= route_to(
            'episode_view',
            $episode->podcast->id,
            $episode->id
        ) ?>">
            <h3 class="text-xl font-semibold">
                <span class="mr-1 underline hover:no-underline"><?= $episode->title ?></span>
                <span class="text-base font-bold text-gray-600">#<?= $episode->number ?></span>
            </h3>
        </a>
        <div class="relative ml-auto" data-toggle="dropdown">
            <button type="button" class="inline-flex items-center p-1 outline-none focus:shadow-outline" id="moreDropdown" data-popper="button" aria-haspopup="true" aria-expanded="false">
                <?= icon('more') ?>
            </button>
            <nav class="absolute z-10 flex-col hidden py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="moreDropdown" data-popper="menu" data-popper-placement="bottom-start" data-popper-offset-x="0" data-popper-offset-y="0" >
                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                        'episode_edit',
                        $episode->podcast->id,
                        $episode->id
                    ) ?>"><?= lang('Episode.edit') ?></a>
                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                        'episode',
                        $episode->podcast->id,
                        $episode->slug
                    ) ?>"><?= lang('Episode.go_to_page') ?></a>
                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                        'episode_delete',
                        $episode->podcast->id,
                        $episode->id
                    ) ?>"><?= lang('Episode.delete') ?></a>
            </nav>
        </div>
        <audio controls class="mt-auto" preload="none">
            <source src="/<?= $episode->enclosure_media_path ?>" type="<?= $episode->enclosure_type ?>">
            Your browser does not support the audio tag.
        </audio>
    </div>
</article>