<?php helper('html'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8"/>
	<title>Castopod Admin</title>
	<meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<link rel="stylesheet" href="/assets/admin.css"/>
	<link rel="stylesheet" href="/assets/index.css"/>
</head>

<body class="min-h-screen bg-gray-100 holy-grail-grid">
	<?= view('admin/_header', [
     'class' => 'flex items-center px-4 py-2 holy-grail-header',
 ]) ?>
		<?= view('admin/_sidenav', [
      'class' => 'flex flex-col w-64 py-6 holy-grail-sidenav',
  ]) ?>
	<main class="container px-4 py-6 mx-auto holy-grail-main">
		<h1 class="mb-4 text-2xl"><?= $this->renderSection('title') ?></h1>
		<?= view('_message_block') ?>
		<?= $this->renderSection('content') ?>
	</main>
	<footer class="w-full px-2 py-4 mx-auto text-xs text-right border-t holy-grail-footer">
		Powered by <a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>, a <a class="underline hover:no-underline" href="https://podlibre.org/" target="_blank" rel="noreferrer noopener">Podlibre</a> initiative.
	</footer>

	<script src="/assets/admin.js"></script>
</body>
