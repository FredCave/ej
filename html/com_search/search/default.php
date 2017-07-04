<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die; ?>

<div id="search_results">

	<?php 

	/* SEARCH FORM IN DEFAULT_FORM.PHP */

	echo $this->loadTemplate('form'); 

	if ( $this->error==null && count($this->results ) > 0) {
		
		/* RESULTS IN DEFAULT_RESULTS.PHP */

		echo $this->loadTemplate('results');

	} else {

		/* ERROR IN DEFAULT_ERROR.PHP */

		echo $this->loadTemplate('error');

	} 

	?>

</div>
