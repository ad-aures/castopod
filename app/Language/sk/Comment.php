<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Komentár používateľa {actorDisplayName} pre epizódu {episodeTitle}",
    'back_to_comments' => 'Späť na komentáre',
    'form' => [
        'episode_message_placeholder' => 'Napísať komentár…',
        'reply_to_placeholder' => 'Odpovedať používateľovi @{actorUsername}',
        'submit' => 'Poslať',
        'submit_reply' => 'Odpovedať',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# si obľúbil}
        few {# si obľúbili}
        many {# si obľúbilo}
        other {# si obľúbili}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpoveď}
        few {# odpovede}
        many {# odpovedí}
        other {# odpovedí}
    }',
    'like' => 'Obľúbené',
    'reply' => 'Odpovedať',
    'view_replies' => 'Ukázať odpoved/e ({numberOfReplies})',
    'block_actor' => 'Blokovať používateľa @{actorUsername}',
    'block_domain' => 'Blokovať doménu @{actorDomain}',
    'delete' => 'Vymazať komentár',
];
