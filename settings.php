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
 * @package     theme_ltiessentiallerenisleuk
 * @copyright   2019 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Settings.
$settings = null;

$readme = new moodle_url('/theme/ltiessentiallerenisleuk/README.txt');
$readme = html_writer::link($readme, 'README.txt', array('target' => '_blank'));

$ADMIN->add('themes', new admin_category('theme_ltiessentiallerenisleuk', 'LTI Essential'));

// Overridden Essential settings.
$ltiessentiallerenisleukgeneralsettings = new admin_settingpage('theme_ltiessentiallerenisleuk_generic', get_string('genericsettings', 'theme_essential'));
// Initialise individual settings only if admin pages require them.
if ($ADMIN->fulltree) {
    // Page background image.
    $name = 'theme_ltiessentiallerenisleuk/pagebackground';
    $title = get_string('pagebackground', 'theme_essential');
    $description = get_string('pagebackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'pagebackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleukgeneralsettings->add($setting);

    // Background style.
    $name = 'theme_ltiessentiallerenisleuk/pagebackgroundstyle';
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
    $ltiessentiallerenisleukgeneralsettings->add($setting);

    // Fixed or variable width.
    $name = 'theme_ltiessentiallerenisleuk/pagewidth';
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
    $ltiessentiallerenisleukgeneralsettings->add($setting);

    // Custom favicon.
    $name = 'theme_ltiessentiallerenisleuk/favicon';
    $title = get_string('favicon', 'theme_essential');
    $description = get_string('favicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleukgeneralsettings->add($setting);

    // Custom CSS.
    $name = 'theme_ltiessentiallerenisleuk/ltiessentiallerenisleukcustomcss';
    $title = get_string('customcss', 'theme_ltiessentiallerenisleuk');
    $description = get_string('customcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleukgeneralsettings->add($setting);
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleukgeneralsettings);

// Feature settings.
$ltiessentiallerenisleuksettingsfeature = new admin_settingpage('theme_ltiessentiallerenisleuk_feature', get_string('featureheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    global $CFG;
    if (file_exists("{$CFG->dirroot}/theme/essential/essential_admin_setting_configinteger.php")) {
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configinteger.php');
        require_once($CFG->dirroot . '/theme/essential/essential_admin_setting_configselect.php');
    } else if (!empty($CFG->themedir) && file_exists("{$CFG->themedir}/essential/essential_admin_setting_configinteger.php")) {
        require_once($CFG->themedir . '/essential/essential_admin_setting_configinteger.php');
        require_once($CFG->themedir . '/essential/essential_admin_setting_configselect.php');
    }

    $ltiessentiallerenisleuksettingsfeature->add(new admin_setting_heading('theme_essential_feature',
        get_string('featureheadingsub', 'theme_essential'),
        format_text(get_string('featuredesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Course content search.
    $name = 'theme_ltiessentiallerenisleuk/coursecontentsearch';
    $title = get_string('coursecontentsearch', 'theme_essential');
    $description = get_string('coursecontentsearchdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Custom scrollbars.
    $name = 'theme_ltiessentiallerenisleuk/customscrollbars';
    $title = get_string('customscrollbars', 'theme_essential');
    $description = get_string('customscrollbarsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Fitvids.
    $name = 'theme_ltiessentiallerenisleuk/fitvids';
    $title = get_string('fitvids', 'theme_essential');
    $description = get_string('fitvidsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Floating submit buttons.
    $name = 'theme_ltiessentiallerenisleuk/floatingsubmitbuttons';
    $title = get_string('floatingsubmitbuttons', 'theme_essential');
    $description = get_string('floatingsubmitbuttonsdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Custom or standard layout.
    $name = 'theme_ltiessentiallerenisleuk/layout';
    $title = get_string('layout', 'theme_essential');
    $description = get_string('layoutdesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Course title position.
    $name = 'theme_ltiessentiallerenisleuk/coursetitleposition';
    $title = get_string('coursetitleposition', 'theme_essential');
    $description = get_string('coursetitlepositiondesc', 'theme_essential');
    $default = 'within';
    $setting = new essential_admin_setting_configselect($name, $title, $description, $default,
        array(
            'above' => get_string('above', 'theme_essential'),
            'within' => get_string('within', 'theme_essential')
        )
    );
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Categories in the course breadcrumb.
    $name = 'theme_ltiessentiallerenisleuk/categoryincoursebreadcrumbfeature';
    $title = get_string('categoryincoursebreadcrumbfeature', 'theme_essential');
    $description = get_string('categoryincoursebreadcrumbfeaturedesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Return to section.
    $name = 'theme_ltiessentiallerenisleuk/returntosectionfeature';
    $title = get_string('returntosectionfeature', 'theme_essential');
    $description = get_string('returntosectionfeaturedesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // Return to section name text limit.
    $name = 'theme_ltiessentiallerenisleuk/returntosectiontextlimitfeature';
    $title = get_string('returntosectiontextlimitfeature', 'theme_essential');
    $default = 15;
    $lower = 5;
    $upper = 40;
    $description = get_string('returntosectiontextlimitfeaturedesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    // H5P Custom CSS.
    $name = 'theme_ltiessentiallerenisleuk/hvpcustomcss';
    $title = get_string('hvpcustomcss', 'theme_essential');
    $description = get_string('hvpcustomcssdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfeature->add($setting);

    $ltiessentiallerenisleuksettingsfeature->add(new admin_setting_heading('theme_ltiessentiallerenisleuk_featurereadme',
        get_string('readme_title', 'theme_essential'), get_string('readme_desc', 'theme_essential', array('url' => $readme))));
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleuksettingsfeature);

// Colour settings.
$ltiessentiallerenisleuksettingscolour = new admin_settingpage('theme_ltiessentiallerenisleuk_colour', get_string('colorheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    $ltiessentiallerenisleuksettingscolour->add(new admin_setting_heading('theme_ltiessentiallerenisleuk_colour',
        get_string('colorheadingsub', 'theme_essential'),
        format_text(get_string('colordesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Main theme colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themecolor';
    $title = get_string('themecolor', 'theme_essential');
    $description = get_string('themecolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Main theme text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themetextcolor';
    $title = get_string('themetextcolor', 'theme_essential');
    $description = get_string('themetextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Main theme link colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themeurlcolor';
    $title = get_string('themeurlcolor', 'theme_essential');
    $description = get_string('themeurlcolordesc', 'theme_essential');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Main theme hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themehovercolor';
    $title = get_string('themehovercolor', 'theme_essential');
    $description = get_string('themehovercolordesc', 'theme_essential');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Icon colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themeiconcolor';
    $title = get_string('themeiconcolor', 'theme_essential');
    $description = get_string('themeiconcolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Side-pre block background colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themesidepreblockbackgroundcolour';
    $title = get_string('themesidepreblockbackgroundcolour', 'theme_essential');
    $description = get_string('themesidepreblockbackgroundcolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Side-pre block text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themesidepreblocktextcolour';
    $title = get_string('themesidepreblocktextcolour', 'theme_essential');
    $description = get_string('themesidepreblocktextcolourdesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Side-pre block url colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themesidepreblockurlcolour';
    $title = get_string('themesidepreblockurlcolour', 'theme_essential');
    $description = get_string('themesidepreblockurlcolourdesc', 'theme_essential');
    $default = '#943b21';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Side-pre block url hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themesidepreblockhovercolour';
    $title = get_string('themesidepreblockhovercolour', 'theme_essential');
    $description = get_string('themesidepreblockhovercolourdesc', 'theme_essential');
    $default = '#6a2a18';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Default button text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themedefaultbuttontextcolour';
    $title = get_string('themedefaultbuttontextcolour', 'theme_essential');
    $description = get_string('themedefaultbuttontextcolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Default button text hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themedefaultbuttontexthovercolour';
    $title = get_string('themedefaultbuttontexthovercolour', 'theme_essential');
    $description = get_string('themedefaultbuttontexthovercolourdesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Default button background colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themedefaultbuttonbackgroundcolour';
    $title = get_string('themedefaultbuttonbackgroundcolour', 'theme_essential');
    $description = get_string('themedefaultbuttonbackgroundcolourdesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Default button background hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themedefaultbuttonbackgroundhovercolour';
    $title = get_string('themedefaultbuttonbackgroundhovercolour', 'theme_essential');
    $description = get_string('themedefaultbuttonbackgroundhovercolourdesc', 'theme_essential');
    $default = '#3ad4ff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Navigation colour setting.
    $name = 'theme_ltiessentiallerenisleuk/themenavcolor';
    $title = get_string('themenavcolor', 'theme_essential');
    $description = get_string('themenavcolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // This is the descriptor for the footer.
    $name = 'theme_ltiessentiallerenisleuk/footercolorinfo';
    $heading = get_string('footercolors', 'theme_essential');
    $information = get_string('footercolorsdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer background colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footercolor';
    $title = get_string('footercolor', 'theme_essential');
    $description = get_string('footercolordesc', 'theme_essential');
    $default = '#30add1';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footertextcolor';
    $title = get_string('footertextcolor', 'theme_essential');
    $description = get_string('footertextcolordesc', 'theme_essential');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer heading colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerheadingcolor';
    $title = get_string('footerheadingcolor', 'theme_essential');
    $description = get_string('footerheadingcolordesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer block background colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerblockbackgroundcolour';
    $title = get_string('footerblockbackgroundcolour', 'theme_essential');
    $description = get_string('footerblockbackgroundcolourdesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer block text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerblocktextcolour';
    $title = get_string('footerblocktextcolour', 'theme_essential');
    $description = get_string('footerblocktextcolourdesc', 'theme_essential');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer block URL colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerblockurlcolour';
    $title = get_string('footerblockurlcolour', 'theme_essential');
    $description = get_string('footerblockurlcolourdesc', 'theme_essential');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer block URL hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerblockhovercolour';
    $title = get_string('footerblockhovercolour', 'theme_essential');
    $description = get_string('footerblockhovercolourdesc', 'theme_essential');
    $default = '#555555';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer seperator colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footersepcolor';
    $title = get_string('footersepcolor', 'theme_essential');
    $description = get_string('footersepcolordesc', 'theme_essential');
    $default = '#313131';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer URL colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerurlcolor';
    $title = get_string('footerurlcolor', 'theme_essential');
    $description = get_string('footerurlcolordesc', 'theme_essential');
    $default = '#cccccc';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);

    // Footer URL hover colour setting.
    $name = 'theme_ltiessentiallerenisleuk/footerhovercolor';
    $title = get_string('footerhovercolor', 'theme_essential');
    $description = get_string('footerhovercolordesc', 'theme_essential');
    $default = '#bbbbbb';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingscolour->add($setting);
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleuksettingscolour);

// Header settings.
$ltiessentiallerenisleuksettingsheader = new admin_settingpage('theme_ltiessentiallerenisleuk_header', get_string('headerheading', 'theme_essential'));
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
    $name = 'theme_ltiessentiallerenisleuk/oldnavbar';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Header title setting.
    $name = 'theme_ltiessentiallerenisleuk/headertitle';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Logo file setting.
    $name = 'theme_ltiessentiallerenisleuk/logo';
    $title = get_string('logo', 'theme_ltiessentiallerenisleuk');
    $description = get_string('logodesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Logo desktop width setting.
    $name = 'theme_ltiessentiallerenisleuk/logodesktopwidth';
    $title = get_string('logodesktopwidth', 'theme_essential');
    $default = 25;
    $lower = 1;
    $upper = 100;
    $description = get_string('logodesktopwidthdesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Logo mobile width setting.
    $name = 'theme_ltiessentiallerenisleuk/logomobilewidth';
    $title = get_string('logomobilewidth', 'theme_essential');
    $default = 10;
    $lower = 1;
    $upper = 100;
    $description = get_string('logomobilewidthdesc', 'theme_essential',
        array('lower' => $lower, 'upper' => $upper));
    $setting = new essential_admin_setting_configinteger($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Navbar title setting.
    $name = 'theme_ltiessentiallerenisleuk/navbartitle';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Header text colour setting.
    $name = 'theme_ltiessentiallerenisleuk/headertextcolor';
    $title = get_string('headertextcolor', 'theme_essential');
    $description = get_string('headertextcolordesc', 'theme_essential');
    $default = '#217a94';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Header background image.
    $name = 'theme_ltiessentiallerenisleuk/headerbackground';
    $title = get_string('headerbackground', 'theme_essential');
    $description = get_string('headerbackgrounddesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Background style.
    $name = 'theme_ltiessentiallerenisleuk/headerbackgroundstyle';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Choose breadcrumbstyle.
    $name = 'theme_ltiessentiallerenisleuk/breadcrumbstyle';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Course menu settings.
    $name = 'theme_ltiessentiallerenisleuk/mycoursesinfo';
    $heading = get_string('mycoursesinfo', 'theme_essential');
    $information = get_string('mycoursesinfodesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Toggle courses display in custommenu.
    $name = 'theme_ltiessentiallerenisleuk/displaymycourses';
    $title = get_string('displaymycourses', 'theme_essential');
    $description = get_string('displaymycoursesdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Toggle hidden courses display in custommenu.
    $name = 'theme_ltiessentiallerenisleuk/displayhiddenmycourses';
    $title = get_string('displayhiddenmycourses', 'theme_essential');
    $description = get_string('displayhiddenmycoursesdesc', 'theme_essential');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    // No need for callback as CSS not changed.
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Set terminology for dropdown course list.
    $name = 'theme_ltiessentiallerenisleuk/mycoursetitle';
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
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Editing menu settings.
    $name = 'theme_ltiessentiallerenisleuk/editingmenu';
    $heading = get_string('editingmenu', 'theme_essential');
    $information = get_string('editingmenudesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentiallerenisleuksettingsheader->add($setting);

    $name = 'theme_ltiessentiallerenisleuk/displayeditingmenu';
    $title = get_string('displayeditingmenu', 'theme_essential');
    $description = get_string('displayeditingmenudesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $ltiessentiallerenisleuksettingsheader->add($setting);

    $name = 'theme_ltiessentiallerenisleuk/hidedefaulteditingbutton';
    $title = get_string('hidedefaulteditingbutton', 'theme_essential');
    $description = get_string('hidedefaulteditingbuttondesc', 'theme_essential');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Social network settings.
    $ltiessentiallerenisleuksettingsheader->add(new admin_setting_heading('theme_ltiessentiallerenisleuk_social',
        get_string('socialheadingsub', 'theme_essential'),
        format_text(get_string('socialdesc', 'theme_essential'), FORMAT_MARKDOWN)));

    // Website URL setting.
    $name = 'theme_ltiessentiallerenisleuk/website';
    $title = get_string('websiteurl', 'theme_essential');
    $description = get_string('websitedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Facebook URL setting.
    $name = 'theme_ltiessentiallerenisleuk/facebook';
    $title = get_string('facebookurl', 'theme_essential');
    $description = get_string('facebookdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Flickr URL setting.
    $name = 'theme_ltiessentiallerenisleuk/flickr';
    $title = get_string('flickrurl', 'theme_essential');
    $description = get_string('flickrdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Twitter URL setting.
    $name = 'theme_ltiessentiallerenisleuk/twitter';
    $title = get_string('twitterurl', 'theme_essential');
    $description = get_string('twitterdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Google+ URL setting.
    $name = 'theme_ltiessentiallerenisleuk/googleplus';
    $title = get_string('googleplusurl', 'theme_essential');
    $description = get_string('googleplusdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // LinkedIn URL setting.
    $name = 'theme_ltiessentiallerenisleuk/linkedin';
    $title = get_string('linkedinurl', 'theme_essential');
    $description = get_string('linkedindesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Pinterest URL setting.
    $name = 'theme_ltiessentiallerenisleuk/pinterest';
    $title = get_string('pinteresturl', 'theme_essential');
    $description = get_string('pinterestdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Instagram URL setting.
    $name = 'theme_ltiessentiallerenisleuk/instagram';
    $title = get_string('instagramurl', 'theme_essential');
    $description = get_string('instagramdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // YouTube URL setting.
    $name = 'theme_ltiessentiallerenisleuk/youtube';
    $title = get_string('youtubeurl', 'theme_essential');
    $description = get_string('youtubedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Skype URL setting.
    $name = 'theme_ltiessentiallerenisleuk/skype';
    $title = get_string('skypeuri', 'theme_essential');
    $description = get_string('skypedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // VKontakte URL setting.
    $name = 'theme_ltiessentiallerenisleuk/vk';
    $title = get_string('vkurl', 'theme_essential');
    $description = get_string('vkdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // Apps settings.
    $ltiessentiallerenisleuksettingsheader->add(new admin_setting_heading('theme_ltiessentiallerenisleuk_mobileapps',
        get_string('mobileappsheadingsub', 'theme_essential'),
        format_text(get_string('mobileappsdesc', 'theme_essential'), FORMAT_MARKDOWN)));

     // iOS icons heading.
    $name = 'theme_ltiessentiallerenisleuk/iosiconinfo';
    $heading = get_string('iosicon', 'theme_essential');
    $information = get_string('iosicondesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // The iPhone icon.
    $name = 'theme_ltiessentiallerenisleuk/iphoneicon';
    $title = get_string('iphoneicon', 'theme_essential');
    $description = get_string('iphoneicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // The iPhone retina icon.
    $name = 'theme_ltiessentiallerenisleuk/iphoneretinaicon';
    $title = get_string('iphoneretinaicon', 'theme_essential');
    $description = get_string('iphoneretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'iphoneretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // The iPad icon.
    $name = 'theme_ltiessentiallerenisleuk/ipadicon';
    $title = get_string('ipadicon', 'theme_essential');
    $description = get_string('ipadicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);

    // The iPad retina icon.
    $name = 'theme_ltiessentiallerenisleuk/ipadretinaicon';
    $title = get_string('ipadretinaicon', 'theme_essential');
    $description = get_string('ipadretinaicondesc', 'theme_essential');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'ipadretinaicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsheader->add($setting);
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleuksettingsheader);

// Font settings.
$ltiessentiallerenisleuksettingsfont = new admin_settingpage('theme_ltiessentiallerenisleuk_font', get_string('fontsettings', 'theme_essential'));
if ($ADMIN->fulltree) {
    // This is the descriptor for the font settings.
    $name = 'theme_ltiessentiallerenisleuk/fontheading';
    $heading = get_string('fontheadingsub', 'theme_essential');
    $information = get_string('fontheadingdesc', 'theme_essential');
    $setting = new admin_setting_heading($name, $heading, $information);
    $ltiessentiallerenisleuksettingsfont->add($setting);

    // Font selector.
    $gws = html_writer::link('//www.google.com/fonts', get_string('fonttypegoogle', 'theme_essential'), array('target' => '_blank'));
    $name = 'theme_ltiessentiallerenisleuk/fontselect';
    $title = get_string('fontselect', 'theme_essential');
    $description = get_string('fontselectdesc', 'theme_ltiessentiallerenisleuk', array('googlewebfonts' => $gws));
    $default = 1;
    $choices = array(
        1 => get_string('fonttypeuser', 'theme_essential'),
        2 => get_string('fonttypegoogle', 'theme_essential')
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfont->add($setting);

    // Heading font name.
    $name = 'theme_ltiessentiallerenisleuk/fontnameheading';
    $title = get_string('fontnameheading', 'theme_essential');
    $description = get_string('fontnameheadingdesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfont->add($setting);

    // Text font name.
    $name = 'theme_ltiessentiallerenisleuk/fontnamebody';
    $title = get_string('fontnamebody', 'theme_essential');
    $description = get_string('fontnamebodydesc', 'theme_essential');
    $default = 'Verdana';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfont->add($setting);

    if (get_config('theme_ltiessentiallerenisleuk', 'fontselect') === "2") {
        // Google font character sets.
        $name = 'theme_ltiessentiallerenisleuk/fontcharacterset';
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
        $ltiessentiallerenisleuksettingsfont->add($setting);
    }

    $ltiessentiallerenisleuksettingsfont->add(new admin_setting_heading('theme_ltiessentiallerenisleuk_fontreadme',
        get_string('readme_title', 'theme_essential'), get_string('readme_desc', 'theme_essential', array('url' => $readme))));
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleuksettingsfont);

// Footer settings.
$ltiessentiallerenisleuksettingsfooter = new admin_settingpage('theme_ltiessentiallerenisleuk_footer', get_string('footerheading', 'theme_essential'));
if ($ADMIN->fulltree) {
    // Copyright setting.
    $name = 'theme_ltiessentiallerenisleuk/copyright';
    $title = get_string('copyright', 'theme_essential');
    $description = get_string('copyrightdesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $ltiessentiallerenisleuksettingsfooter->add($setting);

    // Footnote setting.
    $name = 'theme_ltiessentiallerenisleuk/footnote';
    $title = get_string('footnote', 'theme_essential');
    $description = get_string('footnotedesc', 'theme_essential');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $ltiessentiallerenisleuksettingsfooter->add($setting);
}
$ADMIN->add('theme_ltiessentiallerenisleuk', $ltiessentiallerenisleuksettingsfooter);