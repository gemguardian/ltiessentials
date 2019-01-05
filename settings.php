<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     theme_ltiessential
 * @copyright   2019 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Settings.
$settings = null;

$readme = new moodle_url('/theme/ltiessential/README.txt');
$readme = html_writer::link($readme, 'README.txt', array('target' => '_blank'));

$ADMIN->add('themes', new admin_category('theme_ltiessential', 'LTI Essential'));

// Overridden Essential settings.
$ltiessentialgeneralsettings = new admin_settingpage('theme_ltiessential_generic', get_string('genericsettings', 'theme_essential'));
// Initialise individual settings only if admin pages require them.
if ($ADMIN->fulltree) {
    // Page background image.
    $name = 'theme_ltiessential/pagebackground';
    $title = get_string('pagebackground', 'theme_essential');
    $description = get_string('pagebackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialgeneralsettings->add($setting);

    // Background style.
    $name = 'theme_ltiessential/pagebackgroundstyle';
    $title = get_string('pagebackgroundstyle', 'theme_essential');
    $description = get_string('pagebackgroundstyledesc', 'theme_essential');
    $default = 'fixed';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
            'fixed' => get_string('stylefixed', 'theme_essential'),
            'tiled' => get_string('styletiled', 'theme_essential'),
            'stretch' => get_string('stylestretch', 'theme_essential')
        )
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialgeneralsettings->add($setting);

    // Fixed or variable width.
    $name = 'theme_ltiessential/pagewidth';
    $title = get_string('pagewidth', 'theme_essential');
    $description = get_string('pagewidthdesc', 'theme_essential');
    $default = 1200;
    $choices = array(
        960 => get_string('fixedwidthnarrow', 'theme_essential'),
        1200 => get_string('fixedwidthnormal', 'theme_essential'),
        1400 => get_string('fixedwidthwide', 'theme_essential'),
        100 => get_string('variablewidth', 'theme_essential'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialgeneralsettings->add($setting);

    // Custom favicon.
    $name = 'theme_ltiessential/favicon';
    $title = get_string('favicon', 'theme_essential');
    $description = get_string('favicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialgeneralsettings->add($setting);

    // Custom CSS.
    $name = 'theme_ltiessential/ltiessentialcustomcss';
    $title = get_string('customcss', 'theme_ltiessential');
    $description = get_string('customcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialgeneralsettings->add($setting);
}
$ADMIN->add('theme_ltiessential', $ltiessentialgeneralsettings);

// Feature settings.
$ltiessentialsettingsfeature = new admin_settingpage('theme_ltiessential_feature', get_string('featureheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    global $CFG;
    if (file_exists("{$CFG->dirroot}/theme/essential/essential_admin_setting_configinteger.php")) {
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configinteger.php');
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configselect.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/essential/essential_admin_setting_configinteger.php")) {
        require_once($CFG->themedir . '/essential/essential_admin_setting_configinteger.php');
        require_once($CFG->themedir . '/essential/essential_admin_setting_configselect.php');
    }

    $ltiessentialsettingsfeature->add(new admin_setting_heading('theme_essential_feature',
        get_string('featureheadingsub', 'theme_essential'),
        format_text(get_string('featuredesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Course content search.
    $name = 'theme_ltiessential/coursecontentsearch';
    $title = get_string('coursecontentsearch', 'theme_essential');
    $description = get_string('coursecontentsearchdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfeature->add($setting);

    // Custom scrollbars.
    $name = 'theme_ltiessential/customscrollbars';
    $title = get_string('customscrollbars', 'theme_essential');
    $description = get_string('customscrollbarsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfeature->add($setting);

    // Fitvids.
    $name = 'theme_ltiessential/fitvids';
    $title = get_string('fitvids', 'theme_essential');
    $description = get_string('fitvidsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfeature->add($setting);

    // Floating submit buttons.
    $name = 'theme_ltiessential/floatingsubmitbuttons';
    $title = get_string('floatingsubmitbuttons', 'theme_essential');
    $description = get_string('floatingsubmitbuttonsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentialsettingsfeature->add($setting);

    // Custom or standard layout.
    $name = 'theme_ltiessential/layout';
    $title = get_string('layout', 'theme_essential');
    $description = get_string('layoutdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfeature->add($setting);

    // Course title position.
    $name = 'theme_ltiessential/coursetitleposition';
    $title = get_string('coursetitleposition', 'theme_essential');
    $description = get_string('coursetitlepositiondesc', 'theme_essential');
    $default = 'within';
    $setting = new essential_admin_setting_configselect($name, $title, $description, $default,
        array(
            'above' => get_string('above', 'theme_essential'),
            'within' => get_string('within', 'theme_essential')
        )
    );
    $ltiessentialsettingsfeature->add($setting);

    // Categories in the course breadcrumb.
    $name = 'theme_ltiessential/categoryincoursebreadcrumbfeature';
    $title = get_string('categoryincoursebreadcrumbfeature', 'theme_essential');
    $description = get_string('categoryincoursebreadcrumbfeaturedesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentialsettingsfeature->add($setting);

    // Return to section.
    $name = 'theme_ltiessential/returntosectionfeature';
    $title = get_string('returntosectionfeature', 'theme_essential');
    $description = get_string('returntosectionfeaturedesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentialsettingsfeature->add($setting);

    // Return to section name text limit.
    $name = 'theme_ltiessential/returntosectiontextlimitfeature';
    $title = get_string('returntosectiontextlimitfeature', 'theme_essential');
    $default = 15;
    $lower = 5;
    $upper = 40;
    $description = get_string('returntosectiontextlimitfeaturedesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $ltiessentialsettingsfeature->add($setting);

    // H5P Custom CSS.
    $name = 'theme_ltiessential/hvpcustomcss';
    $title = get_string('hvpcustomcss', 'theme_essential');
    $description = get_string('hvpcustomcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfeature->add($setting);

    $ltiessentialsettingsfeature->add(new admin_setting_heading('theme_ltiessential_featurereadme',
        get_string('readme_title', 'theme_essential'), get_string('readme_desc', 'theme_essential', array('url' => $readme))));
}
$ADMIN->add('theme_ltiessential', $ltiessentialsettingsfeature);

// Colour settings.
$ltiessentialsettingscolour = new admin_settingpage('theme_ltiessential_colour', get_string('colorheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    $ltiessentialsettingscolour->add(new admin_setting_heading('theme_ltiessential_colour',
        get_string('colorheadingsub', 'theme_essential'),
        format_text(get_string('colordesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Main theme colour setting.
    $name = 'theme_ltiessential/themecolor';
    $title = get_string('themecolor', 'theme_essential');
    $description = get_string('themecolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Main theme text colour setting.
    $name = 'theme_ltiessential/themetextcolor';
    $title = get_string('themetextcolor', 'theme_essential');
    $description = get_string('themetextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Main theme link colour setting.
    $name = 'theme_ltiessential/themeurlcolor';
    $title = get_string('themeurlcolor', 'theme_essential');
    $description = get_string('themeurlcolordesc', 'theme_essential');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Main theme hover colour setting.
    $name = 'theme_ltiessential/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential');
    $description = get_string('themehovercolordesc', 'theme_essential');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Icon colour setting.
    $name = 'theme_ltiessential/themeiconcolor';
    $title = get_string('themeiconcolor', 'theme_essential');
    $description = get_string('themeiconcolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Side-pre block background colour setting.
    $name = 'theme_ltiessential/themesidepreblockbackgroundcolour';
    $title = get_string('themesidepreblockbackgroundcolour', 'theme_essential');
    $description = get_string('themesidepreblockbackgroundcolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Side-pre block text colour setting.
    $name = 'theme_ltiessential/themesidepreblocktextcolour';
    $title = get_string('themesidepreblocktextcolour', 'theme_essential');
    $description = get_string('themesidepreblocktextcolourdesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Side-pre block url colour setting.
    $name = 'theme_ltiessential/themesidepreblockurlcolour';
    $title = get_string('themesidepreblockurlcolour', 'theme_essential');
    $description = get_string('themesidepreblockurlcolourdesc', 'theme_essential');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Side-pre block url hover colour setting.
    $name = 'theme_ltiessential/themesidepreblockhovercolour';
    $title = get_string('themesidepreblockhovercolour', 'theme_essential');
    $description = get_string('themesidepreblockhovercolourdesc', 'theme_essential');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Default button text colour setting.
    $name = 'theme_ltiessential/themedefaultbuttontextcolour';
    $title = get_string('themedefaultbuttontextcolour', 'theme_essential');
    $description = get_string('themedefaultbuttontextcolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Default button text hover colour setting.
    $name = 'theme_ltiessential/themedefaultbuttontexthovercolour';
    $title = get_string('themedefaultbuttontexthovercolour', 'theme_essential');
    $description = get_string('themedefaultbuttontexthovercolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Default button background colour setting.
    $name = 'theme_ltiessential/themedefaultbuttonbackgroundcolour';
    $title = get_string('themedefaultbuttonbackgroundcolour', 'theme_essential');
    $description = get_string('themedefaultbuttonbackgroundcolourdesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Default button background hover colour setting.
    $name = 'theme_ltiessential/themedefaultbuttonbackgroundhovercolour';
    $title = get_string('themedefaultbuttonbackgroundhovercolour', 'theme_essential');
    $description = get_string('themedefaultbuttonbackgroundhovercolourdesc', 'theme_essential');
    $default = '#3ad4ff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Navigation colour setting.
    $name = 'theme_ltiessential/themenavcolor';
    $title = get_string('themenavcolor', 'theme_essential');
    $description = get_string('themenavcolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // This is the descriptor for the footer.
    $name = 'theme_ltiessential/footercolorinfo';
    $heading = get_string('footercolors', 'theme_essential');
    $information = get_string('footercolorsdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentialsettingscolour->add($setting);

    // Footer background colour setting.
    $name = 'theme_ltiessential/footercolor';
    $title = get_string('footercolor', 'theme_essential');
    $description = get_string('footercolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer text colour setting.
    $name = 'theme_ltiessential/footertextcolor';
    $title = get_string('footertextcolor', 'theme_essential');
    $description = get_string('footertextcolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer heading colour setting.
    $name = 'theme_ltiessential/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_essential');
    $description = get_string('footerheadingcolordesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer block background colour setting.
    $name = 'theme_ltiessential/footerblockbackgroundcolour';
    $title = get_string('footerblockbackgroundcolour', 'theme_essential');
    $description = get_string('footerblockbackgroundcolourdesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer block text colour setting.
    $name = 'theme_ltiessential/footerblocktextcolour';
    $title = get_string('footerblocktextcolour', 'theme_essential');
    $description = get_string('footerblocktextcolourdesc', 'theme_essential');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer block URL colour setting.
    $name = 'theme_ltiessential/footerblockurlcolour';
    $title = get_string('footerblockurlcolour', 'theme_essential');
    $description = get_string('footerblockurlcolourdesc', 'theme_essential');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer block URL hover colour setting.
    $name = 'theme_ltiessential/footerblockhovercolour';
    $title = get_string('footerblockhovercolour', 'theme_essential');
    $description = get_string('footerblockhovercolourdesc', 'theme_essential');
    $default = '#555555';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer seperator colour setting.
    $name = 'theme_ltiessential/footersepcolor';
    $title = get_string('footersepcolor', 'theme_essential');
    $description = get_string('footersepcolordesc', 'theme_essential');
    $default = '#313131';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer URL colour setting.
    $name = 'theme_ltiessential/footerurlcolor';
    $title = get_string('footerurlcolor', 'theme_essential');
    $description = get_string('footerurlcolordesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);

    // Footer URL hover colour setting.
    $name = 'theme_ltiessential/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_essential');
    $description = get_string('footerhovercolordesc', 'theme_essential');
    $default = '#bbbbbb';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingscolour->add($setting);
}
$ADMIN->add('theme_ltiessential', $ltiessentialsettingscolour);

// Header settings.
$ltiessentialsettingsheader = new admin_settingpage('theme_ltiessential_header', get_string('headerheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    global $CFG;
    if (file_exists("{$CFG->dirroot}/theme/essential/essential_admin_setting_configtext.php")) {
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configtext.php');
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configradio.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/essential/essential_admin_setting_configtext.php")) {
        require_once($CFG->themedir . '/essential/essential_admin_setting_configtext.php');
        require_once($CFG->themedir . '/essential/essential_admin_setting_configradio.php');
    }

    // New or old navbar.
    $name = 'theme_ltiessential/oldnavbar';
    $title = get_string('oldnavbar', 'theme_essential');
    $description = get_string('oldnavbardesc', 'theme_essential');
    $default = 0;
    $choices = array(
        0 => get_string('navbarabove', 'theme_essential'),
        1 => get_string('navbarbelow', 'theme_essential')
    );
    $images = array(
        0 => 'navbarabove',
        1 => 'navbarbelow'
    );
    $setting = new essential_admin_setting_configradio($name, $title, $description, $default, $choices, false, $images);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Header title setting.
    $name = 'theme_ltiessential/headertitle';
    $title = get_string('headertitle', 'theme_essential');
    $description = get_string('headertitledesc', 'theme_essential');
    $default = '1';
    $choices = array(
        0 => get_string('notitle', 'theme_essential'),
        1 => get_string('fullname', 'theme_essential'),
        2 => get_string('shortname', 'theme_essential'),
        3 => get_string('fullnamesummary', 'theme_essential'),
        4 => get_string('shortnamesummary', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Logo file setting.
    $name = 'theme_ltiessential/logo';
    $title = get_string('logo', 'theme_ltiessential');
    $description = get_string('logodesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Logo desktop width setting.
    $name = 'theme_ltiessential/logodesktopwidth';
    $title = get_string('logodesktopwidth', 'theme_essential');
    $default = 25;
    $lower = 1;
    $upper = 100;
    $description = get_string('logodesktopwidthdesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Logo mobile width setting.
    $name = 'theme_ltiessential/logomobilewidth';
    $title = get_string('logomobilewidth', 'theme_essential');
    $default = 10;
    $lower = 1;
    $upper = 100;
    $description = get_string('logomobilewidthdesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Navbar title setting.
    $name = 'theme_ltiessential/navbartitle';
    $title = get_string('navbartitle', 'theme_essential');
    $description = get_string('navbartitledesc', 'theme_essential');
    $default = '2';
    $choices = array(
        0 => get_string('notitle', 'theme_essential'),
        1 => get_string('fullname', 'theme_essential'),
        2 => get_string('shortname', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Header text colour setting.
    $name = 'theme_ltiessential/headertextcolor';
    $title = get_string('headertextcolor', 'theme_essential');
    $description = get_string('headertextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Header background image.
    $name = 'theme_ltiessential/headerbackground';
    $title = get_string('headerbackground', 'theme_essential');
    $description = get_string('headerbackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Background style.
    $name = 'theme_ltiessential/headerbackgroundstyle';
    $title = get_string('headerbackgroundstyle', 'theme_essential');
    $description = get_string('headerbackgroundstyledesc', 'theme_essential');
    $default = 'tiled';
    $setting = new admin_setting_configselect($name, $title, $description, $default,
        array(
            'fixed' => get_string('stylefixed', 'theme_essential'),
            'tiled' => get_string('styletiled', 'theme_essential')
        )
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Choose breadcrumbstyle.
    $name = 'theme_ltiessential/breadcrumbstyle';
    $title = get_string('breadcrumbstyle', 'theme_essential');
    $description = get_string('breadcrumbstyledesc', 'theme_essential');
    $default = 1;
    $choices = array(
        1 => get_string('breadcrumbstyled', 'theme_essential'),
        4 => get_string('breadcrumbstylednocollapse', 'theme_essential'),
        2 => get_string('breadcrumbsimple', 'theme_essential'),
        3 => get_string('breadcrumbthin', 'theme_essential'),
        0 => get_string('nobreadcrumb', 'theme_essential')
    );
    $images = array(
        1 => 'breadcrumbstyled',
        4 => 'breadcrumbstylednocollapse',
        2 => 'breadcrumbsimple',
        3 => 'breadcrumbthin'
    );
    $setting = new essential_admin_setting_configradio($name, $title, $description, $default, $choices, false, $images);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Course menu settings.
    $name = 'theme_ltiessential/mycoursesinfo';
    $heading = get_string('mycoursesinfo', 'theme_essential');
    $information = get_string('mycoursesinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentialsettingsheader->add($setting);

    // Toggle courses display in custommenu.
    $name = 'theme_ltiessential/displaymycourses';
    $title = get_string('displaymycourses', 'theme_essential');
    $description = get_string('displaymycoursesdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Toggle hidden courses display in custommenu.
    $name = 'theme_ltiessential/displayhiddenmycourses';
    $title = get_string('displayhiddenmycourses', 'theme_essential');
    $description = get_string('displayhiddenmycoursesdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No need for callback as CSS not changed.
    $ltiessentialsettingsheader->add($setting);

    // Set terminology for dropdown course list.
    $name = 'theme_ltiessential/mycoursetitle';
    $title = get_string('mycoursetitle', 'theme_essential');
    $description = get_string('mycoursetitledesc', 'theme_essential');
    $default = 'course';
    $choices = array(
        'course' => get_string('mycourses', 'theme_essential'),
        'unit' => get_string('myunits', 'theme_essential'),
        'class' => get_string('myclasses', 'theme_essential'),
        'module' => get_string('mymodules', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Editing menu settings.
    $name = 'theme_ltiessential/editingmenu';
    $heading = get_string('editingmenu', 'theme_essential');
    $information = get_string('editingmenudesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentialsettingsheader->add($setting);

    $name = 'theme_ltiessential/displayeditingmenu';
    $title = get_string('displayeditingmenu', 'theme_essential');
    $description = get_string('displayeditingmenudesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $ltiessentialsettingsheader->add($setting);

    $name = 'theme_ltiessential/hidedefaulteditingbutton';
    $title = get_string('hidedefaulteditingbutton', 'theme_essential');
    $description = get_string('hidedefaulteditingbuttondesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $ltiessentialsettingsheader->add($setting);

    // Social network settings.
    $ltiessentialsettingsheader->add(new admin_setting_heading('theme_ltiessential_social',
        get_string('socialheadingsub', 'theme_essential'),
        format_text(get_string('socialdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Website URL setting.
    $name = 'theme_ltiessential/website';
    $title = get_string('websiteurl', 'theme_essential');
    $description = get_string('websitedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Facebook URL setting.
    $name = 'theme_ltiessential/facebook';
    $title = get_string('facebookurl', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Flickr URL setting.
    $name = 'theme_ltiessential/flickr';
    $title = get_string('flickrurl', 'theme_essential');
    $description = get_string('flickrdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Twitter URL setting.
    $name = 'theme_ltiessential/twitter';
    $title = get_string('twitterurl', 'theme_essential');
    $description = get_string('twitterdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Google+ URL setting.
    $name = 'theme_ltiessential/googleplus';
    $title = get_string('googleplusurl', 'theme_essential');
    $description = get_string('googleplusdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // LinkedIn URL setting.
    $name = 'theme_ltiessential/linkedin';
    $title = get_string('linkedinurl', 'theme_essential');
    $description = get_string('linkedindesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Pinterest URL setting.
    $name = 'theme_ltiessential/pinterest';
    $title = get_string('pinteresturl', 'theme_essential');
    $description = get_string('pinterestdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Instagram URL setting.
    $name = 'theme_ltiessential/instagram';
    $title = get_string('instagramurl', 'theme_essential');
    $description = get_string('instagramdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // YouTube URL setting.
    $name = 'theme_ltiessential/youtube';
    $title = get_string('youtubeurl', 'theme_essential');
    $description = get_string('youtubedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Skype URL setting.
    $name = 'theme_ltiessential/skype';
    $title = get_string('skypeuri', 'theme_essential');
    $description = get_string('skypedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // VKontakte URL setting.
    $name = 'theme_ltiessential/vk';
    $title = get_string('vkurl', 'theme_essential');
    $description = get_string('vkdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // Apps settings.
    $ltiessentialsettingsheader->add(new admin_setting_heading('theme_ltiessential_mobileapps',
        get_string('mobileappsheadingsub', 'theme_essential'),
        format_text(get_string('mobileappsdesc', 'theme_essential'), FORMAT_MARKDOWN)));

     // iOS icons heading.
    $name = 'theme_ltiessential/iosiconinfo';
    $heading = get_string('iosicon', 'theme_essential');
    $information = get_string('iosicondesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentialsettingsheader->add($setting);

    // The iPhone icon.
    $name = 'theme_ltiessential/iphoneicon';
    $title = get_string('iphoneicon', 'theme_essential');
    $description = get_string('iphoneicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // The iPhone retina icon.
    $name = 'theme_ltiessential/iphoneretinaicon';
    $title = get_string('iphoneretinaicon', 'theme_essential');
    $description = get_string('iphoneretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // The iPad icon.
    $name = 'theme_ltiessential/ipadicon';
    $title = get_string('ipadicon', 'theme_essential');
    $description = get_string('ipadicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);

    // The iPad retina icon.
    $name = 'theme_ltiessential/ipadretinaicon';
    $title = get_string('ipadretinaicon', 'theme_essential');
    $description = get_string('ipadretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsheader->add($setting);
}
$ADMIN->add('theme_ltiessential', $ltiessentialsettingsheader);

// Font settings.
$ltiessentialsettingsfont = new admin_settingpage('theme_ltiessential_font', get_string('fontsettings', 'theme_essential'));
if ($ADMIN->fulltree) {
    // This is the descriptor for the font settings.
    $name = 'theme_ltiessential/fontheading';
    $heading = get_string('fontheadingsub', 'theme_essential');
    $information = get_string('fontheadingdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentialsettingsfont->add($setting);

    // Font selector.
    $gws = html_writer::link('//www.google.com/fonts', get_string('fonttypegoogle', 'theme_essential'), array('target' => '_blank'));
    $name = 'theme_ltiessential/fontselect';
    $title = get_string('fontselect', 'theme_essential');
    $description = get_string('fontselectdesc', 'theme_ltiessential', array('googlewebfonts' => $gws));
    $default = 1;
    $choices = array(
        1 => get_string('fonttypeuser', 'theme_essential'),
        2 => get_string('fonttypegoogle', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfont->add($setting);

    // Heading font name.
    $name = 'theme_ltiessential/fontnameheading';
    $title = get_string('fontnameheading', 'theme_essential');
    $description = get_string('fontnameheadingdesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfont->add($setting);

    // Text font name.
    $name = 'theme_ltiessential/fontnamebody';
    $title = get_string('fontnamebody', 'theme_essential');
    $description = get_string('fontnamebodydesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfont->add($setting);

    if (get_config('theme_ltiessential', 'fontselect') === "2") {
        // Google font character sets.
        $name = 'theme_ltiessential/fontcharacterset';
        $title = get_string('fontcharacterset', 'theme_essential');
        $description = get_string('fontcharactersetdesc', 'theme_essential');
        $default = 'latin-ext';
        $setting = new admin_setting_configmulticheckbox($name, $title, $description, $default,
            array(
                'latin-ext' => get_string('fontcharactersetlatinext', 'theme_essential'),
                'cyrillic' => get_string('fontcharactersetcyrillic', 'theme_essential'),
                'cyrillic-ext' => get_string('fontcharactersetcyrillicext', 'theme_essential'),
                'greek' => get_string('fontcharactersetgreek', 'theme_essential'),
                'greek-ext' => get_string('fontcharactersetgreekext', 'theme_essential'),
                'vietnamese' => get_string('fontcharactersetvietnamese', 'theme_essential')
            )
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $ltiessentialsettingsfont->add($setting);
    }

    $ltiessentialsettingsfont->add(new admin_setting_heading('theme_ltiessential_fontreadme',
        get_string('readme_title', 'theme_essential'), get_string('readme_desc', 'theme_essential', array('url' => $readme))));
}
$ADMIN->add('theme_ltiessential', $ltiessentialsettingsfont);

// Footer settings.
$ltiessentialsettingsfooter = new admin_settingpage('theme_ltiessential_footer', get_string('footerheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    // Copyright setting.
    $name = 'theme_ltiessential/copyright';
    $title = get_string('copyright', 'theme_essential');
    $description = get_string('copyrightdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $ltiessentialsettingsfooter->add($setting);

    // Footnote setting.
    $name = 'theme_ltiessential/footnote';
    $title = get_string('footnote', 'theme_essential');
    $description = get_string('footnotedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentialsettingsfooter->add($setting);
}
$ADMIN->add('theme_ltiessential', $ltiessentialsettingsfooter);