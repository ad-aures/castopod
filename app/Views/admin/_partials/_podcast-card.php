<article class="w-48 h-full mb-4 mr-4 overflow-hidden bg-white border rounded shadow">
    <img alt="<?= $podcast->title ?>" src="<?= $podcast->image_url ?>" class="object-cover w-full h-40" />
    <div class="p-2">
        <a href="<?= route_to(
            'podcast_view',
            $podcast->id
        ) ?>" class="hover:underline">
            <h2 class="font-semibold"><?= $podcast->title ?></h2>
        </a>
        <p class="text-gray-600">@<?= $podcast->name ?></p>
    </div>
    <footer class="flex items-center justify-end p-2">
        <a class="inline-flex p-2 mr-2 text-teal-700 bg-teal-100 rounded-full shadow-xs hover:bg-teal-200" href="<?= route_to(
            'podcast_edit',
            $podcast->id
        ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.edit'
) ?>"><?= icon('edit') ?></a>
        <a class="inline-flex p-2 bg-gray-100 rounded-full shadow-xs text-teal-gray hover:bg-gray-200" href="<?= route_to(
            'podcast_view',
            $podcast->id
        ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.view'
) ?>"><?= icon('eye') ?></a>
    </footer>
</article>
