<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<div class="title">

<?php 
// echo "<pre>";
// var_dump( $this->params ); 
// echo "</pre>";
?>

<?php if ( $this->params->get('show_page_heading')!=0) : ?>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
<?php endif; ?></div>

