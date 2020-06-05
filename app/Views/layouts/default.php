<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Castopod</title>
	<meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<link rel="stylesheet" href="/index.css">
</head>

<body class="flex flex-col min-h-screen mx-auto">
	<header class="border-b">
		<div class="container flex items-center justify-between px-2 py-4 mx-auto">
			<a href="/" class="text-2xl">Castopod</a>
			<nav>
				<a class="px-4 py-2 border hover:bg-gray-100" href="/podcasts/create">New podcast</a>
			</nav>
		</div>
	</header>
	<main class="container flex-1 px-4 py-10 mx-auto">
		<?= $this->renderSection('content') ?>
	</main>
	<footer class="container px-2 py-4 mx-auto text-sm text-right border-t">
		Powered by <a class="underline hover:no-underline" href="https://code.podlibre.org/podlibre/castopod">Castopod</a>, a <a class="underline hover:no-underline" href="https://podlibre.org/">Podlibre</a> initiative.
	</footer>
</body>