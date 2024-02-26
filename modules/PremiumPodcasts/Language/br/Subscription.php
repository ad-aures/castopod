<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Koumanantoù ar podkast',
    'add' => 'Koumanant nevez',
    'view' => 'Gwelet ar c\'houmanant',
    'edit' => 'Kemmañ ar c\'houmanant',
    'regenerate_token' => 'Azgenel ar jedouer',
    'suspend' => 'Ehanañ ar c\'houmanant',
    'resume' => 'Adkregiñ gant ar c\'houmanant',
    'delete' => 'Dilemel ar c\'houmanant',
    'status' => [
        'active' => 'Bev',
        'suspended' => 'Ehanet',
        'expired' => 'Tremenet',
    ],
    'list' => [
        'number' => 'Niverenn',
        'email' => 'Postel',
        'expiration_date' => 'Deiziad termen',
        'unlimited' => 'Didermen',
        'downloads' => 'Pellgargadennoù',
        'status' => 'Statud',
    ],
    'form' => [
        'email' => 'Postel',
        'expiration_date' => 'Deiziad termen',
        'expiration_date_hint' => 'An deiziad hag an eur ma vo tremenet ar c\'houmanant. Laoskit goullo evit ur c\'houmanant didermen.',
        'submit_create' => 'Krouiñ ur c\'houmanant',
        'submit_edit' => 'Kemmañ ar c\'houmanant',
    ],
    'form_link_add' => [
        'link' => 'Liamm etrezek pajenn ar c\'houmanant',
        'link_hint' => 'Gant an dra-se e vo ouzhpennet d\'al lec\'hienn ur galv da ober evit pediñ ar selaouerien·ezed da goumanantiñ ouzh ar podkast.',
        'submit' => 'Enrollañ al liamm',
    ],
    'suspend_form' => [
        'disclaimer' => 'Ehanañ ar c\'houmanant a viro ouzh ar goumananterien·ezed da welet an endalc\'had Premium. Gallout a reoc\'h skarzhañ an ehan war-lerc\'h.',
        'reason' => 'Abeg',
        'reason_placeholder' => 'Perak ho peus c\'hoant da ehanañ ar c\'houmanant?',
        "submit" => 'Ehanañ ar c\'houmanant',
    ],
    'delete_form' => [
        'disclaimer' => 'Dilemel koumanant {subscriber} a skarzho an holl stadegoù stag outañ.',
        'understand' => 'Kompren a ran, dilemel ar c\'houmanant da vat',
        'submit' => 'Dilemel ar c\'houmanant',
    ],
    'messages' => [
        'addSuccess' => 'Ur c\'houmanant nevez zo bet ouzhpennet! Ur postel evit degemer {subscriber} zo bet kaset.',
        'addError' => 'N\'eo ket bet ouzhpennet ar c\'houmanant.',
        'editSuccess' => 'Deiziad termen ar c\'houmanant zo bet nevesaet! Ur postel zo bet kaset da {subscriber}.',
        'editError' => 'N\'eo ket bet kemmet ar c\'houmanant.',
        'regenerateTokenSuccess' => 'Azganet eo bet ar jedouer! Kaset eo bet ar jedouer nevez da {subscriber} dre bostel.',
        'regenerateTokenError' => 'N\'eo ket bet gellet azgenel ar jedouer.',
        'deleteSuccess' => 'Dilamet eo bet ar c\'houmanant! Ur postel zo bet kaset da {subscriber}.',
        'deleteError' => 'N\'eo ket bet gellet dilemel ar c\'houmanant.',
        'suspendSuccess' => 'Ehanet eo bet ar c\'houmanant! Ur postel zo bet kaset da {subscriber}.',
        'suspendError' => 'N\'eo ket bet gellet ehanañ ar c\'houmanant.',
        'resumeSuccess' => 'Adkroget eo bet gant ar c\'houmanant! Ur postel zo bet kaset da {subscriber}.',
        'resumeError' => 'N\'eo ket bet gellet adkregiñ gant ar c\'houmanant.',
        'linkSaveSuccess' => 'Liamm ar c\'houmanant zo bet enrollet gant berzh! Diskouezet e vo war al lec\'hienn evel ur galv da ober!',
        'linkRemoveSuccess' => 'Dilamet eo bet liamm ar c\'houmanant gant berzh!',
    ],
    'emails' => [
        'greeting' => 'Ata,',
        'token' => 'Ho jedouer: {0}',
        'unique_feed_link' => 'Liamm ho kwazh deoc\'h-c\'hwi: {0}',
        'how_to_use' => 'Penaos ober gantañ?',
        'two_ways' => 'Daou zoare zo evit dibrennañ rannoù Premium:',
        'import_into_app' => 'Eilit liamm ho kwazh personelaet e-barzh hoc\'h arload podkast karetañ (enporzhiit anezhañ evel ur wazh prevez kuit da lakaat war wel ho titouroù).',
        'go_to_website' => 'Kit da lec\'hienn {podcastWebsite} ha dibrennit ar podkast gant ho jedouer.',
        'welcome_subject' => 'Degemer mat war {podcastTitle}',
        'welcome' => 'Koumanantet oc\'h ouzh {podcastTitle}, mersi bras deoc\'h ha degemer mat!',
        'welcome_token_title' => 'Setu an titouroù evit dibrennañ rannoù Premium ar podkast:',
        'welcome_expires' => 'Arventennet eo bet ho koumanant da echuiñ d\'an/ar {0}.',
        'welcome_never_expires' => 'Arventennet eo bet ho koumanant evit bezañ didermen.',
        'reset_subject' => 'Azganet eo bet ho jedouer!',
        'reset_token' => 'Adderaouekaet eo bet ho moned da {podcastTitle}!',
        'reset_token_title' => 'Titouroù nevez zo bet ganet evit ma tibrennfec’h rannoù Premium ar podkast:',
        'edited_subject' => 'Nevesaet eo bet ho koumanant!',
        'edited_expires' => 'Arventennet eo bet ho koumanant ouzh {podcastTitle} da echuiñ d\'an/ar {expiresAt}.',
        'edited_never_expires' => 'Arventennet eo bet ho koumanant ouzh {podcastTitle} da vezañ didermen!',
        'suspended_subject' => 'Ehanet eo bet ho koumanant!',
        'suspended' => 'Ehanet eo bet ho koumanant ouzh {podcastTitle}! Ne c\'hallit ket gwelet rannoù Premium ar podkast ken.',
        'suspended_reason' => 'Evit an abeg da-heul: {0}',
        'resumed_subject' => 'Adkrog eo ho koumanant!',
        'resumed' => 'Adkrog eo ho koumanant ouzh {podcastTitle}! Gallout a rit ket gwelet rannoù Premium ar podkast en-dro.',
        'deleted_subject' => 'Dilamet eo bet ho koumanant!',
        'deleted' => 'Dilamet eo bet ho koumanant ouzh {podcastTitle}! Ne c\'hallit ket gwelet rannoù Premium ar podkast ken.',
        'footer' => '{castopod} herberc\'hiet war {host}',
    ],
];
