<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// NO DIRECT ACCESS
defined('_JEXEC') or die;

// CREATE A SHORTCUT FOR PARAMS
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

if ($this->item->state == 0) : ?>
	<div class="system-unpublished">
<?php endif;

/* DATE */ ?>

<div class="news_item_date">
	<?php if ($params->get('show_create_date')) :
		echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')));
	endif; ?>
</div>

<?php

/* TITLE */

if ($params->get('show_title')) : ?>
	<b class="news_item_title">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</b>
<?php endif; 

// REMOVE LINK FROM IMAGES IN CONTENT
// $notagintrotex =strip_tags( $this->item->introtext, '<img>');
$notagintrotex = $this->item->introtext;
// IF IMAGE FIRST IN CONTENT
$class = "";
if ( substr( $notagintrotex, 0, 5 ) === "<img " ) {
	$class = "image_first";
} ?>

<div class="news_item_content <?php echo $class; ?>">
	
	<?php echo $notagintrotex; ?>

</div>

