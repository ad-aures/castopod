<aside id="admin-sidebar" class="h-full max-h-[calc(100vh-40px)] sticky z-50 flex flex-col row-start-2 col-start-1 text-white transition duration-200 ease-in-out transform -translate-x-full border-r top-10 border-pine-900 bg-pine-800 md:translate-x-0">
    <?php if (isset($podcast) && isset($episode)): ?>
        <?= $this->include('episode/_sidebar') ?>
    <?php elseif (isset($podcast)): ?>
        <?= $this->include('podcast/_sidebar') ?>
    <?php else: ?>
        <?= $this->include('_sidebar') ?>
    <?php endif; ?>
    <footer class="px-2 py-2 mx-auto text-xs text-right">
        <?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="inline-flex font-semibold hover:underline focus:ring-castopod" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a> ' .
                CP_VERSION,
        ]) ?>
    </footer>
</aside>