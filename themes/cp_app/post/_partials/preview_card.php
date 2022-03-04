<?php declare(strict_types=1);

if ($preview_card->type === 'image'): ?>
<a href="<?= $preview_card->url ?>" class="flex flex-col bg-highlight" target="_blank" rel="noopener noreferrer">
    <?php if ($preview_card->image): ?>
    <div class="relative group">
        <?= icon(
    'external-link',
    'absolute inset-0 m-auto text-6xl bg-accent-base bg-opacity-50 group-hover:bg-opacity-100 text-accent-contrast rounded-full p-2',
) ?>
        <img src="<?= $preview_card->image ?>" alt="<?= esc($preview_card->title) ?>" class="object-cover w-full aspect-video" loading="lazy" />
    </div>
    <?php endif; ?>

    <div class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider uppercase text-skin-muted"><?= esc($preview_card->provider_name) ?></span>
    </div>
</a>
<?php elseif ($preview_card->type === 'video'): ?>
<a href="<?= $preview_card->url ?>" class="flex flex-col bg-highlight" target="_blank" rel="noopener noreferrer">
    <?php if ($preview_card->image): ?>
    <div class="relative group">
        <?= icon(
    'play',
    'absolute inset-0 m-auto text-6xl bg-accent-base bg-opacity-50 group-hover:bg-opacity-100 text-accent-contrast rounded-full p-2',
) ?>
        <img class="object-cover w-full aspect-video" src="<?= $preview_card->image ?>" alt="<?= esc($preview_card->title) ?>" loading="lazy" />
    </div>
    <?php endif; ?>

    <div class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider uppercase text-skin-muted"><?= esc($preview_card->provider_name) ?></span>
        <span class="mb-2 font-semibold truncate"><?= esc($preview_card->title) ?></span>
    </div>
</a>
<?php else: ?>
<a href="<?= $preview_card->url ?>" class="flex items-center bg-highlight">
    <?php if ($preview_card->image): ?>
    <img src="<?= $preview_card->image ?>" alt="<?= esc($preview_card->title) ?>" class="object-cover w-20 aspect-square" loading="lazy" />
    <?php endif; ?>
    <p class="flex flex-col flex-1 px-4 py-2">
        <span class="text-xs tracking-wider uppercase text-skin-muted"><?= esc($preview_card->provider_name) ?></span>
        <span class="mb-2 font-semibold truncate"><?= esc($preview_card->title) ?></span>
    </p>
</a>
<?php endif; ?>
