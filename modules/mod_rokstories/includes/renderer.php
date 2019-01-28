<?php
/**
 * @version   $Id: renderer.php 6796 2013-01-27 19:56:01Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('JPATH_PLATFORM') or die;
check_token('request') or jexit('Invalid Token');

class RTRenderer
{
	public function render()
	{
		$module_name = JFactory::getApplication()->input->getString('module');
		$module_id   = JFactory::getApplication()->input->getInt('moduleid');

		$db = JFactory::getDBO();
		if (isset($module_name)) {
			$query = "SELECT DISTINCT * from #__modules where title=" . $db->quote($module_name);
		} else if (isset($module_id)) {
			$query = "SELECT DISTINCT * from #__modules where id=" . $module_id;
		} else {
			die;
		}

		$db->setQuery($query);
		$result = $db->loadObject();

		if ($result) {

			$document       = JFactory::getDocument();
			$renderer       = $document->loadRenderer('module');
			$options        = array('style' => "raw");
			$module         = JModuleHelper::getModule($result->module);
			$module->params = $result->params;

			$output = $renderer->render($module, $options);

			echo $output;
		}
	}
}