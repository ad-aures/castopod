<?= helper('svg') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8"/>
	<title>Castopod Auth</title>
	<meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen mx-auto bg-pine-50">
	<header class="mb-4">
		<a href="<?= route_to(
            'home',
        ) ?>" class="inline-flex items-baseline text-4xl font-bold font-display text-pine-500 focus:ring-castopod">
			<?= 'castopod' . svg('castopod-logo', 'h-8 ml-2') ?>
		</a>
	</header>
	<main class="flex flex-col w-full max-w-md px-6 py-4 mx-auto bg-white rounded-lg border-3 border-pine-100 gap-y-4">
		<Heading tagName="h1" size="large" class="self-center"><?= $this->renderSection(
            'title',
        ) ?></Heading>
		<?= view('_message_block') ?>
		<?= $this->renderSection('content') ?>
	</main>
	<footer class="flex flex-col text-sm">
		<?= $this->renderSection('footer') ?>
		<small class="py-4 text-center border-t-2 border-pine-100"><?= lang('Common.powered_by', [
		    'castopod' =>
		        '<a class="inline-flex font-semibold hover:underline focus:ring-castopod" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
		]) ?></small>
	</footer>
</body>
