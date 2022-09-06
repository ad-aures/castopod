<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => '人',
    'all_persons' => '所有人',
    'no_person' => '未找到该用户！',
    'create' => '创建人员',
    'view' => '查看人员',
    'edit' => '编辑人员',
    'delete' => '删除人员',
    'messages' => [
        'createSuccess' => '人员已创建！',
        'editSuccess' => '人员已更新！',
        'deleteSuccess' => '人员已被删除！',
    ],
    'form' => [
        'avatar' => '头像',
        'avatar_size_hint' =>
            '头像必须是方形，而且至少 400 px 宽度和高度。',
        'full_name' => '全名',
        'full_name_hint' => '这是此人的全名或别名。',
        'unique_name' => '唯一名称',
        'unique_name_hint' => '用于 URL',
        'information_url' => '信息 URL',
        'information_url_hint' =>
            '指向此人的相关信息资源的 Url，例如主页或第三方个人资料平台。',
        'submit_create' => '创建人员',
        'submit_edit' => '保存人员',
    ],
    'podcast_form' => [
        'title' => '管理人员',
        'add_section_title' => '添加此人到播客中',
        'add_section_subtitle' => '你可以选择几个人和他们的角色。',
        'persons' => '人',
        'persons_hint' =>
            '你可以选择一个或多个具有相同角色的人。 但需要先创建人。',
        'roles' => '角色',
        'roles_hint' =>
            '你可以为一个人选择零、一个或多个角色。',
        'submit_add' => '添加人员',
        'remove' => '移除',
    ],
    'episode_form' => [
        'title' => '管理人员',
        'add_section_title' => '添加人到此剧集',
        'add_section_subtitle' => '你可以选择几个人和他们的角色。',
        'persons' => '人',
        'persons_hint' =>
            '你可以选择一个或多个具有相同角色的人。 但需要先创建人。',
        'roles' => '角色',
        'roles_hint' =>
            '你可以为一个人选择零、一个或多个角色。',
        'submit_add' => '添加人员',
        'remove' => '移除',
    ],
    'credits' => '鸣谢',
];
