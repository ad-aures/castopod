<?php declare(strict_types=1);

if (session()->has('message')): ?>
    <Alert variant="success" class="max-w-sm mb-4"><?= session('message') ?></Alert>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <Alert variant="danger" class="max-w-sm mb-4"><?= session('error') ?></Alert>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
    <Alert variant="danger" class="max-w-sm mb-4">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </Alert>
<?php endif;
?>
