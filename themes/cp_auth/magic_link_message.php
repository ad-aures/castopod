<?php declare(strict_types=1);

use Modules\Auth\Config\Auth;

?>
<?= $this->extend(config(Auth::class)->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<p class="text-lg font-semibold"><?= lang('Auth.checkYourEmail') ?></p>

<p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>

</form>

<?= $this->endSection() ?>
