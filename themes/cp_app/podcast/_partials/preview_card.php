<?php declare(strict_types=1);

if ($preview_card->type === 'image'): ?>
<a href="<?= $preview_card->url ?>" class="flex flex-col bg-gray-100" target="_blank" rel="noopener noreferrer">
    <?php if ($preview_card->image): ?>
    <div class="relative group">
        <?= icon(
    'external-link',
    'absolute inset-0 m-auto text-6xl bg-pine-800 ring-4 ring-white bg-opacity-50 group-hover:bg-opacity-75 text-white rounded-full p-2',
) ?>
        <img src="<?= $preview_card->image ?>" alt="<?= $preview_card->title ?>" class="object-cover w-full h-80" />
    </div>
    <?php endif; ?>

    <div class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider text-gray-600 uppercase"><?= $preview_card->provider_name ?></span>
    </div>
</a>
<?php elseif ($preview_card->type === 'video'): ?>
<a href="<?= $preview_card->url ?>" class="flex flex-col bg-gray-100" target="_blank" rel="noopener noreferrer">
    <?php if ($preview_card->image): ?>
    <div class="relative group">
        <?= icon(
    'play',
    'absolute inset-0 m-auto text-6xl bg-pine-800 ring-4 ring-white bg-opacity-50 group-hover:bg-opacity-75 text-white rounded-full p-2',
) ?>
        <img class="object-cover w-full h-80" src="<?= $preview_card->image ?>" alt="<?= $preview_card->title ?>" />
    </div>
    <?php endif; ?>

    <div class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider text-gray-600 uppercase"><?= $preview_card->provider_name ?></span>
        <span class="mb-2 font-semibold truncate"><?= $preview_card->title ?></span>
    </div>
</a>
<?php else: ?>
<a href="<?= $preview_card->url ?>" class="flex items-center bg-gray-100">
    <?php if ($preview_card->image): ?>
    <img src="<?= $preview_card->image ?>" alt="<?= $preview_card->title ?>" class="object-cover w-20 h-20" />
    <?php endif; ?>
    <p class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider text-gray-600 uppercase"><?= $preview_card->provider_name ?></span>
        <span class="mb-2 font-semibold truncate"><?= $preview_card->title ?></span>
    </p>
</a>
<?php endif;
?>
