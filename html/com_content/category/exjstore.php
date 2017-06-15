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
<div class="wide"><?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
<?php  endif; ?>
	<div class="title">	<?php if ($this->params->get('show_page_heading')) : ?>
		<b><?php echo $this->escape($this->params->get('page_heading')); ?></b>
	<?php endif; ?>
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<?php echo $this->escape($this->params->get('page_subheading')); ?><!--: <?php if ($this->params->get('show_category_title')) : ?><?php echo $this->category->title;?><?php endif; ?>-->

	<?php endif; ?>
</div>
</div>
<hr style="width: 100%; margin-top:8px; margin-bottom: 0;">
<br class="br"/>
<div class="colwrap">


<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
	<?php foreach ($this->lead_items as &$item) : ?><div class="newsblock">
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		<?php
			$leadingcount++;
		?>
	</div><?php endforeach; ?>

<?php endif; ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>

	<?php foreach ($this->intro_items as $key => &$item) : ?><div class="newsblock">
	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>
	<?php endif; ?>
		<?php
			$this->item = &$item;
			echo $this->loadTemplate('item');
		?>
	
	<?php $counter++; ?>
	<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>

			<?php endif; ?>
	</div><?php endforeach; ?>


<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>

	<?php echo $this->loadTemplate('links'); ?>

<?php endif; ?>


	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
		<div class="cat-children">
		<h3>
<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
</h3>
			<?php echo $this->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>



<br class="br"></div>



