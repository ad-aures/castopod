<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.soundbites_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.soundbites_form.title') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(
    route_to('episode-soundbites-edit', $podcast->id, $episode->id),
    [
        'method' => 'post',
        'class' => 'flex flex-col',
    ],
) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Episode.soundbites_form.info_section_title'),
    lang('Episode.soundbites_form.info_section_subtitle'),
) ?>

    <table class="w-full table-fixed">
        <thead>
        <tr>
            <th class="w-3/12 px-1 py-2">       
            <?= form_label(
    lang('Episode.soundbites_form.start_time'),
    'start_time',
    [],
    lang('Episode.soundbites_form.start_time_hint'),
) ?></th>
            <th class="w-3/12 px-1 py-2"><?= form_label(
    lang('Episode.soundbites_form.duration'),
    'duration',
    [],
    lang('Episode.soundbites_form.duration_hint'),
) ?></th>
            <th class="w-7/12 px-1 py-2"><?= form_label(
    lang('Episode.soundbites_form.label'),
    'label',
    [],
    lang('Episode.soundbites_form.label_hint'),
    true,
) ?></th>
            <th class="w-1/12 px-1 py-2"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($episode->soundbites as $soundbite): ?>
        <tr>
            <td class="px-1 py-2 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'type' => 'number',
        'min' => 0,
        'max' => $episode->audio_file_duration,
        'step' => 'any',
        'id' => "soundbites[{$soundbite->id}][start_time]",
        'name' => "soundbites[{$soundbite->id}][start_time]",
        'class' => 'form-input w-full border-none text-center',
        'value' => $soundbite->start_time,
        'data-type' => 'soundbite-field',
        'data-field-type' => 'start-time',
        'data-soundbite-id' => $soundbite->id,
        'required' => 'required',
    ],
) ?></td>
            <td class="px-1 py-2 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'type' => 'number',
        'min' => 0,
        'max' => $episode->audio_file_duration,
        'step' => 'any',
        'id' => "soundbites[{$soundbite->id}][duration]",
        'name' => "soundbites[{$soundbite->id}][duration]",
        'class' => 'form-input w-full border-none text-center',
        'value' => $soundbite->duration,
        'data-type' => 'soundbite-field',
        'data-field-type' => 'duration',
        'data-soundbite-id' => $soundbite->id,
        'required' => 'required',
    ],
) ?></td>
            <td class="px-1 py-2 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'id' => "soundbites[{$soundbite->id}][label]",
        'name' => "soundbites[{$soundbite->id}][label]",
        'class' => 'form-input w-full border-none',
        'value' => $soundbite->label,
    ],
) ?></td>
            <td class="px-4 py-2"><?= icon_button(
    'play',
    lang('Episode.soundbites_form.play'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'class' => 'mb-1 mr-1',
        'data-type' => 'play-soundbite',
        'data-soundbite-id' => $soundbite->id,
        'data-soundbite-start-time' => $soundbite->start_time,
        'data-soundbite-duration' => $soundbite->duration,
    ],
) ?>
            <?= icon_button(
    'delete-bin',
    lang('Episode.soundbites_form.delete'),
    route_to(
        'soundbite-delete',
        $podcast->id,
        $episode->id,
        $soundbite->id,
    ),
    [
        'variant' => 'danger',
    ],
    [],
) ?>    
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
        <td class="px-1 py-4 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'type' => 'number',
        'min' => 0,
        'max' => $episode->audio_file_duration,
        'step' => 'any',
        'id' => 'soundbites[0][start_time]',
        'name' => 'soundbites[0][start_time]',
        'class' => 'form-input w-full border-none text-center',
        'value' => old('start_time'),
        'data-soundbite-id' => '0',
        'data-type' => 'soundbite-field',
        'data-field-type' => 'start-time',
    ],
) ?></td>
        <td class="px-1 py-4 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'type' => 'number',
        'min' => 0,
        'max' => $episode->audio_file_duration,
        'step' => 'any',
        'id' => 'soundbites[0][duration]',
        'name' => 'soundbites[0][duration]',
        'class' => 'form-input w-full border-none text-center',
        'value' => old('duration'),
        'data-soundbite-id' => '0',
        'data-type' => 'soundbite-field',
        'data-field-type' => 'duration',
    ],
) ?></td>
        <td class="px-1 py-4 font-medium bg-white border border-light-blue-500"><?= form_input(
    [
        'id' => 'soundbites[0][label]',
        'name' => 'soundbites[0][label]',
        'class' => 'form-input w-full border-none',
        'value' => old('label'),
    ],
) ?></td>
        <td class="px-4 py-2"><?= icon_button(
    'play',
    lang('Episode.soundbites_form.play'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'data-type' => 'play-soundbite',
        'data-soundbite-id' => 0,
        'data-soundbite-start-time' => 0,
        'data-soundbite-duration' => 0,
    ],
) ?>
            
                    
        </td>
        </tr>
        <tr><td colspan="3">
            <audio controls preload="auto" class="w-full">
                <source src="<?= $episode->audio_file_url ?>" type="<?= $episode->audio_file_mimetype ?>">
        Your browser does not support the audio tag.
            </audio>
        </td><td class="px-4 py-2"><?= icon_button(
    'timer',
    lang('Episode.soundbites_form.bookmark'),
    '',
    [
        'variant' => 'info',
    ],
    [
        'data-type' => 'get-soundbite',
        'data-start-time-field-name' => 'soundbites[0][start_time]',
        'data-duration-field-name' => 'soundbites[0][duration]',
    ],
) ?></td></tr>
    </tbody>
    </table>

    
<?= form_section_close() ?>

<?= button(
    lang('Episode.soundbites_form.submit_edit'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'type' => 'submit',
        'class' => 'self-end',
    ],
) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
