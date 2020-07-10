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
	<header class="text-white bg-gray-900 border-b">
		<div class="flex items-center justify-between px-4 py-4 mx-auto">
			<a href="<?= route_to('home') ?>" class="text-xl">Castopod Admin</a>
			<nav>
				<span class="mr-2">Welcome, <?= user()->username ?></span>
				<a class="px-4 py-2 border hover:bg-gray-800" href="<?= route_to(
        'logout'
    ) ?>">Logout</a>
			</nav>
		</div>
	</header>
	<div class="flex flex-1">
		<?= view('admin/_sidenav') ?>
		<main class="container flex-1 px-4 py-6 mx-auto">
			<div class="mb-4">
				<?= view('_message_block') ?>
			</div>
			<?= $this->renderSection('content') ?>
		</main>
	</div>
	<footer class="container px-2 py-4 mx-auto text-sm text-right border-t">
		Powered by <a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>, a <a class="underline hover:no-underline" href="https://podlibre.org/" target="_blank" rel="noreferrer noopener">Podlibre</a> initiative.
	</footer>
</body>
