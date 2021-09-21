<?php declare(strict_types=1);

if (session()->has('message')): ?>
    <Alert variant="success"><?= session('message') ?></Alert>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <Alert variant="danger"><?= session('error') ?></Alert>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
    <Alert variant="danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </Alert>
<?php endif;
?>
