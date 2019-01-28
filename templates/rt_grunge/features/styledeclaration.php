<?php
/**
 * @package   Grunge Template - RocketTheme
* @version   1.6 October 18, 2018
* @author    RocketTheme, LLC http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Grunge Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $gantry->get('styledeclaration-enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
        global $gantry;

        $gantry->addLess('global.less', 'master.css', 8);

		//inline css for dynamic stuff
        $css = 'body a,#rt-copyright .title, #rt-main-surround .rt-article-title, #rt-main-surround .title, #rt-showcase .title,#rt-feature .title, #rt-showcase .showcase-title span{color:'.$gantry->get('linkcolor').';}';



        $gantry->addInlineStyle($css);

		//style stuff
        $gantry->addStyle($gantry->get('cssstyle').".css");

	}

}