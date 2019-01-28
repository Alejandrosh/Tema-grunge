<?php
/**
 * @package     Joomla.Installation
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Controller class to install the sample data for the Joomla Installer.
 *
 * @since  3.1
 */
class InstallationControllerInstallSample extends JControllerBase
{
	/**
	 * Execute the controller.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function execute()
	{
		// Get the application
		/* @var InstallationApplicationWeb $app */
		$app = $this->getApplication();

		// Check for request forgeries.
		JSession::checkToken() or $app->sendJsonResponse(new Exception(JText::_('JINVALID_TOKEN'), 403));

		// Get the setup model.
		$model = new InstallationModelSetup;

		// Get the options from the session
		$options = $model->getOptions();

		// Get the database model.
		$db = new InstallationModelDatabase;

		// Attempt to create the database tables.
		$return = $db->installSampleData($options);

		// RocketTheme Manifest Cache Refresh for Sample Data
		$return = $this->_RTMCR($db, $options);

		$r = new stdClass;
		$r->view = 'install';

		// Check if the database was initialised
		if (!$return)
		{
			$r->view = 'database';
		}

		$app->sendJsonResponse($r);
	}

	public function _RTMCR($model, $options) {
		// Get the application
		/* @var InstallationApplicationWeb $app */
		$app = $this->getApplication();

		if (!$db = $model->initialise($options))
		{
			return true;
		}

		// Attempt to refresh manifest caches.
		$query = $db->getQuery(true);
		$query->clear()
			->select('*')
			->from('#__extensions');
		$db->setQuery($query);

		try
		{
			$extensions = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			$app->enqueueMessage($e->getMessage(), 'notice');
			return true;
		}

		JFactory::$database = $db;
		$installer = JInstaller::getInstance();

		foreach ($extensions as $extension)
		{
			// exclude Gantry4 from manifest refresh since it causes issues
			if ($extension->name == 'Gantry' && $extension->element == 'com_gantry') {
				continue;
			}

			if (!$installer->refreshManifestCache($extension->extension_id))
			{
				$app->enqueueMessage(JText::sprintf('INSTL_DATABASE_COULD_NOT_REFRESH_MANIFEST_CACHE', $extension->name), 'notice');

				return true;
			}
		}
		
		return false;
	}
}
