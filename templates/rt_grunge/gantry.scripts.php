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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

function gantry_params_init(){
    global $gantry;

    $tpl_name = "rt-grunge";
    $jc_component_tpl_dir = JPATH_ROOT."/components/com_jcomments/tpl";
    $grunge_tpl_dir= $gantry->templatePath ."/html/com_jcomments/tpl/".$tpl_name;
    if (!file_exists($jc_component_tpl_dir."/".$tpl_name) && file_exists($jc_component_tpl_dir) && is_dir($jc_component_tpl_dir) && is_writable($jc_component_tpl_dir)){
        jimport('joomla.filesystem.folder');
        JFolder::copy($grunge_tpl_dir, $jc_component_tpl_dir."/".$tpl_name);
    }
}


