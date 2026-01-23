<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast obsahuje prémiové epizody',
    'episode_is_premium' => 'Epizoda je prémiová, dostupná pouze pro prémiové odběratele',
    'unlock_episode' => 'Tato epizoda je pouze pro prémiové odběratele. Klepnutím ji odemknete!',
    'banner_unlock' => 'Tento podcast obsahuje prémiové epizody, které jsou dostupné pouze pro prémiové odběratele.',
    'banner_lock' => 'Podcast je odemčen, užijte si prémiové epizody!',
    'subscribe' => 'Odebírat',
    'lock' => 'Uzamknout',
    'unlock' => 'Odemknout',
    'unlock_form' => [
        'title' => 'Prémiový obsah',
        'subtitle' => 'Tento podcast obsahuje uzamčené prémiové epizody! Máte klíč k jejich odemčení?',
        'token' => 'Zadejte svůj klíč',
        'token_hint' => 'Pokud jste přihlášeni k odběru {podcastTitle}, můžete zkopírovat klíč, který vám byl odeslán prostřednictvím e-mailu a vložit jej zde.',
        'submit' => 'Odemknout všechny epizody!',
        'call_to_action' => 'Odemknout všechny epizody {podcastTitle}:',
        'subscribe_cta' => 'Přihlásit se k odběru nyní!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast byl úspěšně odemčen! Užijte si prémiové epizody!',
        'unlockBadAttempt' => 'Zdá se, že váš klíč nefunguje…',
        'lockSuccess' => 'Podcast byl úspěšně uzamčen!',
    ],
];
