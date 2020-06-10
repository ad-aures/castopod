<?php
/**
 * Class AddPodcasts
 * Creates podcasts table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcasts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'The podcast ID',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The show title.  It’s important to have a clear, concise name for your podcast. Make your title specific. A show titled Our Community Bulletin is too vague to attract many subscribers, no matter how compelling the content.  Pay close attention to the title as Apple Podcasts uses this field for search.  If you include a long list of keywords in an attempt to game podcast search, your show may be removed from the Apple directory.',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true,
                'comment' => 'Unique podcast string identifier.',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' =>
                    'The show description. Where description is text containing one or more sentences describing your podcast to potential listeners. The maximum amount of text allowed for this tag is 4000 characters. To include links in your description or rich HTML, adhere to the following technical guidelines: enclose all portions of your XML that contain embedded HTML in a CDATA section to prevent formatting issues, and to ensure proper link functionality.',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The artwork for the show.  Specify your show artwork by providing a URL linking to it.  Depending on their device, subscribers see your podcast artwork in varying sizes. Therefore, make sure your design is effective at both its original size and at thumbnail size. You should include a show title, brand, or source name as part of your podcast artwork. Artwork must be a minimum size of 1400 x 1400 pixels and a maximum size of 3000 x 3000 pixels, in JPEG or PNG format, 72 dpi, with appropriate file extensions (.jpg, .png), and in the RGB colorspace.',
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
                'comment' =>
                    'The language spoken on the show.  Because Apple Podcasts is available in territories around the world, it is critical to specify the language of a podcast. Apple Podcasts only supports values from the ISO 639 list (two-letter language codes, with some possible modifiers, such as "en-us").  Invalid language codes will cause your feed to fail Apple validation.',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The show category information. For a complete list of categories and subcategories, see Apple Podcasts categories.  Select the category that best reflects the content of your show. If available, you can also define a subcategory.  Although you can specify more than one category and subcategory in your RSS feed, Apple Podcasts only recognizes the first category and subcategory.  When specifying categories and subcategories, be sure to properly escape ampersands.',
                'null' => true,
            ],
            'explicit' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'The podcast parental advisory information.  The explicit value can be one of the following:      True: If you specify true, indicating the presence of explicit content, Apple Podcasts displays an Explicit parental advisory graphic for your podcast.      Podcasts containing explicit material aren’t available in some Apple Podcasts territories.      False: If you specify false, indicating that your podcast doesn’t contain explicit language or adult content, Apple Podcasts displays a Clean parental advisory graphic for your podcast.',
            ],
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The group responsible for creating the show.  Show author most often refers to the parent company or network of a podcast, but it can also be used to identify the host(s) if none exists.  Author information is especially useful if a company or organization publishes multiple podcasts. Providing this information will allow listeners to see all shows created by the same entity.',
                'null' => true,
            ],
            'owner_name' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'owner_name' =>
                    'The podcast owner name.  Note: The owner information is for administrative communication about the podcast and isn’t displayed in Apple Podcasts.',
                'null' => true,
            ],
            'owner_email' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'owner_email' =>
                    'The podcast owner email address.  Note: The owner information is for administrative communication about the podcast and isn’t displayed in Apple Podcasts. Please make sure the email address is active and monitored.',
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['episodic', 'serial'],
                'default' => 'episodic',
                'comment' =>
                    'The type of show.  If your show is Serial you must use this tag.  Its values can be one of the following:      episodic (default). Specify episodic when episodes are intended to be consumed without any specific order. Apple Podcasts will present newest episodes first and display the publish date (required) of each episode. If organized into seasons, the newest season will be presented first - otherwise, episodes will be grouped by year published, newest first.      For new subscribers, Apple Podcasts adds the newest, most recent episode in their Library.      serial. Specify serial when episodes are intended to be consumed in sequential order. Apple Podcasts will present the oldest episodes first and display the episode numbers (required) of each episode. If organized into seasons, the newest season will be presented first and  <itunes:episode> numbers must be given for each episode.      For new subscribers, Apple Podcasts adds the first episode to their Library, or the entire current season if using seasons',
            ],
            'copyright' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The show copyright details.  If your show is copyrighted you should use this tag.',
                'null' => true,
            ],
            'block' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'The podcast show or hide status.  If you want your show removed from the Apple directory, use this tag.  Specifying the <itunes:block> tag with a Yes value, prevents the entire podcast from appearing in Apple Podcasts.  Specifying any value other than Yes has no effect.',
            ],
            'complete' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'The podcast update status.  If you will never publish another episode to your show, use this tag.  Specifying the <itunes:complete> tag with a Yes value indicates that a podcast is complete and you will not post any more episodes in the future.  Specifying any value other than Yes has no effect.',
            ],
            'episode_description_footer' => [
                'type' => 'TEXT',
                'comment' =>
                    'The text that will be added in every episode description (show notes).',
                'null' => true,
            ],
            'custom_html_head' => [
                'type' => 'TEXT',
                'comment' =>
                    'The HTML code that will be added to evey page for this podcast. (You could add Google Analytics tracking code here for instance.)',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('podcasts');
    }

    public function down()
    {
        $this->forge->dropTable('podcasts');
    }
}
