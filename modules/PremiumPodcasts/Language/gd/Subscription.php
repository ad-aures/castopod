<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Fo-sgrìobhaidhean air pod-chraolaidhean',
    'add' => 'Fo-sgrìobhadh ùr',
    'view' => 'Seall am fo-sgrìobhadh',
    'edit' => 'Deasaich am fo-sgrìobhadh',
    'regenerate_token' => 'Ath-ghin an tòcan',
    'suspend' => 'Cuir am fo-sgrìobhadh à rèim',
    'resume' => 'Lean air an fho-sgrìobhadh',
    'delete' => 'Sguab às am fo-sgrìobhadh',
    'status' => [
        'active' => 'Gnìomhach',
        'suspended' => 'À rèim',
        'expired' => 'Dh’fhalbh an ùine air',
    ],
    'list' => [
        'number' => 'Àireamh',
        'email' => 'Post-d',
        'expiration_date' => 'Ceann-là crìochnachaidh',
        'unlimited' => 'Gun chrìoch',
        'downloads' => 'Luchdaidhean a-nuas',
        'status' => 'Staid',
    ],
    'form' => [
        'email' => 'Post-d',
        'expiration_date' => 'Ceann-là crìochnachaidh',
        'expiration_date_hint' => 'An ceann-là ’s àm a dh’fhalbhas an ùine air an fho-sgrìobhadh. Fàg bàn e airson fo-sgrìobhadh gun chrìoch.',
        'submit_add' => 'Cuir fo-sgrìobhadh ris',
        'submit_edit' => 'Deasaich am fo-sgrìobhadh',
    ],
    'form_link_add' => [
        'link' => 'Ceangal gu duilleag an fho-sgrìobhaidh',
        'link_hint' => 'Cuiridh seo tàladh ris an làrach-lìn a bheir cuireadh dhan luchd-èisteachd ach am faigh iad fo-sgrìobhadh air a’ phod-chraoladh.',
        'submit' => 'Sàbhail an ceangal',
    ],
    'suspend_form' => [
        'disclaimer' => 'Ma chuireas tu am fo-sgrìobhadh à rèim, cuingichidh seo an neach fo-sgrìobhaidh gus nach fhaigh iad cothrom air susbaint premium. ’S urrainn dhut a chur ann an rèim a-rithist uair sam bith an uairsin.',
        'reason' => 'Adhbhar',
        'reason_placeholder' => 'Carson a tha thu a’ cur am fo-sgrìobhadh à rèim?',
        "submit" => 'Cuir am fo-sgrìobhadh à rèim',
    ],
    'delete_form' => [
        'disclaimer' => 'Ma sguabas tu às am fo-sgrìobhadh aig {subscriber}, bheir seo air falbh dàta sam bith na h-anailiseachd a tha co-cheangailte ris.',
        'understand' => 'Tha mi agaibh, thoir air falbh am fo-sgrìobhadh gu buan',
        'submit' => 'Thoir am fo-sgrìobhadh air falbh',
    ],
    'messages' => [
        'addSuccess' => 'Chaidh fo-sgrìobhadh ùr a chur ris! Chaidh post-d fàilteachaidh a chur gu {subscriber}.',
        'addError' => 'Cha b’ urrainn dhuinn am fo-sgrìobhadh a chur ris.',
        'editSuccess' => 'Chaidh an ceann-là a dh’fhalbhas an ùine air an fho-sgrìobhadh ùrachadh! Chaidh post-d a chur gu {subscriber}.',
        'editError' => 'Cha b’ urrainn dhuinn am fo-sgrìobhadh a dheasachadh.',
        'regenerateTokenSuccess' => 'Chaidh an tòcan ath-ghintinn! Chaidh post-d a chur gu {subscriber} leis an tòcan ùr.',
        'regenerateTokenError' => 'Cha b’ urrainn dhuinn an tòcan ath-ghintinn.',
        'deleteSuccess' => 'Chaidh am fo-sgrìobhadh a thoirt air falbh! Chaidh post-d a chur gu {subscriber}.',
        'deleteError' => 'Cha b’ urrainn dhuinn am fo-sgrìobhadh a thoirt air falbh.',
        'suspendSuccess' => 'Chaidh am fo-sgrìobhadh a chur à rèim! Chaidh post-d a chur gu {subscriber}.',
        'suspendError' => 'Cha b’ urrainn dhuinn am fo-sgrìobhadh a cur à rèim.',
        'resumeSuccess' => 'Chaidh leantainn air an fho-sgrìobhadh! Chaidh post-d a chur gu {subscriber}.',
        'resumeError' => 'Cha b’ urrainn dhuinn leantainn air an fho-sgrìobhadh.',
        'linkSaveSuccess' => 'Chaidh an ceangal dhan fho-sgrìobhadh a shàbhaladh! Nochdaidh e air an làrach-lìn na thadhladh!',
        'linkRemoveSuccess' => 'Chaidh an ceangal dhan fho-sgrìobhadh a thoirt air falbh!',
    ],
    'emails' => [
        'greeting' => 'Shin thu,',
        'token' => 'Seo an tòcan agad: {0}',
        'unique_feed_link' => 'Seo ceangal àraidh an inbhir agad: {0}',
        'how_to_use' => 'Mar a chleachdas tu e',
        'two_ways' => 'Tha dà dhòigh ann air an doir thu a’ ghlas far eapasodan premium:',
        'import_into_app' => 'Cuir lethbhreac de dh’URL àraidh an inbhir agad san aplacaid pod-chraolaidh as fheàrr leat (ion-phortaich e ’na inbhir prìobhaideach ach nach foillsich thu an teisteanas agad).',
        'go_to_website' => 'Tadhail air an làrach-lìn aig {podcastWebsite} agus thoir a’ ghlas far a’ phod-chraolaidh leis an tòcan agad.',
        'welcome_subject' => 'Fàilte gu {podcastTitle}',
        'welcome' => 'Fhuair thu fo-sgrìobhadh air {podcastTitle}, mòran taing is fàilte air bhòrd!',
        'welcome_token_title' => 'Seo an teisteanas agad airson a’ ghlas a thoirt far eapasodan premium a’ phod-chraolaidh:',
        'welcome_expires' => 'Chaidh crìoch an fho-sgrìobhaidh agad a shuidheachadh air {0}.',
        'welcome_never_expires' => 'Chaidh am fo-sgrìobhaidh agad a shuidheachadh ach nach fhalbh an ùine air.',
        'reset_subject' => 'Chaidh an tòcan agad ath-shuidheachadh!',
        'reset_token' => 'Chaidh an t-inntrigeadh agad air {podcastTitle} ath-shuidheachadh!',
        'reset_token_title' => 'Chaidh teisteanas ùr a ghintinn dhut airson a’ ghlas a thoirt far eapasodan premium a’ phod-chraolaidh:',
        'edited_subject' => 'Chaidh am fo-sgrìobhadh agad ùrachadh!',
        'edited_expires' => 'Chaidh crìoch an fho-sgrìobhaidh agad air {podcastTitle} a shuidheachadh air {expiresAt}.',
        'edited_never_expires' => 'Chaidh am fo-sgrìobhaidh agad air {podcastTitle} a shuidheachadh ach nach fhalbh an ùine air!',
        'suspended_subject' => 'Chaidh am fo-sgrìobhadh agad a chur à rèim!',
        'suspended' => 'Chaidh am fo-sgrìobhadh agad air {podcastTitle} a chur à rèim! Chan urrainn dhut eapasodan premium a’ phod-chraolaidh inntrigeadh tuilleadh.',
        'suspended_reason' => 'Seo as adhbhar dha: {0}',
        'resumed_subject' => 'Chaidh leantainn air an fho-sgrìobhadh agad!',
        'resumed' => 'Chaidh leantainn air an fho-sgrìobhadh air {podcastTitle} agad! ’S urrainn dhut eapasodan premium a’ phod-chraolaidh inntrigeadh a-rithist.',
        'deleted_subject' => 'Chaidh am fo-sgrìobhadh agad a thoirt air falbh!',
        'deleted' => 'Chaidh am fo-sgrìobhadh agad air {podcastTitle} a thoirt air falbh! Chan urrainn dhut eapasodan premium a’ phod-chraolaidh inntrigeadh tuilleadh.',
        'footer' => 'Seo {castopod} ’ga òstadh air {host}',
    ],
];
