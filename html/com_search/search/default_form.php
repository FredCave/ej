<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>

<div class="title">
	Search results <?php echo $this->pagination->getPagesCounter(); ?>
</div>

<div class="article"><div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>

<div class="search_form_child">
	<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">
	<fieldset class="word">
		<input type="text" name="searchword" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="resultbox" />
		<button name="Search" onclick="this.form.submit()" class="button"><?php echo JText::_('COM_SEARCH_SEARCH');?></button>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="data[categories][]" value="65" />
	</fieldset>
</div>

<div class="search_form_child">
	<?php if (!empty($this->searchword)):?>
		<p>Searched for <b><?php echo $this->escape($this->origkeyword); ?></b>
		<p><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total);?></p>
	<?php endif;?>
</div>

<?php if ($this->total > 20) : ?>

	<div class="form-limit">
		<label for="limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>

<?php endif; ?>

</form>
