<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.soundbites_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.soundbites_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button variant="primary" type="submit" form="soundbites-form"><?= lang('Episode.soundbites_form.submit') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form id="soundbites-form" action="<?= route_to('episode-soundbites-edit', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col max-w-xl">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Episode.soundbites_form.info_section_title') ?>"
    subtitle="<?= lang('Episode.soundbites_form.info_section_subtitle') ?>" >

    <?php
    $table = new \CodeIgniter\View\Table();

    $table->setHeading(
        lang('Episode.soundbites_form.start_time') . hint_tooltip(lang('Episode.soundbites_form.start_time_hint')),
        lang('Episode.soundbites_form.duration') . hint_tooltip(lang('Episode.soundbites_form.duration_hint')),
        lang('Episode.soundbites_form.label') . hint_tooltip(lang('Episode.soundbites_form.label_hint')),
        '',
        ''
    );

    foreach ($episode->soundbites as $soundbite) {
        $table->addRow(
            "<Forms.Input class='w-24' type='number' step='any' min='0' max='{$episode->audio->duration}' name='soundbites[{$soundbite->id}][start_time]' value='{$soundbite->start_time}' data-type='soundbite-field' data-field-type='start_time' required='true' />",
            "<Forms.Input class='w-24' type='number' step='any' min='0' max='{$episode->audio->duration}' name='soundbites[{$soundbite->id}][duration]' value='{$soundbite->duration}' data-type='soundbite-field' data-field-type='duration' required='true' />",
            "<Forms.Input class='flex-1' name='soundbites[{$soundbite->id}][label]' value='{$soundbite->label}' />",
            "<IconButton variant='primary' glyph='play' data-type='play-soundbite' data-soundbite-id='{$soundbite->id}'>" . lang('Episode.soundbites_form.play') . '</IconButton>',
            '<IconButton uri=' . route_to(
                'soundbite-delete',
                $podcast->id,
                $episode->id,
                $soundbite->id,
            ) . " variant='danger' glyph='delete-bin'>" . lang('Episode.soundbites_form.delete') . '</IconButton>'
        );
    }

    $table->addRow(
        "<Forms.Input class='w-24' type='number' step='any' min='0' max='{$episode->audio->duration}' name='soundbites[0][start_time]' data-type='soundbite-field' data-field-type='start_time' />",
        "<Forms.Input class='w-24' type='number' step='any' min='0' max='{$episode->audio->duration}' name='soundbites[0][duration]' data-type='soundbite-field' data-field-type='duration' />",
        "<Forms.Input class='flex-1' name='soundbites[0][label]' />",
        "<IconButton variant='primary' glyph='play' data-type='play-soundbite' data-soundbite-id='0'>" . lang('Episode.soundbites_form.play') . '</IconButton>',
    );

    echo $table->generate();

    ?>

    <div class="flex items-center gap-x-2">
        <audio controls preload="auto" class="flex-1 w-full">
            <source src="<?= $episode->audio->file_url ?>" type="<?= $episode->audio->file_mimetype ?>">
            Your browser does not support the audio tag.
        </audio>
        <IconButton glyph="timer" variant="info" data-type="get-soundbite" data-start-time-field-name="soundbites[0][start_time]" data-duration-field-name="soundbites[0][duration]" ><?= lang('Episode.soundbites_form.bookmark') ?></IconButton>
    </div>
</Forms.Section>
</form>

<?= $this->endSection() ?>
