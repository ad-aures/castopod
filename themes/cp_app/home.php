<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= get_site_icon_url('ico') ?>" />
    <link rel="apple-touch-icon" href="<?= get_site_icon_url('180') ?>">
    <link rel="manifest" href="<?= route_to('webmanifest') ?>">
    <meta name="theme-color" content="<?= \App\Controllers\WebmanifestController::THEME_COLORS[service('settings')->get('App.theme')]['theme'] ?>">
    <script>
    // Check that service workers are supported
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js');
        });
    }
    </script>

    <?= $metatags ?>

    <link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <?php if (auth()->loggedIn()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 text-white border-b bg-header border-subtle">
        <h1 class="container flex items-center justify-between px-2 py-4 mx-auto">
            <a href="<?= route_to(
                'home',
            ) ?>" class="inline-flex items-baseline text-3xl font-semibold font-display"><?= service('settings')
            ->get('App.siteName') === 'Castopod' ? 'castopod' .
    svg('castopod-logo-base', 'h-6 ml-2') : esc(service('settings')
            ->get('App.siteName')) ?></a>
        </h1>
    </header>
    <main class="container flex-1 px-4 py-10 mx-auto">
        <div class="flex flex-wrap items-center justify-between py-2 border-b border-subtle gap-x-4">
            <Heading tagName="h2" class="inline-block"><?= lang('Home.all_podcasts') ?> (<?= count(
                $podcasts,
            ) ?>)</Heading>
            <button class="inline-flex items-center px-2 py-1 text-sm font-semibold focus:ring-accent" id="sortby-dropdown" data-dropdown="button" data-dropdown-target="sortby-dropdown-menu" aria-haspopup="true" aria-expanded="false"><?= icon('sort', 'mr-1 text-xl opacity-50') . lang('Home.sort_by') ?></button>
            <DropdownMenu id="sortby-dropdown-menu" labelledby="sortby-dropdown" items="<?= esc(json_encode([
                [
                    'type'  => 'link',
                    'title' => ($sortBy === 'activity' ? '✓ ' : '') . lang('Home.sort_options.activity'),
                    'uri'   => route_to('home') . '?sort=activity',
                    'class' => $sortBy === 'activity' ? 'font-semibold' : '',
                ],
                [
                    'type'  => 'link',
                    'title' => ($sortBy === 'created_desc' ? '✓ ' : '') . lang('Home.sort_options.created_desc'),
                    'uri'   => route_to('home') . '?sort=created_desc',
                    'class' => $sortBy === 'created_desc' ? 'font-semibold' : '',
                ],
                [
                    'type'  => 'link',
                    'title' => ($sortBy === 'created_asc' ? '✓ ' : '') . lang('Home.sort_options.created_asc'),
                    'uri'   => route_to('home') . '?sort=created_asc',
                    'class' => $sortBy === 'created_asc' ? 'font-semibold' : '',
                ],
            ])) ?>" />
        </div>
        <div class="grid gap-4 mt-4 grid-cols-cards">
            <?php if ($podcasts): ?>
                <?php foreach ($podcasts as $podcast): ?>
                    <a href="<?= $podcast->link ?>" class="relative w-full h-full overflow-hidden transition shadow focus:ring-accent rounded-xl hover:shadow-xl focus:shadow-xl group border-3 <?= $podcast->is_premium ? 'border-accent-base' : 'border-subtle' ?>">
                        <article class="text-white">
                            <div class="absolute bottom-0 left-0 z-10 w-full h-full backdrop-gradient mix-blend-multiply"></div>
                            <div class="w-full h-full overflow-hidden bg-header">
                                <?php if ($podcast->is_premium): ?>
                                    <div class="absolute top-0 left-0 z-10 inline-flex items-center mt-2 gap-x-2">
                                        <Icon glyph="exchange-dollar" class="w-8 pl-2 text-2xl rounded-r-full rounded-tl-lg text-accent-contrast bg-accent-base" />
                                        <?= explicit_badge($podcast->parental_advisory === 'explicit', 'rounded bg-black/75') ?>
                                    </div>
                                <?php else: ?>
                                    <?= explicit_badge($podcast->parental_advisory === 'explicit', 'absolute top-0 left-0 z-10 rounded bg-black/75 ml-2 mt-2') ?>
                                <?php endif; ?>
                                <img alt="<?= esc($podcast->title) ?>" src="<?= $podcast->cover->medium_url ?>" class="object-cover w-full h-full transition duration-200 ease-in-out transform bg-header aspect-square group-focus:scale-105 group-hover:scale-105" loading="lazy" />
                            </div>
                            <div class="absolute bottom-0 left-0 z-20 w-full px-4 pb-2">
                                <h3 class="font-bold leading-none truncate font-display"><?= esc($podcast->title) ?></h3>
                                <p class="text-sm opacity-75">@<?= esc($podcast->handle) ?></p>
                            </div>
                        </article>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="italic"><?= lang('Home.no_podcast') ?></p>
            <?php endif; ?>
        </div>
    </main>

    <button class="fixed bottom-9 right-4 px-4 py-1 bg-gray-800 hover:bg-gray-700 transition-colors duration-300 text-white rounded-full" onclick="toggleSurvey()">
    <?= lang('Home.survey.button') ?>
    </button>

    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
            'castopod' => '<a class="inline-flex font-semibold hover:underline focus:ring-accent" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('castopod', 'ml-1 text-lg', 'social') . '</a>',
        ], null, false) ?></small>
    </footer>

    
    <div id="survey" class="fixed bottom-8 right-2 w-auto bg-white border border-gray-300 p-4 rounded-lg transition-opacity duration-300" style="opacity: 0; display: none;">
        <button class="absolute top-4 right-4 p-2 bg-gray-800 rounded-full hover:bg-gray-700 transition-colors duration-300 text-white" onclick="toggleSurvey()">
            <?= icon('close', 'text-xl') ?>
        </button>
        <p class="text-center font-bold p-2"><?= lang('Home.survey.title') ?></p>
        <form action="" method="POST" enctype='multipart/form-data' class="flex flex-col w-full max-w-xl p-4 gap-y-8">
                <?= csrf_field() ?>
                <section>

                    <label for="ease_of_use" class="inline-block text-left"><?= lang('Home.survey.ease_of_use') ?></label>
                    <div class="w-full inline-block text-center"> <!-- Ajout de la classe text-center -->
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" name="ease_of_use" id="ease_of_use<?= $i ?>" value="<?= $i ?>" required class="align-middle">
                            <label for="ease_of_use<?= $i ?>" class="align-middle"><?= $i ?></label>
                        <?php endfor; ?>
                    </div>
                    <br> <!-- Ajout d'un espace -->

                    <label for="content_quality" class="inline-block text-left"><?= lang('Home.survey.content_quality') ?></label>
                    <div class="w-full inline-block text-center"> <!-- Ajout de la classe text-center -->
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" name="content_quality" id="content_quality<?= $i ?>" value="<?= $i ?>" required class="align-middle">
                            <label for="content_quality<?= $i ?>" class="align-middle"><?= $i ?></label>
                        <?php endfor; ?>
                    </div>
                    <br> <!-- Ajout d'un espace -->

                    <label for="audio_quality" class="inline-block text-left"><?= lang('Home.survey.audio_quality') ?></label>
                    <div class="w-full inline-block text-center"> <!-- Ajout de la classe text-center -->
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" name="audio_quality" id="audio_quality<?= $i ?>" value="<?= $i ?>" required class="align-middle">
                            <label for="audio_quality<?= $i ?>" class="align-middle"><?= $i ?></label>
                        <?php endfor; ?>
                    </div>
                    <br> <!-- Ajout d'un espace -->

                    <label for="variety_of_content" class="inline-block text-left"><?= lang('Home.survey.variety_of_content') ?></label>
                    <div class="w-full inline-block text-center"> <!-- Ajout de la classe text-center -->
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" name="variety_of_content" id="variety_of_content<?= $i ?>" value="<?= $i ?>" required class="align-middle">
                            <label for="variety_of_content<?= $i ?>" class="align-middle"><?= $i ?></label>
                        <?php endfor; ?>
                    </div>
                    <br> <!-- Ajout d'un espace -->

                    <label for="recommendation_likelihood" class="inline-block text-left"><?= lang('Home.survey.recommendation_likelihood') ?></label>
                    <div class="w-full inline-block text-center"> <!-- Ajout de la classe text-center -->
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input type="radio" name="recommendation_likelihood" id="recommendation_likelihood<?= $i ?>" value="<?= $i ?>" required class="align-middle">
                            <label for="recommendation_likelihood<?= $i ?>" class="align-middle"><?= $i ?></label>
                        <?php endfor; ?>
                    </div>
                    <br> <!-- Ajout d'un espace -->

                </section>

                <button type="submit" class="px-4 py-2 font-bold text-white border rounded-lg bg-emerald-700 hover:bg-emerald-600 transition-all duration-500">
                    <?= lang('Home.survey.validate') ?></button>
            </form>

    </div>

    <script>
        function toggleSurvey() {
            const surveyDiv = document.getElementById('survey');
            if (surveyDiv.style.display === 'none') {
                surveyDiv.style.display = 'block';
                setTimeout(() => {
                    surveyDiv.style.opacity = '1';
                }, 10);
            } else {
                surveyDiv.style.opacity = '0';
                setTimeout(() => {
                    surveyDiv.style.display = 'none';
                }, 300);
            }
        }
    </script>
</body>
