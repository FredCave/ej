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

/************************************************ 

	ARCHIVE PAGE OUTER TEMPLATE

************************************************/

// LOAD LINKS TEMPLATE
if (!empty($this->link_items)) : 
	
	// LINKS IN BLOG_LINKS.PHP

	echo $this->loadTemplate('links');

endif; ?>
