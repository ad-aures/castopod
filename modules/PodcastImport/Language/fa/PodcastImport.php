<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'درون‌ریزی',
        'text' => '{podcastTitle} دارد درون‌ریخته می‌شود.',
        'cta' => 'دیدن وضعیت درون‌ریزی',
    ],
    'old_podcast_section_title' => 'پادکست برای درون‌ریزی',
    'old_podcast_legal_disclaimer_title' => 'سلب مسئولیت حقوقی',
    'old_podcast_legal_disclaimer' =>
        'پیش از درون‌ریزی مطمئن شوید حقوق این پادکست را دارید. رونوشت و پخش یک پادکست بدون حقوق مناسب دزدی دریایی حساب شده و قابل پیگرد است.',
    'imported_feed_url' => 'نشانی خوراک',
    'imported_feed_url_hint' => 'خورام باید در قالب xml یا rss باشد.',
    'new_podcast_section_title' => 'پادکست جدید',
    'lock_import' =>
        'این خوراک محافظت شده است. نمی‌توانید درون‌ریزیش کنید. اگر مالکش هستید، روی بن‌سازهٔ اصلی قفل‌گشاییش کنید.',
    'submit' => 'افزودن درون‌ریزی به صف',
    'queue' => [
        'status' => [
            'label' => 'وضعیت',
            'queued' => 'صف شده',
            'queued_hint' => 'وظیفهٔ درون‌ریزی منتظر پردازش است.',
            'canceled' => 'لغو شده',
            'canceled_hint' => 'وظیفهٔ درون‌ریزی لغو شد.',
            'running' => 'درحال اجرا',
            'running_hint' => 'وظیفهٔ درون‌ریزی در حال پردازش است.',
            'failed' => 'شکست خورده',
            'failed_hint' => 'وظیفهٔ درون‌ریزی نتوانست کامل شود: شکست کدنوشته.',
            'passed' => 'قبول شده',
            'passed_hint' => 'وظیفهٔ درون‌ریزی با موفّقیت کامل شد!',
        ],
        'feed' => 'خوراک',
        'duration' => 'طول درون‌ریزی',
        'imported_episodes' => 'قسمت‌های درون‌ریخته',
        'imported_episodes_hint' => '{newlyImportedCount} به تازگی درون‌ریخته. {alreadyImportedCount} از پیش درون‌ریخته.',
        'actions' => [
            'cancel' => 'لغو',
            'retry' => 'تلاش دوباره',
            'delete' => 'حذف',
        ],
    ],
    'messages' => [
        'canceled' => 'وظیفهٔ درون‌ریزی با موفّقیت لغو شد!',
        'notRunning' => 'نمی‌توان وظیفهٔ درون‌ریزی را لغو کرد؛ چرا که در حال اجرا نیست.',
        'alreadyRunning' => 'وظیفهٔ درون‌ریزی در حال اجراست. پیش از تلاش دوباره باید لغوش کنید.',
        'retried' => 'وظیفهٔ درون‌ریزی صف شد. به زودی دوباره انجام خواهد شد!',
        'deleted' => 'وظیفهٔ درون‌ریزی با موفّقیت حذف شد!',
        'importTaskQueued' => 'وظیفه‌ای جدید صف شد. درون‌ریزی به زودی آغاز خواهد شد!',
        'syncTaskQueued' => 'وظیفهٔ درون‌ریزی جدیدی صف شد. هم‌گام سازی به زودی آغاز خواهد شد!',
    ],
];
