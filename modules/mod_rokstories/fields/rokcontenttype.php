<?php
/**
 * ContentType, Custom Param
 *
 * @version   $Id: rokcontenttype.php 26998 2015-02-24 17:49:53Z matias $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
JHtml::_('behavior.framework', true);
JFormHelper::loadFieldClass('list');

class JFormFieldRokContentType extends JFormFieldList
{
	protected $type = 'rokcontenttype';

	protected function getInput()
	{
		$doc = JFactory::getDocument();

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

		$version = new JVersion();
		if (version_compare($version->getShortVersion(), '3.0', '<')) {
			if (K2_CHECK) {
				$js = "window.addEvent('domready', function() {
                    $('" . $this->id . "').addEvent('change', function(){
                       $$('.ifk2').getParent('li').setStyle('display','block');
                        $$('." . $this->element['name'] . "').getParent('li').setStyle('display','none');
                        $$('." . $this->value . "').getParent('li').setStyle('display','block');
                        var sel = this.getSelected().get('value');
                        $$('.source').getParent('li').setStyle('display','none');
                        $$('.'+sel).getParent('li').setStyle('display','block');
                    }).fireEvent('change');
            });";
			} else {
				$js = "window.addEvent('domready', function() {
                    $('" . $this->id . "').set('value', 'joomla');
                    $('" . $this->id . "').getParent('li').setStyle('display','none');
                    $$('." . $this->element['name'] . "').getParent('li').setStyle('display','none');
                    $$('.joomla').getParent('li').setStyle('display','block');
                });";
			}
		} else {
			if (K2_CHECK) {
				$js = "window.addEvent('domready', function() {
                var chzn = $('" . $this->id . "_chzn');
                if(chzn!=null){
                    $('" . $this->id . "_chzn').addEvent('click', function(){
                        $$('.ifk2').getParent('div.control-group').setStyle('display','block');
                        $$('." . $this->value . "').getParent('div.control-group').setStyle('display','block');
                        $$('." . $this->element['name'] . "').getParent('div.control-group').setStyle('display','none');
                        var text = $('" . $this->id . "_chzn').getElement('span').get('text');
                        var options = $('" . $this->id . "').getElements('option');
                        options.each(function(option) {
                        var optText = String(option.get('text'));
                        var optValue = String(option.get('value'));
                            if(text == optText){
                                var sel = optValue;
                            }
                            $$('.'+sel).getParent('div.control-group').setStyle('display','block');
                        });
                    }).fireEvent('click');
                }
            });";
			} else {
				$js = "window.addEvent('domready', function() {
                $('" . $this->id . "').set('value', 'joomla');
                $('" . $this->id . "').getParent('div.control-group').setStyle('display','none');
                $$('." . $this->element['name'] . "').getParent('div.control-group').setStyle('display','none');
                $$('.joomla').getParent('div.control-group').setStyle('display','block');
            });";
			}
		}

		$doc->addScriptDeclaration($js);

		return JHtml::_('select.genericlist', (array)$this->getOptions(), $this->name, trim($attr), 'value', 'text', $this->value, $this->id);
	}
}

?>


