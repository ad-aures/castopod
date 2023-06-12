<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Notifications.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Notifications.title') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('notification-mark-all-as-read', $podcast->id) ?>" variant="primary"><?= lang('Notifications.mark_all_as_read') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if ($notifications === []): ?>
    <div class="text-sm italic text-center text-skin-muted"><?= lang('Notifications.no_notifications') ?></div>
<?php else: ?>        
    <div class="-mx-2 -mt-8 border-b divide-y md:-mx-12">
        <?php
            foreach ($notifications as $notification):
                $backgroundColor = $notification->read_at === null ? 'bg-heading-background' : 'bg-base';
                ?>
            <div class="py-3 hover:bg-white px-4 <?= $backgroundColor ?> group">
                <?php
                            $post = $notification->post_id !== null ? $notification->post : null;

                $actorUsername = '@' . esc($notification->actor
                    ->username) .
                            ($notification->actor->is_local
                                ? ''
                                : '@' . esc($notification->actor->domain));

                $actorUsernameHtml = <<<CODE_SAMPLE
                    <strong class="break-all">{$actorUsername}</strong>
                    CODE_SAMPLE;

                $targetActorUsername = '@' . esc($notification->target_actor->username);

                $targetActorUsernameHtml = <<<CODE_SAMPLE
                    <strong class="break-all">{$targetActorUsername}</strong>
                    CODE_SAMPLE;

                $notificationTitle = match ($notification->type) {
                    'reply' => lang('Notifications.reply', [
                        'actor_username' => $actorUsernameHtml,
                    ], null, false),
                    'like' => lang('Notifications.favourite', [
                        'actor_username' => $actorUsernameHtml,
                    ], null, false),
                    'share' => lang('Notifications.reblog', [
                        'actor_username' => $actorUsernameHtml,
                    ], null, false),
                    'follow' => lang('Notifications.follow', [
                        'actor_username' => $actorUsernameHtml,
                    ], null, false),
                    default => '',
                };
                $notificationContent = $post !== null ? $post->message_html : null;

                $postLink = $post !== null ? route_to('post', esc($podcast->handle), $post->id) : route_to('podcast-activity', esc($podcast->handle));
                $link = $notification->read_at !== null ? $postLink : route_to('notification-mark-as-read', $podcast->id, $notification->id);
                ?>
                <a href="<?= $link ?>">
                    <div class="flex items-start md:items-center">
                        <div class="flex items-center shrink-0">
                            <span class="w-2 h-2 bg-red-500 rounded-full <?= $notification->read_at === null ? '' : 'invisible' ?>"></span>
                            <div class="relative ml-4">
                                <img src="<?= $notification->actor->avatar_image_url ?>" alt="<?= esc($notification->actor->display_name) ?>" class="rounded-full shadow-inner w-14 h-14 aspect-square" loading="lazy" />
                                <span class="absolute bottom-0 w-6 h-6 rounded-full -right-2.5 flex justify-center items-center <?= $backgroundColor ?> group-hover:bg-white">
                                    <?php
                                        $icon = match ($notification->type) {
                                            'reply'  => icon('chat', 'text-sky-500 text-base'),
                                            'like'   => icon('heart', 'text-rose-500 text-base'),
                                            'share'  => icon('repeat', 'text-green-500 text-base'),
                                            'follow' => icon('user-follow', 'text-violet-500 text-base'),
                                            default  => '',
                                        };
                ?>
                                    <?= $icon ?>
                                </span>
                            </div>
                        </div>
                        <div class="ml-5 md:flex md:items-center grow">
                            <div class="grow">
                                <?= $notificationTitle ?>
                                <?php if ($notificationContent !== null): ?>
                                    <p class="overflow-y-hidden text-skin-muted line-clamp-2 md:line-clamp-1"><?= $notificationContent ?></p>
                                <?php endif; ?>
                            </div>
                            <span class="text-xs text-skin-muted md:ml-auto md:mr-4 whitespace-nowrap"><?= relative_time($notification->created_at) ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6"><?= $pager->links() ?></div>

<?php endif ?>

<?= $this->endsection() ?>
