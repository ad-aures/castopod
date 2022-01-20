<?= helper(['components', 'svg']) ?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title>Whoops!</title>
	<link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen px-2 text-center bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
	<?= svg('castopod-mascot_confused', 'h-64') ?>
	<h1 class="text-3xl font-bold font-display md:text-4xl lg:text-5xl">Whoops!</h1>
	<p class="mb-6 text-lg text-skin-muted md:text-xl lg:text-2xl">We seem to have hit a snag. Please try again later...</p>
</body>

</html>
