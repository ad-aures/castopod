<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcast_episodes' => 'All podcast episodes',
    'back_to_podcast' => 'Go back to podcast',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'go_to_page' => 'Go to page',
    'create' => 'Add an episode',
    'form' => [
        'file' => 'Audio file',
        'title' => 'Title',
        'title_help' =>
            'This episode title. It should contain a clear, concise name for your episode. Don’t specify the episode number or season number here.',
        'slug' => 'Slug',
        'slug_help' =>
            'This episode slug. It will be used for its URL address.',
        'description' => 'Description',
        'description_help' =>
            'This is where you type the episode show notes. You may add rich text, links, images…',
        'pub_date' => 'Publication date',
        'pub_date_help' =>
            'The date and time when this episode was released. It can be in the past or in the future.',
        'image' => 'Image',
        'image_help' =>
            'This episode image. If an image is already in the audio file, you don’t need to add one here. If you add no image to this episode, the podcast image will be used instead.',
        'author_name' => 'Author name',
        'author_email' => 'Author email',
        'explicit' => 'Explicit',
        'explicit_help' =>
            'The episode parental advisory information for this episode.',
        'type' => [
            'label' => 'Type',
            'full' => 'Full',
            'full_help' =>
                'Specify full when you are submitting the complete content of your episode.',
            'trailer' => 'Trailer',
            'trailer_help' =>
                'Specify trailer when you are submitting a short, promotional piece of content that represents a preview of your current show.',
            'bonus' => 'Bonus',
            'bonus_help' =>
                'Specify bonus when you are submitting extra content for your show (for example, behind the scenes information or interviews with the cast) or cross-promotional content for another show.',
        ],
        'episode_number' => 'Episode number',
        'episode_number_help' =>
            'The episode number is mandatory for serial podcasts but optional for episodic podcasts.',
        'season_number' => 'Season number',
        'season_number_help' =>
            'Season number is a non-zero integer (1, 2, 3, etc.) representing this episode season number.',
        'block' => 'Block',
        'block_help' =>
            'This episode show or hide status. If you want this episode removed from the Apple directory, use this tag.',
        'submit_create' => 'Create episode',
        'submit_edit' => 'Save episode',
    ],
];
