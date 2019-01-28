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

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
$gantry->init();

?>
<?php if (JRequest::getString('type')=='raw'):?>
	<jdoc:include type="component" />
<?php else: ?>
	<!DOCTYPE html>
	<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
		<head>
			<?php 
				$gantry->displayHead();
				$gantry->addStyles(array('template.css','joomla.css','style.css'));
				$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);
			?>
		</head>
		<body id="rt-component" class="component-php-body" style="background: white;">
			<div id="rt-main">
				<div class="rt-container">
					<div class="rt-block">
						<div id="rt-mainbody">
					    	<jdoc:include type="component" />
						</div>
					</div>
				</div>
			</div>
		</body>
	</html>
<?php endif; ?>
<?php
$gantry->finalize();
?>