<header id="main-header" class="fixed top-0 left-0 flex-col flex-shrink-0 h-screen transform -translate-x-full sm:left-auto sm:-translate-x-0 sm:sticky w-80 sm:w-64 lg:w-80 xl:w-112 sm:flex">
    <img src="<?= $podcast->actor
        ->cover_image_url ?>" alt="" class="object-cover w-full h-48 bg-pine-900"/>
    <div class="flex items-center justify-between px-4 py-2 mb-4 lg:px-6 -mt-14 lg:-mt-16 xl:-mt-20">
        <img src="<?= $podcast->image
            ->thumbnail_url ?>" alt="<?= $podcast->title ?>" class="h-24 rounded-full shadow-xl xl:h-36 lg:h-28 ring-4 ring-pine-50" />
        <?= anchor_popup(
            route_to('follow', $podcast->name),
            icon(
                'social/castopod',
                'mr-2 text-xl text-pink-200 group-hover:text-pink-50',
            ) . lang('Podcast.follow'),
            [
                'width' => 420,
                'height' => 620,
                'class' =>
                    'group inline-flex items-center px-4 py-2 text-xs tracking-wider font-semibold text-white uppercase rounded-full shadow focus:outline-none focus:ring bg-rose-600',
            ],
        ) ?>
    </div>
    <div class="px-6">
        <h1 class="inline-flex items-center text-2xl font-bold leading-none font-display"><?= $podcast->title .
            ($podcast->parental_advisory === 'explicit'
                ? '<span class="px-1 ml-2 text-xs font-semibold leading-tight tracking-wider text-gray-600 uppercase border-2 border-gray-500">' .
                    lang('Common.explicit') .
                    '</span>'
                : '') ?></h1>
        <p class="mb-4 font-semibold text-gray-600">@<?= $podcast->name ?></p>
        <div class="mb-2"><?= $podcast->description_html ?></div>
        <?php if ($podcast->location_name): ?>
            <?= location_link(
                $podcast->location_name,
                $podcast->location_geo,
                $podcast->location_osmid,
                'text-sm mb-4',
            ) ?>
        <?php endif; ?>
        <div class="mb-6 space-x-4">
            <span class="px-2 py-1 text-sm text-gray-800 bg-gray-200">
                <?= lang(
                    'Podcast.category_options.' . $podcast->category->code,
                ) ?>
            </span>
            <?php foreach ($podcast->other_categories as $other_category): ?>
                <span class="px-2 py-1 text-sm text-gray-800 bg-gray-200">
                    <?= lang(
                        'Podcast.category_options.' . $other_category->code,
                    ) ?>
                </span>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($persons)): ?>
        <div class="flex w-full mb-6 space-x-2 overflow-y-auto">
            <?php foreach ($persons as $person): ?>
                <?php if ($person['information_url']): ?>
                    <a href="<?= $person[
                        'information_url'
                    ] ?>" target="_blank" rel="noreferrer noopener" class="flex-shrink-0">
                        <img
                        src="<?= $person['thumbnail_url'] ?>"
                        alt="<?= $person['full_name'] ?>"
                        class="object-cover w-12 h-12 rounded-full"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="[<?= $person['full_name'] ?>] <?= $person[
    'roles'
] ?>" />
                    </a>
                <?php else: ?>
                    <img
                    src="<?= $person['thumbnail_url'] ?>"
                    alt="<?= $person['full_name'] ?>"
                    class="object-cover w-12 h-12 rounded-full"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="[<?= $person['full_name'] ?>] <?= $person[
    'roles'
] ?>" />
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="space-x-4">
            <a href="#" class="hover:underline"><?= lang('Podcast.followers', [
                'numberOfFollowers' => $podcast->actor->followers_count,
            ]) ?></a>
            <a href="<?= route_to(
                'podcast-activity',
                $podcast->name,
            ) ?>" class="hover:underline"><?= lang('Podcast.notes', [
    'numberOfNotes' => $podcast->actor->notes_count,
]) ?></a>
        </div>
    </div>
</header>
