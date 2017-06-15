<?php 
/* HEADER CODE MOVED TO EXTERNAL FILE: INCLUDES/HEADER */
include("includes/header.php"); ?>

<div class="container">

	<div class="menufield">
		
		<?php 

		/* SEARCH MODULE */

		if ( $this->countModules('exj-search') ) : ?>
			<div class="search">
				<jdoc:include type="modules" name="exj-search"/>
			</div>
		<?php endif; ?>

		<a id="sitename" href="<?php echo $this->baseurl ?>">Experimental Jetset</a>

		<?php 

		/* MENU MODULE */

		if($this->countModules('exj-menu')) : ?>
			<div class="top_left">
				<jdoc:include type="modules" name="exj-menu"/>
			</div>
		<?php endif; 

		/* BREADCRUMBS */

		if($this->countModules('exj-menu2')) : ?>
			<jdoc:include type="modules" name="exj-menu2"/>
			<?php 
		endif; 

		/* CATEGORIES */

		if ( $this->countModules('exj-menu4')) : ?>
			<div class="topright">
				<jdoc:include type="modules" name="exj-menu4"/>
			</div>
		<?php endif;  ?>

	</div><!-- END OF MENUFIELD -->

	<?php 

	/* MAIN CONTENT */ ?>

	<div id="main_content">

		<?php 

		/* PREVIEW */

		if($this->countModules('exj-nav')) : ?>
			<jdoc:include type="modules" name="exj-nav" style="none" />
		<?php endif; ?>	

		<?php 

		/* MAIN CONTENT */ ?>

		<jdoc:include type="component" />

	</div>

</div><!-- END OF CONTAINER -->

<?php 
/* FOOTER CODE MOVED TO EXTERNAL FILE: INCLUDES/FOOTER */
include("includes/footer.php"); 
?>
