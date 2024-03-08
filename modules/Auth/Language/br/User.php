<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Kemmañ roll {username}",
    'ban' => 'Stankañ',
    'unban' => 'Distankañ',
    'delete' => 'Dilemel',
    'create' => 'Krouiñ un implijer·ez',
    'view' => "Titouroù diwar-benn {username}",
    'all_users' => 'An holl implijerien·ezed',
    'list' => [
        'user' => 'Implijer·ez',
        'role' => 'Roll',
        'banned' => 'Stanket?',
    ],
    'form' => [
        'email' => 'Postel',
        'username' => 'Anv implijer·ez',
        'password' => 'Ger-tremen',
        'new_password' => 'Ger-tremen nevez',
        'role' => 'Roll',
        'roles' => 'Rolloù',
        'permissions' => 'Aotreoù',
        'submit_create' => 'Krouiñ an implijer·ez',
        'submit_edit' => 'Enrollañ',
        'submit_password_change' => 'Kemm!',
    ],
    'delete_form' => [
        'title' => 'Dilemel {user}',
        'disclaimer' =>
            "Emaoc'h o vont da lemel {user} da vat. Ne c'hallo ket gwelet an daolenn-stur ken.",
        'understand' => 'Komprenet em eus. Fellout a ra din lemel {user} da vat',
        'submit' => 'Dilemel',
    ],
    'messages' => [
        'createSuccess' =>
            'User created successfully! {username} will be prompted with a password reset upon first authentication.',
        'roleEditSuccess' =>
            "Rolloù {username} zo bet nevesaet gant berzh.",
        'banSuccess' => 'Stanket eo bet {username}.',
        'unbanSuccess' => 'Distanket eo bet {username}.',
        'editOwnerError' =>
            '{username} eo perc\'henn·ez an istañs. Ne c\'hallit ket kemmañ e rolloù…',
        'banSuperAdminError' =>
            'Dreistmerour·ez eo {username}, n\'haller ket stankañ un dreistmerour·ez ken aes-se…',
        'deleteOwnerError' =>
            '{username} eo perc\'henn·ez an istañs. N\'haller ket lemel ar perc\'henn·ez ken aes-se…',
        'deleteSuperAdminError' =>
            'Dreistmerour·ez eo {username}, n\'haller ket lemel un dreistmerour·ez ken aes-se…',
        'deleteSuccess' => 'Dilamet eo bet {username}.',
    ],
];
