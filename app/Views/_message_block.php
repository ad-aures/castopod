<?php if (session()->has('message')): ?>
    <div class="px-4 py-2 mb-4 font-semibold text-green-900 bg-green-200 border border-green-700">
        <?= session('message') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="px-4 py-2 mb-4 font-semibold text-red-900 bg-red-200 border border-red-700">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
<<<<<<< HEAD
	<ul class="px-4 py-2 mb-4 font-semibold text-red-900 bg-red-200 border border-red-700">
	<?php foreach (session('errors') as $error): ?>
		<li><?= $error ?></li>
	<?php endforeach; ?>
	</ul>
<?php endif;
?>
=======
    <ul class="px-4 py-2 mb-4 font-semibold text-red-900 bg-red-200 border border-red-700">
    <?php foreach (session('errors') as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
>>>>>>> ef31ffe... refactor: add php_codesniffer to define castopod's coding style based on psr-1
