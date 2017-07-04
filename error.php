<?php 
/* HEADER CODE MOVED TO EXTERNAL FILE: INCLUDES/HEADER */
include("includes/header.php"); ?>

<div class="container error_page">

	<div class="menufield">

		<a id="sitename" href="<?php echo $this->baseurl ?>">Experimental Jetset</a>

	</div>

	<div class='title'>
		<strong>
			<?php echo $this->error->getCode(); ?> - <?php echo $this->error->getMessage(); ?>	
		</strong>
	</div>

	<div class="error_message">

		<p><?php echo $this->error->getMessage(); ?></p>
		
		<p>
			<?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?>
			a <b>slip up</b> we made, 
			<?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?>,
			<?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?>,
			<?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?>, or
			<?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?>.
		</p>

		<p>
			Anyway:
			<?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?>
			And: 
			<?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?>
		</p>

		<strong>
			<?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?>
		</strong>
		<p>
			<a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>">Archive</a>
			<a href="<?php echo $this->baseurl; ?>/index.php?option=com_search" title="<?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?>">Search</a>
		</p>

		<div><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></div>

	</div>

	<div class="search">
		<jdoc:include type="modules" name="exj-search"/>
	</div>

	<jdoc:include type="modules" name="exj-menu"/>

</div><!-- END OF .ERROR PAGE -->

<?php 
/* FOOTER CODE MOVED TO EXTERNAL FILE: INCLUDES/FOOTER */
include("includes/footer.php"); 
?>