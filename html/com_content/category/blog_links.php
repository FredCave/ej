<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

// Create some shortcuts.
$params		= &$this->item->params;
$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>

<div class="title">

	<?php 

	/* ALPHABETICAL SORTING */ ?>

	<div class="left">
		<a href="#" id="alphabetical_sorting" title="alphabetical">alphabetical</a>	
		<div class="sort_arrows">
			<span class="sort_asc sort_arrow"><img src="<?php echo $this->baseurl ?>/templates/exj/assets/img/sort_asc.png" /></span>
			<span class="sort_desc sort_arrow"><img src="<?php echo $this->baseurl ?>/templates/exj/assets/img/sort_desc.png" /></span>
		</div>
		<?php // echo JHtml::_('grid.sort', 'alphabetical', 'a.title', $listDirn, $listOrder) ; ?>
	</div>

	<?php 

	/* CHRONOLOGICAL SORTING */ ?>

	<div class="right">
		<div class="sort_arrows">
			<span class="sort_asc sort_arrow"><img src="<?php echo $this->baseurl ?>/templates/exj/assets/img/sort_asc.png" /></span>
			<span class="sort_desc sort_arrow"><img src="<?php echo $this->baseurl ?>/templates/exj/assets/img/sort_desc.png" /></span>	
		</div>
		<a href="#" id="chronological_sorting" title="chronological">chronological</a>
		<?php // echo JHtml::_('grid.sort', 'chronological', 'a.created', $listDirn, $listOrder); ?>		
	</div>

	<?php 

	/* PAGE TITLE */

	if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) :
		if ($this->params->get('show_category_title')) :
			echo $this->category->title;
		endif;
		echo $this->escape($this->params->get('page_subheading'));
	endif; ?>

</div><!-- END OF .TITLE -->

<div id="archive_list" class="narrowcol">

	<?php 
	// IF LIST IS EMPTY
	if (empty($this->items)) : 
		if ($this->params->get('show_no_articles', 1)) : 
			echo JText::_('COM_CONTENT_NO_ARTICLES'); 
		endif; 
	else : 
		// SORTING FUNCTIONALITY??
		/* 
		?>
		<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
		<?php if ($this->params->get('show_headings') || $this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
			<fieldset class="filters">
				<input type="hidden" name="filter_order" value="" />
				<input type="hidden" name="filter_order_Dir" value="" />
				<input type="hidden" name="limitstart" value="" />
			</fieldset>
		<?php endif;  */ 
	endif; ?>	

		<?php 

		foreach ($this->items as $i => $article) :

			/* PREPARE TAGS TO STORE IN HTML */ 

			$article->tags = new JHelperTags;
			$tags = $article->tags->getItemTags('com_content.article', $article->id);
			$tag_str = "";
			// LOOP THROUGH AVAILABLE TAGS
			foreach ( $tags as $tag ) { 
				$tag_str = $tag_str . $tag->title . ", ";
			}
			$tag_str = substr($tag_str, 0, -2);

			if ( in_array($article->access, $this->user->getAuthorisedViewLevels()) ) : ?>
				<div class="line" data-key="<?php echo $tag_str; ?>" data-date="<?php echo JHtml::_( 'date', $article->displayDate, "Ymd" ); ?>">
					<div class="left">
						
						<?php 

						/* TO BE FILED */

						if ($article->catid == "50"): ?>
							<?php if ($article->params->get('access-edit')) : ?>
								<?php echo JHtml::_('icon.edit', $article, $params); ?>
							<?php endif; ?>
							<span class="tobefiled">
								<?php echo $this->escape($article->title); ?>	
							</span>
						<?php 

						/* FILED */

						else : ?>
							<?php if ($article->params->get('access-edit')) : ?>
								<?php echo JHtml::_('icon.edit', $article, $params); ?>
							<?php endif; ?>
							<a class="cat<?php echo $article->catid?>" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
								<?php echo $this->escape($article->title); ?>	
							</a>
						<?php endif; ?>

					</div><!-- END OF .LEFT -->
					<div class="right">
						<?php echo JHtml::_('date', $article->displayDate, $this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC2')))); ?>
					</div><!-- END OF .RIGHT -->
				</div><!-- END OF .LINE-->


				<?php /* <br class="removeiffirst"/> */ ?>


			<?php else : // SHOW UNAUTH LINKS
				if ( $article->catid == "50" ): ?>
					<s><?php echo $this->escape($article->title); ?></s>
				<?php else : ?>
					<a class="<?php echo $article->catid;?>" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
						<?php echo $this->escape($article->title); ?>	
					</a>
					<!-- </div> ?? -->
					<br class="removeiffirst"/>
				<?php endif; 
			endif; 

		endforeach; ?>

	<!-- </div> ?? -->
	
	<?php 
	// IF LIST IS NOT EMPTY
	/*
	if (!empty($this->items)) : ?>	
		</form>
	<?php endif; 
	*/
	?>

</div><!-- END OF .ARCHIVE_LIST -->
