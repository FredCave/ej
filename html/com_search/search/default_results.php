<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="col">

	<?php foreach($this->results as $result) : ?>

		<div class="block">	
			<p>
			<?php if ( $result->href ) : ?>
				<a class="news" href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
					<?php echo $this->pagination->limitstart + $result->count.'. ';?><?php echo $this->escape($result->title);?>
				</a>
			<?php else: ?>
				<?php echo $this->escape($result->title);?>
			<?php endif; ?>
			</p>
			<?php echo $result->text; ?>
		</div>

	<?php endforeach; ?>

</div>

