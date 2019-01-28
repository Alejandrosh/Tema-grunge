<?php
/**
 * @package   Template Overrides - RocketTheme
* @version   1.6 October 18, 2018
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Gantry Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="breadcrumbs">
<?php if ($params->get('showHere', 1))
	{
		echo '<span class="sep">' .JText::_('MOD_BREADCRUMBS_HERE').'</span>';
	}
?>
<?php for ($i = 0; $i < $count; $i ++) :

	// If not the last item in the breadcrumbs add the separator
	if ($i < $count -1) {
		if (!empty($list[$i]->link)) {
			echo '<a href="'.$list[$i]->link.'" class="pathway">'.$list[$i]->name.'</a>';
		} else {
			echo $list[$i]->name;
		}
		if($i < $count -2){
			echo ' <span class="sep">&nbsp;&raquo;&nbsp;</span> ';
		}
	}  else if ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
		if($i > 0){
			echo ' <span class="sep">&nbsp;&raquo;&nbsp;</span> ';
		}
		echo $list[$i]->name;
	}
endfor; ?>
</div>
