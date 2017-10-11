<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 || later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') || die;

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images 	= json_decode($this->item->images);
$urls 		= json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();

// REDIRECT VIA JAVASCRIPT TO PARENT NEWS PAGE IF NEWS ARTICLE
if ( $params["page_title"] === "News" ) {
	echo '<script type="text/javascript">
           window.location = ROOT + "news/"
      	</script>';
}

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

/************************************************ 

	ARTICLE, ABOUT, CONTACT PAGES TEMPLATE

************************************************/

// FUNCTION FOR GETTING NEXT + PREVIOUS TITLES
function getSiblingTitle ( $article_id ) {
	$db = JFactory::getDbo();
	$query = $db->getQuery(true)
	    ->select($db->quoteName('title'))
	    ->from($db->quoteName('#__content'))
	    ->where('id = '. $db->Quote($article_id));
	$db->setQuery($query);
	return $db->loadResult();
}

// EXTRACT IDs FROM NEXT/PREVIOUS LINKS
$nextExists = false;
$prevExists = false;
if ( property_exists( $this->item, "next" ) ) {
	if ( $this->item->next !== "" ) {

		// HOW TO GET ID??????


		// echo $this->item->next;
		$nextId = explode ( "-", explode("archive/", $this->item->next)[1] )[0];
		$nextExists = true; 
	}
}
if ( property_exists( $this->item, "prev" ) ) {
	if ( $this->item->prev !== "" ) {
		// var_dump($this->item->prev);
		$prevId = explode ( "-", explode("archive/", $this->item->prev)[1] )[0];
		$prevExists = true; 
	}
} 

// var_dump( $this->item->next );

?>

<div class="pagenavtop">
	<div class="navleft">
		<?php if ( $prevExists ) { 
			echo $this->item->prev;
			?>
			<a class="navlink" href="<?php echo $this->item->prev; ?>" rel="prev"><?php echo getSiblingTitle ( $prevId ); ?></a>
			<span><&nbsp;</span>
		<?php } ?>
	</div>
	
	<div class="navright">
		<?php if ( $nextExists ) { 
			echo $this->item->next;
			?>
			<span>>&nbsp;</span>
			<a class="navlink" href="<?php echo $this->item->next; ?>" rel="next"><?php echo getSiblingTitle ( $nextId ); ?></a>
		<?php } ?>
	</div>
	
</div>


<?php 
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

	/* GET TAGS */

$this->item->tags = new JHelperTags;
$tags = $this->item->tags->getItemTags('com_content.article', $this->item->id);
$tag_str = "";

	/* LOOP THROUGH AVAILABLE TAGS */

foreach ( $tags as $tag ) { 
	$tag_str = $tag_str . "<a class='plain' href='". $this->baseurl ."/?tag=" . urlencode($tag->title) . "'>" . ucfirst( $tag->title ) . "</a>, ";
}
$tag_str = substr($tag_str, 0, -2);

	/* IF TAGS EXIST */

if ( strlen ( $tag_str ) > 0 ) : ?>

	<div class="keywords">
		<p>Filed under:</p>
		<p><?php echo $tag_str; ?></p>
	</div>

<?php endif; ?>

<div class="pagenavtitles">
	<?php if ( $nextExists ) { ?>
		<p>next: <a class="" href="<?php echo $this->item->next; ?>" rel="next"><?php echo getSiblingTitle ( $nextId ); ?></a></p>
	<?php } ?>
	<?php if ( $prevExists ) { ?>
		<p>prev: <a href="<?php echo $this->item->prev; ?>" rel="prev"><?php echo getSiblingTitle ( $prevId ); ?></a></p>
	<?php } ?>	
</div>
