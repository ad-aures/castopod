<?php declare(strict_types=1);

$isPodcastArea = isset($podcast) && ! isset($episode);
$isEpisodeArea = isset($podcast) && isset($episode);
?>

<div data-sidebar-toggler="backdrop" role="button" tabIndex="0" aria-label="<?= lang('Common.close') ?>" class="fixed z-50 hidden w-full h-full bg-gray-800/75 md:hidden"></div>
<aside data-sidebar-toggler="sidebar" data-toggle-class="-translate-x-full" data-hide-class="-translate-x-full" class="h-full max-h-[calc(100vh-40px)] sticky z-50 flex flex-col row-start-2 col-start-1 text-white transition duration-200 ease-in-out transform -translate-x-full border-r top-10 border-navigation bg-navigation md:translate-x-0">
    <?php if ($isEpisodeArea): ?>
        <?= $this->include('episode/_sidebar') ?>
    <?php elseif ($isPodcastArea): ?>
        <?= $this->include('podcast/_sidebar') ?>
    <?php else: ?>
        <?= $this->include('_sidebar') ?>
    <?php endif; ?>
    <footer class="px-2 py-2 mx-auto text-xs text-right">
        <?= lang('Common.powered_by', [
            'castopod' => '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social:castopod', [
                'class' => 'ml-1 text-lg',
            ]) . '</a> ' .
                CP_VERSION,
        ], null, false) ?>
    </footer>
</aside>
