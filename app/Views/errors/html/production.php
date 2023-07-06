<?= helper(['components', 'svg']) ?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title><?= lang('Errors.whoops') ?></title>
	<link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
	<?php if (auth()->loggedIn()): ?>
		<?= service('vite')->asset('js/error.ts', 'js') ?>
	<?php endif; ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen px-4 bg-base gap-y-12 theme-<?= service('settings')
        ->get('App.theme') ?>">
	<?php if (auth()->loggedIn()): ?>
	<div class="flex flex-col items-center justify-center flex-1 gap-6">
		<div class="flex flex-col items-center">
			<?= svg('castopod-mascot_confused', 'w-full max-w-xs p-6') ?>
			<h1 class="text-3xl font-bold font-display md:text-4xl lg:text-5xl"><?= lang('Errors.whoops') ?></h1>
			<p class="text-lg text-skin-muted md:text-xl lg:text-2xl"><?= lang('Errors.weHitASnag') ?></p>
		</div>
		<div class="flex flex-col items-start max-w-xl">
			<h2 class="font-mono font-semibold"><?= esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') ?></h2>
			<p class="font-mono"><?= nl2br(esc($exception->getMessage())) ?><br/><span class="pl-4">at <span class="select-all bg-elevated"><?= nl2br(esc($exception->getFile())) ?>:<?= esc($exception->getLine()) ?></span></span></p>
			<p id="error-stack-trace" class="hidden"><?= nl2br(esc($exception)) ?></p>
			<clipboard-copy for="error-stack-trace" class="items-center self-end px-3 py-1 mt-2 font-semibold leading-8 transition-all rounded-full shadow group text-accent-contrast hover:bg-accent-hover bg-accent-base focus:ring-accent">
				<span class="inline-flex items-center copy-base"><?= icon('file-copy', 'mr-2') ?>Copy stack trace</span>
				<span class="items-center hidden copy-success"><?= icon('check', 'mr-2') ?>Copied</span>
			</clipboard-copy>
		</div>
	</div>
	<div class="flex flex-col justify-center w-full gap-6 py-12 border-t-2 md:flex-row border-subtle">
		<div class="w-full max-w-md mx-auto md:mx-0">
			<h2 class="text-xl font-semibold font-display">Found a bug?</h2>
			<p>You can help get it fixed by <a href="https://castopod.org/new-issue_bug" target="_blank" rel="noopener noreferrer" class="underline decoration-3 hover:no-underline focus:ring-accent decoration-accent">creating an issue on the Castopod issue tracker</a>. Please check that the issue does not already exist beforehand.</p>
		</div>	
		<div class="w-full max-w-md mx-auto md:mx-0">
			<h2 class="text-xl font-semibold font-display">Not sure what's happening?</h2>
			<p>You can ask for help in the <a href="https://castopod.org/chat" target="_blank" rel="noopener noreferrer" class="underline decoration-2 hover:no-underline focus:ring-accent decoration-accent">Castopod community chat</a>!</p>
		</div>
	</div>
	<?php else: ?>
		<div class="flex flex-col items-center">
			<?= svg('castopod-mascot_confused', 'w-full max-w-xs p-6') ?>
			<h1 class="text-3xl font-bold font-display md:text-4xl lg:text-5xl">Whoops!</h1>
			<p class="text-lg text-skin-muted md:text-xl lg:text-2xl">We seem to have hit a snag. Please try again later...</p>
		</div>
	<?php endif; ?>
</body>
</html>
