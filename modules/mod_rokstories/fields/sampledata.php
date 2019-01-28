<?php
/**
 * @version   $Id: sampledata.php 6796 2013-01-27 19:56:01Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die();
/**
 * @package    RocketTheme
 * @subpackage rokstories.elements
 */
class JFormFieldSampledata extends JFormField
{
	public function getInput()
	{
		$output   = '';
		$document = JFactory::getDocument();

		if (defined('ROKSTORIES_ADMIN')) return;
		define('ROKSTORIES_ADMIN', 1);

		$document->addStyleSheet(JURI::Root(true) . "/modules/mod_rokstories/admin/rokstories-admin.css");

		$module_id = JFactory::getApplication()->input->getInt('cid');
		if (is_array($module_id)) $module_id = $module_id[0];
		if (!$module_id) $module_id = JFactory::getApplication()->input->getInt('id');

		$document->addScript(JURI::Root(true) . "/modules/mod_rokstories/admin/importData.js");
		$url = JRoute::_(JURI::Root(true) . "/modules/mod_rokweather/ajax.php?moduleid=" . $module_id . "&" . JSession::getFormToken() . "=1", true);
		$document->addScriptDeclaration("window.RokStoriesAdminPath = '" . $url . "'");

		$output .= "<div id='rokstories-admin-wrapper'>
						<div>
							<button>Import Sample Data</button>
						</div>
					</div>";

		return $output;
	}
}

?>