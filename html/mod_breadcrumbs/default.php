<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_breadcrumbs
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

if ( $params->get('showHere', 1) ) {
	echo '' .JText::_('MOD_BREADCRUMBS_HERE').'';
}

// GET RID OF DUPLICATED ENTRIES ON TRAIL INCLUDING HOME PAGE WHEN USING MULTILANGUAGE
for ($i = 0; $i < $count; $i ++) {
	if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i-1]->link) && $list[$i]->link == $list[$i-1]->link) {
		unset($list[$i]);
	}
}

// FIND LAST AND PENULTIMATE ITEMS IN BREADCRUMBS LIST
end($list);
$last_item_key = key($list);
prev($list);
$penult_item_key = key($list);

// GENERATE THE TRAIL
foreach ($list as $key=>$item) :
	// MAKE A LINK IF NOT THE LAST ITEM IN THE BREADCRUMBS
	$show_last = $params->get('showLast', 1);
	if ( $key != $last_item_key ) { 
		// DO NOTHING
	} elseif ( $show_last ) {
		// RENDER LAST ITEM IF REQD.
		echo '' . $separator . ' ' . $item->name . '';
	}
endforeach; 

?>
