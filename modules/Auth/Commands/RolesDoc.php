<?php

declare(strict_types=1);

namespace Modules\Auth\Commands;

use Closure;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\View\Table;
use Config\Services;
use League\HTMLToMarkdown\Converter\TableConverter;
use League\HTMLToMarkdown\HtmlConverter;
use Modules\Auth\Config\AuthGroups;

class RolesDoc extends BaseCommand
{
    /**
     * @var array<string, string>
     */
    private const COMMENT_BLOCK_IDS = [
        'instance_roles'       => 'AUTH-INSTANCE-ROLES-LIST',
        'instance_permissions' => 'AUTH-INSTANCE-PERMISSIONS-LIST',
        'podcast_roles'        => 'AUTH-PODCAST-ROLES-LIST',
        'podcast_permissions'  => 'AUTH-PODCAST-PERMISSIONS-LIST',
    ];

    /**
     * @var string
     */
    protected $group = 'auth';

    /**
     * @var string
     */
    protected $name = 'auth:generate-doc';

    /**
     * @var string
     */
    protected $description = 'Generates the html table references for roles and permissions in the docs.';

    public function run(array $params): void
    {
        // loop over all files in path
        $files = glob(ROOTPATH . 'docs/src/content/docs/**/getting-started/auth.mdx');

        if (! $files) {
            $files = [];
        }

        CLI::write(implode(PHP_EOL, $files));

        if ($files === []) {
            return;
        }

        foreach ($files as $file) {
            $locale = $this->detectLocaleFromPath($file);
            $language = Services::language();
            $language->setLocale($locale);

            $authGroups = new AuthGroups();

            $fileContents = file_get_contents($file);

            foreach (self::COMMENT_BLOCK_IDS as $key => $block_id) {
                $pattern = '/(\{\/\*\s' . $block_id . ':START.*\*\/\})[\S\s]*(\{\/\*\s' . $block_id . ':END.*\*\/\})/';

                $handleInjectMethod = 'handle' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));

                $fileContents = $this->{$handleInjectMethod}($authGroups, $fileContents, $pattern);
            }

            // Write the contents back to the file
            file_put_contents($file, $fileContents);
        }
    }

    protected function handleInstanceRoles(AuthGroups $authGroups, string $fileContents, string $pattern): string
    {
        $instanceMatrix = $authGroups->matrix;
        return $this->renderCommentBlock(
            $fileContents,
            $pattern,
            ['role', 'description', 'permissions'],
            $authGroups->instanceGroups,
            static function ($table, $key, array $value) use ($instanceMatrix): void {
                $table->addRow($value['title'], $value['description'], implode(', ', $instanceMatrix[$key]));
            }
        );
    }

    protected function handleInstancePermissions(AuthGroups $authGroups, string $fileContents, string $pattern): string
    {
        return $this->renderCommentBlock(
            $fileContents,
            $pattern,
            ['permission', 'description'],
            $authGroups->instancePermissions,
            static function ($table, $key, $value): void {
                $table->addRow($key, $value);
            }
        );
    }

    protected function handlePodcastRoles(AuthGroups $authGroups, string $fileContents, string $pattern): string
    {
        $podcastMatrix = $authGroups->podcastMatrix;
        return $this->renderCommentBlock(
            $fileContents,
            $pattern,
            ['role', 'description', 'permissions'],
            $authGroups->podcastGroups,
            static function ($table, $key, array $value) use ($podcastMatrix): void {
                $table->addRow($value['title'], $value['description'], implode(', ', $podcastMatrix[$key]));
            }
        );
    }

    protected function handlePodcastPermissions(AuthGroups $authGroups, string $fileContents, string $pattern): string
    {
        return $this->renderCommentBlock(
            $fileContents,
            $pattern,
            ['permission', 'description'],
            $authGroups->podcastPermissions,
            static function ($table, $key, $value): void {
                $table->addRow($key, $value);
            }
        );
    }

    /**
     * @param array<string> $tableHeading
     * @param array<string, string>|array<string, array<string, string>> $data
     */
    private function renderCommentBlock(
        string $fileContents,
        string $pattern,
        array $tableHeading,
        array $data,
        Closure $callback
    ): string {
        // check if it has the start and end comments to insert roles table
        // looking for <AUTH-INSTANCE-ROLES-LIST:START> and <AUTH-INSTANCE-ROLES-LIST:END>

        $hasInstanceInsertComments = preg_match($pattern, $fileContents);

        if (! $hasInstanceInsertComments) {
            return $fileContents;
        }

        // prepare role table
        $table = new Table();
        $table->setHeading($tableHeading);

        foreach ($data as $key => $value) {
            $callback($table, $key, $value);
        }

        $converter = new HtmlConverter();
        $converter->getEnvironment()
            ->addConverter(new TableConverter());
        $markdownTable = str_replace(['{', '}'], ['\{', '\}'], $converter->convert($table->generate()));

        // insert table between block comments
        $newFileContents = preg_replace(
            $pattern,
            '${1}' . PHP_EOL . PHP_EOL . $markdownTable . PHP_EOL . PHP_EOL . '${2}',
            $fileContents
        );

        if ($newFileContents === null) {
            return $fileContents;
        }

        return $newFileContents;
    }

    private function detectLocaleFromPath(string $fileKey): string
    {
        preg_match(
            '~docs\/src\/content\/docs\/(?:([a-z]{2}(?:-[A-Za-z]{2,})?)\/)getting-started\/auth\.mdx~',
            $fileKey,
            $match
        );

        if ($match === []) {
            return 'en';
        }

        return $match[1];
    }
}
