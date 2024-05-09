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

<?php if (session()->has('warning')): ?>
    <x-Alert variant="warning" class="mb-4"><?= esc(session('warning')) ?></x-Alert>
<?php endif; ?>

<?php if (session()->has('warnings')): ?>
    <x-Alert variant="warning" class="mb-4">
        <ul>
            <?php foreach (session('warnings') as $warning): ?>
                <li><?= esc($warning) ?></li>
            <?php endforeach; ?>
        </ul>
    </x-Alert>
<?php endif; ?>
