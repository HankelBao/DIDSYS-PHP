<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Functionality for the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
namespace PMA\libraries\navigation\nodes;

use PMA;

/**
 * Represents a trigger node in the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
class NodeTrigger extends Node
{
    /**
     * Initialises the class
     *
     * @param string $name     An identifier for the new node
     * @param int    $type     Type of node, may be one of CONTAINER or OBJECT
     * @param bool   $is_group Whether this object has been created
     *                         while grouping nodes
     */
    public function __construct($name, $type = Node::OBJECT, $is_group = false)
    {
        parent::__construct($name, $type, $is_group);
        $this->icon = PMA\libraries\Util::getImage('b_triggers.png');
        $this->links = array(
            'text' => 'db_triggers.php?server=' . $GLOBALS['server']
                . '&amp;db=%3$s&amp;item_name=%1$s&amp;edit_item=1'
                . '&amp;token=' . $_SESSION[' PMA_token '],
            'icon' => 'db_triggers.php?server=' . $GLOBALS['server']
                . '&amp;db=%3$s&amp;item_name=%1$s&amp;export_item=1'
                . '&amp;token=' . $_SESSION[' PMA_token '],
        );
        $this->classes = 'trigger';
    }
}

