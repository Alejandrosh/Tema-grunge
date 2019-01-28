/**
 * importData Custom Param
 *
 * @package        Joomla
 * @subpackage    importData Custom Param
 * @copyright Copyright (C) 2009 RocketTheme. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see RT-LICENSE.php
 * @author RocketTheme, LLC
 *
 */

var RID = {
    path: '',
    init: function () {
        RID.path = window.RokStoriesAdminPath + '&import=true';
        RID.wrapper = document.id('rokstories-admin-wrapper');
        RID.container = RID.wrapper.getFirst();
        RID.button = RID.wrapper.getElement('button');
        RID.events().xhr()
    },
    events: function () {
        RID.button.addEvent('click', function (e) {
            e.stop();
            this.set('disabled', 'disabled').addClass('disabled');
            RID.wrapper.addClass('loading');
            RID.wrapper.focus();
            RID.ajax.send()
        });
        return RID
    },
    xhr: function () {
        RID.ajax = new Request({
            url: RID.path,
            method: 'get',
            onComplete: function (r) {
                var a = r.trim().match(/success.(\d+)/i);
                var b = r.trim().match(/please.confirm$/i);
                RID.ajax.options.url = RID.ajax.options.url.replace("&duplicate=true", "");
                if (a) {
                    a = a.splice(1);
                    RID.populate(a);
                    RID.wrapper.removeClass('loading').addClass('success')
                } else if (b) {
                    var c = "Sample Data appears to be already been imported previously. By continuing you're going to duplicate the content.\nDo you want to Continue?";
                    var d = window.confirm(c);
                    if (d) {
                        RID.ajax.cancel();
                        RID.ajax.options.url += "&duplicate=true";
                        RID.ajax.send()
                    } else {
                        RID.wrapper.removeClass('loading');
                        RID.button.removeProperty('disabled').removeClass('disabled')
                    }
                } else {
                    RID.wrapper.removeClass('loading').addClass('warning');
                    new Element('p').set('html', '<strong>ERROR:</strong> ' + r).inject(RID.button, 'after')
                }
            }
        })
    },
    populate: function (a) {
        var b = a[0];
        category = document.id('jform_params_catid');
        var c = category.getChildren().length;
        new Element('option', {
            value: b
        }).set('text', 'RokStories Samples').inject(category);
        category.selectedIndex = c
    }
};
window.addEvent('domready', RID.init);