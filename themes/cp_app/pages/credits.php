<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>" class="h-full">

<?= service('html_head')
    ->title(lang('Person.credits') . service('settings')->get('App.siteTitleSeparator') . service('settings')->get('App.siteName'))
    ->description(lang('Page.map.description', [
        'siteName' => esc(service('settings')
            ->get('App.siteName')),
    ]))
?>

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <?php if (auth()->loggedIn()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 border-b bg-elevated border-subtle">
        <div class="container flex flex-col items-start px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>"
            class="inline-flex items-center mb-2 text-sm"><?= icon(
                'arrow-left-line',
                [
                    'class' => 'mr-2',
                ],
            ) . lang('Page.back_to_home') ?></a>
            <x-Heading tagName="h1" size="large"><?= esc($page->title) ?></x-Heading>
        </div>
    </header>
    <main class="container flex-1 px-4 py-6 mx-auto">

<div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
    <?php foreach ($credits as $groupSlug => $groups): ?>
        <?php if ($groupSlug): ?>
            <h2 class="col-span-1 mt-12 mb-2 text-xl font-semibold text-skin-muted md:text-2xl md:col-span-2 "><?= $groups['group_label'] ?></h2>
        <?php endif; ?>
        <?php foreach ($groups['persons'] as $persons): ?>
            <div class="flex mt-2 mb-2">
                <img src="<?= $persons['thumbnail_url'] ?>" alt="<?= esc($persons['full_name']) ?>" class="object-cover w-16 rounded-full aspect-square md:h-24 md:w-24 border-gray" loading="lazy" />
                <div class="flex flex-col ml-3 mr-4">
                    <span class="text-lg font-semibold text-skin-muted md:text-xl">
                        <?= esc($persons['full_name']) ?>
                    </span>
                    <?php if ($persons['information_url'] !== null): ?>
                        <a href="<?= esc($persons['information_url']) ?>" class="text-sm font-semibold text-accent-base hover:underline" target="_blank" rel="noreferrer noopener"><?= $persons['information_url'] ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex flex-col">
                <?php foreach ($persons['roles'] as $role): ?>
                    <?= $role['role_label'] ?>

                    <?php foreach ($role['is_in'] as $in): ?>
                        <a href="<?= esc($in['link']) ?>" class="text-sm text-skin-muted hover:underline"><?= $in['title'] ?></a>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
</main>
<footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
    <?= render_page_links() ?>
    <small><?= lang('Common.powered_by', [
        'castopod' => '<a class="underline hover:no-underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a>',
    ], null, false) ?></small>
</footer>
</body>
