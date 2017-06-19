<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.exj
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// NO DIRECT ACCESS
defined('_JEXEC') or die;

// LOAD THE MOOTOOLS JAVASCRIPT LIBRARY 
// DISABLED
// JHtml::_('behavior.framework', true);

// GET THE APPLICATION OBJECT 
$app = JFactory::getApplication();

?>

<!doctype html>
<html class="no-js" lang="<?php echo $this->language; ?>">
    <head>
		
		<?php 
		// JDOC HEAD DISABLED – WAS DUPLICATING TAGS ?>
		<jdoc:include type="head" /> 

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $this->getTitle(); ?></title>
        <meta name="description" content="">
        <?php // SCALING NEEDS TESTING ?>
        <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=1.2, minimum-scale=0.6, user-scalable=yes">

		<?php // MAKE FULL SCREEN ON iOS */ ?>
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

		<link rel="shortcut icon" type="image/png" href="/customicons/favicon.png"/>

        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/exj.css" type="text/css" />

		<script>
			// FIX IE CONSOLE ERRORS
			if (!window.console) console = {log: function() {}}; 
			// SET ROOT
			var ROOT = '<?= JURI::root(); ?>';
		</script>

    </head>
    <body>
		<!-- // INCLUDE NEDSTAT PRO CODE V2.005H – DISABLED -->
		<!-- <script type="text/javascript" src="js/nedstat.js"></script> -->