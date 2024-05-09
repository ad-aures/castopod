<?php declare(strict_types=1);

if (session()->has('message')): ?>
    <x-Alert variant="success" class="mb-4"><?= esc(session('message')) ?></x-Alert>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <x-Alert variant="danger" class="mb-4"><?= esc(session('error')) ?></x-Alert>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
    <x-Alert variant="danger" class="mb-4">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </x-Alert>
<?php endif; ?>
