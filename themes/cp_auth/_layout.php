<?= helper('svg') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head')
    ->title('Castopod Auth')
    ->description('Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience.');
?>

<body class="flex flex-col items-center justify-center min-h-screen mx-auto bg-base">
	<header class="mb-4">
		<a href="<?= route_to(
		    'home',
		) ?>" class="inline-flex items-baseline text-4xl font-bold font-display text-accent-base">
			<?= 'castopod' . svg('castopod-logo', 'h-8 ml-2') ?>
		</a>
	</header>
	<main class="flex flex-col w-full max-w-md px-6 py-4 mx-auto rounded-lg bg-elevated border-3 border-subtle gap-y-4">
		<x-Heading tagName="h1" size="large" class="self-center"><?= $this->renderSection(
		    'pageTitle',
		) ?></x-Heading>
		<?= view('_message_block') ?>
		<?= $this->renderSection('content') ?>
	</main>
	<footer class="flex flex-col text-sm">
		<?= $this->renderSection('footer') ?>
		<small class="py-4 text-center border-t border-subtle"><?= lang('Common.powered_by', [
				    'castopod' => '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social:castopod', [
				        'class' => 'ml-1 text-lg',
				    ]) . '</a>',
				], null, false) ?></small>
	</footer>
</body>
