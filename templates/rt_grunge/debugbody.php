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

<!DOCTYPE html>
<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<jdoc:include type="head" />
	<?php $gantry->addStyles(array('template.css','joomla.css','style.css')); ?>
</head>
	<body id="debug">
		<div class="rt-container">

		    <?php echo $gantry->debugMainbody('debugmainbody','sidebar','standard'); ?>

		</div>
	</body>
</html>
<?php
$gantry->finalize();
?>