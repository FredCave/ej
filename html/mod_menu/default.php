<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.atomic
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

?>

<ul class="menu">

	<?php
	// LOOP THROUGH PAGES IN MENU
	foreach ( $list as $i => &$item) :

		$id = '';
		// ADD ID TO CURRENT PAGE
		if ($item->id == $active_id) {
			$id = ' id="current"';
		}
		$class = '';
		if ( in_array ($item->id, $path) ) {
			$class .= 'selected ';
		}
		if ( $item->deeper ) {
			$class .= 'parent ';
		}
		$class = ' class="'.$class.'item'.$item->id.'"';

		echo '<li' .$id.$class.'>';

		// RENDER THE MENU ITEM
		switch ($item->type) :
			case 'separator':
			case 'url':
			case 'component':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
			break;
		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
		endswitch;

		echo '</li>';

	endforeach; ?>
	
</ul>
