<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>

	<?php 

	// LOAD LINKS TEMPLATE
	if (!empty($this->link_items)) : 
		echo $this->loadTemplate('links');
	endif; ?>

	<?php 

	/*

	if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) :
		echo $this->loadTemplate('children');
	endif;

	if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) :
		if ($this->params->def('show_pagination_results', 1)) :
			echo $this->pagination->getPagesCounter();
		endif;
		echo $this->pagination->getPagesLinks();
	endif; 

	*/

	?>

