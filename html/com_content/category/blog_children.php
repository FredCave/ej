<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
?>

<?php if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>
	<?php foreach($this->children[$this->category->id] as $id => $child) : ?>
		<?php
		if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
			if (!isset($this->children[$this->category->id][$id + 1])) :
				$class = ' class="last"';
			endif;
		?>
			<?php $class = ''; ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
				<?php echo $this->escape($child->title); ?></a>
		

			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
			<?php if ($child->description) : ?>
					<?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
			<?php endif; ?>
            <?php endif; ?>

			<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
					(<?php echo $child->getNumItems(true); ?>)
			<?php endif ; ?>
<br />
			<?php if (count($child->getChildren()) > 0):
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				if ($this->maxLevel != 0) :
					echo $this->loadTemplate('children');
				endif;
				$this->category = $child->getParent();
				$this->maxLevel++;
			endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
