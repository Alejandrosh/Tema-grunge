<?php
/**
 * @package   Grunge Template - RocketTheme
* @version   1.6 October 18, 2018
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Grunge Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureToTop extends GantryFeature {
    var $_feature_name = 'totop';

	function init() {
		global $gantry;
		
		if ($this->get('enabled')) {
			$gantry->addScript($gantry->gantryUrl.'/js/gantry-totop.js');
		}
	}
	
	function render($position="") {
	    ob_start();
	    ?>
	    <div class="rt-block totop-block">
			<a href="#" id="gantry-totop"><span class="totop-desc"><?php echo $this->get('text'); ?></span></a>
		</div>
		<?php
	    return ob_get_clean();
	}
}