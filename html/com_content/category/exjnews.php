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

	NEWS PAGE TEMPLATE

************************************************/

?>

<div class="wide">

	<div class="news_title title">	
		
		<?php 
		
		/* TITLE (PAGE X OF Y) */

		if ( $this->params->get('show_category_title', 1) || 
			$this->params->get('page_subheading')) :

				echo "<b>News</b> ";

				if ( $this->params->def('show_pagination_results', 1) ) : ?>
					(&thinsp;<?php echo $this->pagination->getPagesCounter(); ?>&thinsp;)
				<?php 
				endif;
		endif; ?>

	</div>

	<div class="news_pagination">

		<?php 

		/* PAGINATION TOP */

		if ( ($this->params->def('show_pagination', 1) == 1 || 
			($this->params->get('show_pagination') == 2)) && 
			($this->pagination->get('pages.total') > 1)) : 
				
				/* PAGINATION IS IN TEMPLATE -> PAGINATION.PHP */
				echo $this->pagination->getPagesLinks();

		endif; ?>
	</div>

</div>

<div class="colwrap news_cols">

	<?php 

	/* REMOVED LEAD ITEMS FROM BACK-END */

	$leadingcount = 0;
	/* if ( !empty( $this->lead_items) ) :
		foreach ( $this->lead_items as &$item ) : ?>
			<div class="newsblock">
				<?php
				$this->item = &$item;
				// echo $this->loadTemplate('item');
				// REMOVE &NBSP FROM TEXT
				$html = preg_replace("/\&nbsp;/",' ', $this->loadTemplate('item') );
				echo $html;
				$leadingcount++;
				?>
		</div>
	<?php endforeach;
	endif; */

	$introcount = (count( $this->intro_items ));
	$counter=0;

	/* INDIVIDUAL NEWS ITEM TEMPLATES IN EXJNEWS_ITEM.PHP */ 

	if ( !empty($this->intro_items) ) :
		foreach ( $this->intro_items as $key => &$item ) : ?>
			<div class="newsblock">
				<?php
				$key = ( $key - $leadingcount ) + 1;
				$rowcount = ( ((int)$key-1) % (int) $this->columns ) + 1;
				$row = $counter / $this->columns;
				$this->item = &$item;
				// REMOVE &NBSP FROM TEXT
				$html = preg_replace("/\&nbsp;/",' ', $this->loadTemplate('item') );
				// REPLACE IMG SRC BY DATA-SRC FOR LAZYLOADING
				echo str_replace("src", "data-src", $html);
				$counter++; ?>
			</div>
		<?php endforeach; 

		// ADD FOUR EMPTY BLOCKS FOR ALIGNMENT HACK
		for ( $j = 0; $j < 4; $j++ ) {
			echo '<div class="newsblock"></div>';
		}

	endif; ?>

</div>

<?php 

/* PAGINATION BOTTOM */ ?>

<div class="news_pagination">

<?php if ( ($this->params->def('show_pagination', 1) == 1 || 
	($this->params->get('show_pagination') == 2)) && 
	($this->pagination->get('pages.total') > 1)) : 
		echo $this->pagination->getPagesLinks();
endif; ?>

</div>