<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Denna procedur kan ta lång tid. Eftersom den aktuella versionen inte visar några framsteg medan den körs, kommer du inte se något uppdaterat förrän det är gjort. Vid timeoutfel, öka värdet `max_execution_time`.',
    'old_podcast_section_title' => 'Podcast att importera',
    'old_podcast_section_subtitle' =>
        'Se till att du äger rättigheterna för den här podcasten innan du importerar den. Kopiering och sändning av en podcast utan rätt rättigheter är piratkopiering och riskerar att åtalas.',
    'imported_feed_url' => 'URL för flöde',
    'imported_feed_url_hint' => 'Flödet måste vara i xml- eller rss-format.',
    'new_podcast_section_title' => 'Den nya podcasten',
    'advanced_params_section_title' => 'Avancerade parametrar',
    'advanced_params_section_subtitle' =>
        'Behåll standardvärdena om du inte har någon aning om vad fälten är för.',
    'slug_field' => 'Fält som ska användas för att beräkna avsnitt slug',
    'description_field' =>
        'Källfält som används för avsnittsbeskrivning / visa anteckningar',
    'force_renumber' => 'Tvinga avsnitts åternumrering',
    'force_renumber_hint' =>
        'Använd detta om din podcast inte har avsnittsnummer men vill ange dem under import.',
    'season_number' => 'Säsong nummer',
    'season_number_hint' =>
        'Använd detta om din podcast inte har ett säsongsnummer men vill ange en under import. Lämna tomt annars.',
    'max_episodes' => 'Maximalt antal avsnitt att importera',
    'max_episodes_hint' => 'Lämna tomt för att importera alla avsnitt',
    'lock_import' =>
        'Detta flöde är skyddat. Du kan inte importera det. Om du är ägare, sluta skydda det på ursprungsplattformen.',
    'submit' => 'Importera podcast',
];
