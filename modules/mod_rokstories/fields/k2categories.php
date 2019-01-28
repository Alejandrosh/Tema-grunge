<?php
/**
 * @version   $Id: k2categories.php 6796 2013-01-27 19:56:01Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * "K2 Items" Module by JoomlaWorks for Joomla! 1.5.x - Version 2.0.0
 * Copyright (c) 2006 - 2009 JoomlaWorks Ltd. All rights reserved.
 * Released under the GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * More info at http://www.joomlaworks.gr
 * Designed and developed by the JoomlaWorks team
 * *** Last update: June 20th, 2009 ***
 */

// no direct access
defined('_JEXEC') or die ('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
JHtml::_('behavior.framework', true);
/**
 * @package    RocketTheme
 * @subpackage rokstories.fields
 */
class JFormFieldK2Categories extends JFormField
{
	var $_name = 'k2categories';

	public function getInput()
	{
		// Initialize variables.
		$db = JFactory::getDbo();

		// Initialize some field attributes.
		$attr = '';
		$attr .= $this->element['class'] ? ' class="' . (string)$this->element['class'] . '"' : '';
		// To avoid user's confusion, readonly="true" should imply disabled="true".
		if ((string)$this->element['readonly'] == 'true' || (string)$this->element['disabled'] == 'true') {
			$attr .= ' disabled="disabled"';
		}
		$attr .= $this->element['size'] ? ' size="' . (int)$this->element['size'] . '"' : '';
		$attr .= $this->element['multiple'] ? ' multiple="multiple"' : '';
		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string)$this->element['onchange'] . '"' : '';

		$mitems = array();
		if ($this->available()) {
			$query = 'SELECT m.* FROM #__k2_categories m WHERE published=1 AND trash = 0 ORDER BY parent, ordering';
			$db->setQuery($query);
			$mitems   = $db->loadObjectList();
			$children = array();
			if ($mitems) {
				foreach ($mitems as $v) {
					$v->title     = $v->name;
					$v->parent_id = $v->parent;
					$pt           = $v->parent;
					$list         = @$children[$pt] ? $children[$pt] : array();
					array_push($list, $v);
					$children[$pt] = $list;
				}
			}
			$list   = JHtml::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0);
			$mitems = array();

			foreach ($list as $item) {
				$item->treename = JString::str_ireplace('&#160;', '- ', $item->treename);
				$mitems[]       = JHtml::_('select.option', $item->id, '   ' . $item->treename);
			}
		}
		return JHtml::_('select.genericlist', $mitems, $this->name, trim($attr), 'value', 'text', $this->value);
	}

	function available()
	{
		$db    = JFactory::getDBO();
		$query = 'select count(*) from #__extensions where element = ' . $db->Quote('com_k2') . ' AND enabled=1';
		$db->setQuery($query);
		$count = (int)$db->loadResult();
		if ($count > 0) {
			return true;
		}
		return false;
	}
}
