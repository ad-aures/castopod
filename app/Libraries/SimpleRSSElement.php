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

class SimpleRSSElement extends SimpleXMLElement
{
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

        if (is_array($value)) {
            return $newChild;
        }

        $node->appendChild($no->createTextNode($value));

        return $newChild;
    }
}
