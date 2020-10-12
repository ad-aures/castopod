<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use SimpleXMLElement;

class SimpleRSSElement extends SimpleXMLElement
{
    /**
     * Adds a child with $value inside CDATA
     *
     * @param string $name — The name of the child element to add.
     * @param string $value — [optional] If specified, the value of the child element.
     * @param string $namespace [optional] If specified, the namespace to which the child element belongs.
     */
    public function addChildWithCDATA($name, $value = null, $namespace = null)
    {
        $new_child = parent::addChild($name, null, $namespace);

        if ($new_child !== null) {
            $node = dom_import_simplexml($new_child);
            $no = $node->ownerDocument;
            $node->appendChild($no->createCDATASection($value));
        }

        return $new_child;
    }

    /**
     * Adds a child element to the XML node with escaped $value if specified.
     * Override of addChild method as SimpleXMLElement's addChild method doesn't escape ampersand
     *
     * @param string $name — The name of the child element to add.
     * @param string $value — [optional] If specified, the value of the child element.
     * @param string $namespace [optional] If specified, the namespace to which the child element belongs.
     */
    public function addChild($name, $value = null, $namespace = null)
    {
        $new_child = parent::addChild($name, null, $namespace);

        if ($new_child !== null) {
            $node = dom_import_simplexml($new_child);
            $no = $node->ownerDocument;
            $node->appendChild($no->createTextNode(esc($value)));
        }

        return $new_child;
    }
}
