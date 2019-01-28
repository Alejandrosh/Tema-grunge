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
defined('JPATH_BASE') or die();

$gantry_config_mapping = array(
    'belatedPNG' => 'belatedPNG',
);

$gantry_presets = array(
    'presets' => array(
        'preset1' => array(
            'name' => 'Preset 1',
            'cssstyle' => 'style1',
            'linkcolor' => '#A46923',
            'font-family' => 'bebas',
			'backgroundlevel' => 'high',
			'bodylevel' => 'high'
        )
    )
);

$gantry_browser_params = array(
    'ie7' => array(
        'backgroundlevel' => 'low',
        'bodylevel' => 'low'
    )
);

$gantry_belatedPNG = array('.readon1-r','a.readon span','.readon span','.button','#rt-header','.topcuts','.topline','#rt-main-surround .rt-joomla ul li','.module .sections li a','.module .latestnews li a','.bottomtopper','.contentdate','.readon a','.readon','.module-divider','.articledivider','#rt-breadcrumbs','.rokstories-layout2','#rt-top','.png');