<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 || later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') || die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();

// TEMPLATE FOR SINGLE POSTS, ABOUT + CONTACT

if ( !empty($this->item->pagination) 
	&& $this->item->pagination 
	&& !$this->item->paginationposition 
	&& $this->item->paginationrelative ) {
		echo $this->item->pagination;
	}

echo $this->item->event->beforeDisplayContent;

if ( $this->params->get('show_page_heading') ) : 
	echo $this->escape($this->params->get('page_heading'));
endif; ?>

<div class="article">

	<?php
	
	/* TITLE */ ?>

	<div class="article_title">

		<?php if ( $params->get('show_title') ) : ?>
			<b>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>"><?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
			</b>
		<?php endif; ?>

	</div>

	<?php 

	/* DATE */ ?>

	<?php if ( $params->get('show_create_date') ) :
		echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('F Y'))); 
	endif;

	if ( $params->get('access-view') ) {

		/* CONTENT */ ?>

		<div class="article_content">

			<?php 
			$content = $this->item->text; 
			// REPLACE IMG SRC WITH DATA-SRC ATTRIBUTE
			echo str_replace("src", "data-src", $content);
			?>

		</div>

	<?php } ?>

</div><!-- END OF .ARTICLE -->

<?php 
/*

<div class="keywords">
	<p>Filed under:</p>
	<p><a class="plain" href="/index.php/component/taxonomy/texts%20/%20interviews?Itemid=59">texts / interviews</a></p>
</div>



<div class="pagenavtitles">
	<p>next: <a class="archive" href="<?php echo $this->item->next; ?>" rel="next">Next</a></p>
	<p>prev: <a href="<?php echo $this->item->prev; ?>" rel="prev">Previous</a></p>
</div>

*/ ?>


<?php

/*
Filed under:
texts / interviews
next: NAiM Re-Action
prev: Interview / Confessions
*/ 


?>

