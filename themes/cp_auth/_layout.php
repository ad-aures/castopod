<?= helper('svg') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8"/>
	<title>Castopod Auth</title>
	<meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen mx-auto bg-gray-100">
	<header class="mb-4">
		<a href="<?= route_to(
      'home',
  ) ?>" class="inline-flex items-baseline text-4xl font-bold font-display text-pine-700">
			<?= 'castopod' . svg('castopod-logo', 'h-8 ml-2') ?>
		</a>
	</header>
	<main class="w-full max-w-md px-6 py-4 mx-auto bg-white rounded-lg shadow">
		<h1 class="mb-6 text-2xl font-bold text-center font-display"><?= $this->renderSection(
      'title',
  ) ?></h1>
		<!-- view('_message_block') -->
		<?= $this->renderSection('content') ?>
	</main>
	<footer class="flex flex-col text-sm">
		<?= $this->renderSection('footer') ?>
		<small class="py-4 text-center border-t"><?= lang('Common.powered_by', [
      'castopod' =>
          '<a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>',
  ]) ?></small>
	</footer>
</body>
