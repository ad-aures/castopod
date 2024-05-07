<?php

declare(strict_types=1);

namespace Modules\Plugins;

use CodeIgniter\HTTP\URI;
use League\CommonMark\Environment\EnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class ExternalLinkProcessor
{
    private EnvironmentInterface $environment;

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }

    public function onDocumentParsed(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();
        $walker = $document->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            // Only stop at Link nodes when we first encounter them
            if (! ($node instanceof Link) || ! $event->isEntering()) {
                continue;
            }

            $url = $node->getUrl();
            if ($this->isUrlExternal($url)) {
                $node->data->append('attributes/target', '_blank');
                $node->data->append('attributes/rel', 'noopener noreferrer');
            }
        }
    }

    private function isUrlExternal(string $url): bool
    {
        // Only look at http and https URLs
        if (! preg_match('/^https?:\/\//', $url)) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);

        // TODO: load from environment's config
        // return $host != $this->environment->getConfiguration()->get('host');
        return $host !== (new URI(base_url()))->getHost();
    }
}
