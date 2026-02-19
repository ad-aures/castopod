<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use DOMDocument;
use Override;
use SimpleXMLElement;

class RssFeed extends SimpleXMLElement
{
    public const ATOM_NS = 'atom';

    public const ATOM_NAMESPACE = 'http://www.w3.org/2005/Atom';

    public const ITUNES_NS = 'itunes';

    public const ITUNES_NAMESPACE = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    public const PODCAST_NS = 'podcast';

    public const PODCAST_NAMESPACE = 'https://podcastindex.org/namespace/1.0';

    public function __construct(string $contents = '')
    {
        parent::__construct(sprintf(
            "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:atom='%s' xmlns:itunes='%s' xmlns:podcast='%s' xmlns:content='http://purl.org/rss/1.0/modules/content/'>%s</rss>",
            $this::ATOM_NAMESPACE,
            $this::ITUNES_NAMESPACE,
            $this::PODCAST_NAMESPACE,
            $contents,
        ));
    }

    /**
     * Adds a child with $value inside CDATA
     *
     * @param string $name — The name of the child element to add.
     * @param string $value — [optional] If specified, the value of the child element.
     * @param string|null $namespace [optional] If specified, the namespace to which the child element belongs.
     *
     * @return static The addChild method returns a SimpleXMLElement object representing the child added to the XML node.
     */
    public function addChildWithCDATA(string $name, string $value = '', ?string $namespace = null): static
    {
        $newChild = parent::addChild($name, null, $namespace);
        $node = dom_import_simplexml($newChild);
        $no = $node->ownerDocument;
        if ($no instanceof DOMDocument) {
            $node->appendChild($no->createCDATASection($value));
        }

        return $newChild;
    }

    /**
     * Adds a child element to the XML node with escaped $value if specified. Override of addChild method as
     * SimpleXMLElement's addChild method doesn't escape ampersand
     *
     * @param string $name — The name of the child element to add.
     * @param string $value — [optional] If specified, the value of the child element.
     * @param string $namespace [optional] If specified, the namespace to which the child element belongs.
     * @param boolean $escape [optional] The value is escaped by default, can be set to false.
     *
     * @return static The addChild method returns a SimpleXMLElement object representing the child added to the XML node.
     */
    #[Override]
    public function addChild($name, $value = null, $namespace = null, $escape = true): static
    {
        $newChild = parent::addChild($name, null, $namespace);
        $node = dom_import_simplexml($newChild);
        $no = $node->ownerDocument;
        $value = $escape ? esc($value ?? '') : $value ?? '';
        if (! $no instanceof DOMDocument) {
            return $newChild;
        }

        $node->appendChild($no->createTextNode($value));

        return $newChild;
    }

    /**
     * Add RssFeed code into a RssFeed
     *
     * adapted from: https://stackoverflow.com/a/23527002
     *
     * @param self|array<self> $nodes
     */
    public function appendNodes(self|array $nodes): void
    {
        if (! is_array($nodes)) {
            $nodes = [$nodes];
        }

        foreach ($nodes as $element) {
            $namespaces = $element->getNamespaces();
            $namespace = array_first($namespaces) ?? null;

            if (trim((string) $element) === '') {
                $simpleRSS = $this->addChild($element->getName(), null, $namespace);
            } else {
                $simpleRSS = $this->addChild($element->getName(), (string) $element, $namespace);
            }

            foreach ($element->children() as $child) {
                $simpleRSS->appendNodes($child);
            }

            foreach ($element->attributes() as $name => $value) {
                $simpleRSS->addAttribute($name, (string) $value);
            }
        }
    }
}
