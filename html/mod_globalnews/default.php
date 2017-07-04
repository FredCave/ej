<?php
/*------------------------------------------------------------------------
# mod_globalnews - Global News Module
# ------------------------------------------------------------------------
# author    Jesús Vargas Garita
# copyright Copyright (C) 2010 joomlahill.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomlahill.com
# Technical Support:  Forum - http://www.joomlahill.com/forum
-------------------------------------------------------------------------*/

/************************************************ 

	PREVIEW PAGE TEMPLATE

************************************************/

// no direct access
defined('_JEXEC') or die;

$i = $j = 0;

foreach ($cat as $group) :

	$listCondition = $group->cond;
	$list  = modGlobalNewsHelper::getGN_List($params,$listCondition);

	if ( count($list) || $empty != 0 ) :
		$more = $params->get('more', 1);
		$i++; 
		$j++; ?>

		<div id="preview_page" class="previewdiv">
			<?php 
			if ( $show_cat != 0 ) : 

				/* PAGE TITLE */

				?>
				<div class="title">Archive: Preview</div>
			<?php endif;
			if ( count ($list) > 0 ) :
				
				/* LOOP TEMPLATE IN STATIC.PHP */

				require( JModuleHelper::getLayoutPath('mod_globalnews', $layout) );
				
			endif; ?>
		</div>

		<?php 
		if ( $i == $cols && $j != $total ) :
			$i=0; 
		endif;

	endif;

endforeach; ?>
