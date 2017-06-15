<?php
/*------------------------------------------------------------------------
# mod_globalnews - Global News Module
# ------------------------------------------------------------------------
# author    Joomla!Vargas
# copyright Copyright (C) 2010 joomla.vargas.co.cr. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomla.vargas.co.cr
# Technical Support:  Forum - http://joomla.vargas.co.cr/forum
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

foreach ($list as $item) : ?>

	<div class="preview">
		<div class="preview_image">
			<?php 
			$image = $item->content; 
			// IF IMAGE IN FIELD
			$values = "/(jpg)|(png)|(gif)/i";
			if ( preg_match_all ($values, $image) ) {
				// REPLACE SRC WITH DATA-SRC
				echo str_replace("src", "data-src", $image);
			} else {
				// FALLBACK IMG IN MAIN CONTENT
				$text = $item->introtext;
				preg_match('/<img (.*?)>/', $text, $match);
				preg_match('/(src)=("[^"]*")/i', $match[0], $src);
				echo "<img " . $src[0] . "/>";
			} ?>
		</div>
		<div class="preview_text">
			<?php echo $item->title; ?>		
		</div>

	</div>

<?php endforeach; ?>

<?php
// ADD FOUR EMPTY BLOCKS FOR ALIGNMENT HACK
for ( $j = 0; $j < 4; $j++ ) {
	echo '<div class="preview"></div>';
}
?>