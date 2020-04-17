<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
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
 * Theme unesc block settings file
 *
 * @package    theme_unesc
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingunesc', get_string('configtitle', 'theme_unesc'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_unesc_general', get_string('generalsettings', 'theme_unesc'));

    // Logo file setting.
    $name = 'theme_unesc/logo';
    $title = get_string('logo', 'theme_unesc');
    $description = get_string('logodesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon setting.
    $name = 'theme_unesc/favicon';
    $title = get_string('favicon', 'theme_unesc');
    $description = get_string('favicondesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_unesc/preset';
    $title = get_string('preset', 'theme_unesc');
    $description = get_string('preset_desc', 'theme_unesc');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_unesc', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_unesc/presetfiles';
    $title = get_string('presetfiles', 'theme_unesc');
    $description = get_string('presetfiles_desc', 'theme_unesc');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Login page background image.
    $name = 'theme_unesc/loginbgimg';
    $title = get_string('loginbgimg', 'theme_unesc');
    $description = get_string('loginbgimg_desc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_unesc/brandcolor';
    $title = get_string('brandcolor', 'theme_unesc');
    $description = get_string('brandcolor_desc', 'theme_unesc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_unesc/navbarheadercolor';
    $title = get_string('navbarheadercolor', 'theme_unesc');
    $description = get_string('navbarheadercolor_desc', 'theme_unesc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_unesc/navbarbg';
    $title = get_string('navbarbg', 'theme_unesc');
    $description = get_string('navbarbg_desc', 'theme_unesc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg-hover.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_unesc/navbarbghover';
    $title = get_string('navbarbghover', 'theme_unesc');
    $description = get_string('navbarbghover_desc', 'theme_unesc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Course format option.
    $name = 'theme_unesc/coursepresentation';
    $title = get_string('coursepresentation', 'theme_unesc');
    $description = get_string('coursepresentationdesc', 'theme_unesc');
    $options = [];
    $options[1] = get_string('coursedefault', 'theme_unesc');
    $options[2] = get_string('coursecover', 'theme_unesc');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_unesc/courselistview';
    $title = get_string('courselistview', 'theme_unesc');
    $description = get_string('courselistviewdesc', 'theme_unesc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_unesc_advanced', get_string('advancedsettings', 'theme_unesc'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_unesc/scsspre',
        get_string('rawscsspre', 'theme_unesc'), get_string('rawscsspre_desc', 'theme_unesc'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_unesc/scss', get_string('rawscss', 'theme_unesc'),
        get_string('rawscss_desc', 'theme_unesc'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block.
    $name = 'theme_unesc/googleanalytics';
    $title = get_string('googleanalytics', 'theme_unesc');
    $description = get_string('googleanalyticsdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_unesc_frontpage', get_string('frontpagesettings', 'theme_unesc'));

    // Disable bottom footer.
    $name = 'theme_unesc/disablefrontpageloginbox';
    $title = get_string('disablefrontpageloginbox', 'theme_unesc');
    $description = get_string('disablefrontpageloginboxdesc', 'theme_unesc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');

    $page->add($setting);

    // Headerimg file setting.
    $name = 'theme_unesc/headerimg';
    $title = get_string('headerimg', 'theme_unesc');
    $description = get_string('headerimgdesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannerheading.
    $name = 'theme_unesc/bannerheading';
    $title = get_string('bannerheading', 'theme_unesc');
    $description = get_string('bannerheadingdesc', 'theme_unesc');
    $default = 'Perfect Learning System';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannercontent.
    $name = 'theme_unesc/bannercontent';
    $title = get_string('bannercontent', 'theme_unesc');
    $description = get_string('bannercontentdesc', 'theme_unesc');
    $default = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_unesc/displaymarketingbox';
    $title = get_string('displaymarketingbox', 'theme_unesc');
    $description = get_string('displaymarketingboxdesc', 'theme_unesc');
    $default = 1;
    $choices = array(0 => 'No', 1 => 'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Marketing1icon.
    $name = 'theme_unesc/marketing1icon';
    $title = get_string('marketing1icon', 'theme_unesc');
    $description = get_string('marketing1icondesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1heading.
    $name = 'theme_unesc/marketing1heading';
    $title = get_string('marketing1heading', 'theme_unesc');
    $description = get_string('marketing1headingdesc', 'theme_unesc');
    $default = 'We host';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1subheading.
    $name = 'theme_unesc/marketing1subheading';
    $title = get_string('marketing1subheading', 'theme_unesc');
    $description = get_string('marketing1subheadingdesc', 'theme_unesc');
    $default = 'your MOODLE';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1content.
    $name = 'theme_unesc/marketing1content';
    $title = get_string('marketing1content', 'theme_unesc');
    $description = get_string('marketing1contentdesc', 'theme_unesc');
    $default = 'Moodle hosting in a powerful cloud infrastructure';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1url.
    $name = 'theme_unesc/marketing1url';
    $title = get_string('marketing1url', 'theme_unesc');
    $description = get_string('marketing1urldesc', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2icon.
    $name = 'theme_unesc/marketing2icon';
    $title = get_string('marketing2icon', 'theme_unesc');
    $description = get_string('marketing2icondesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2heading.
    $name = 'theme_unesc/marketing2heading';
    $title = get_string('marketing2heading', 'theme_unesc');
    $description = get_string('marketing2headingdesc', 'theme_unesc');
    $default = 'Consulting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2subheading.
    $name = 'theme_unesc/marketing2subheading';
    $title = get_string('marketing2subheading', 'theme_unesc');
    $description = get_string('marketing2subheadingdesc', 'theme_unesc');
    $default = 'for your company';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2content.
    $name = 'theme_unesc/marketing2content';
    $title = get_string('marketing2content', 'theme_unesc');
    $description = get_string('marketing2contentdesc', 'theme_unesc');
    $default = 'Moodle consulting and training for you';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2url.
    $name = 'theme_unesc/marketing2url';
    $title = get_string('marketing2url', 'theme_unesc');
    $description = get_string('marketing2urldesc', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3icon.
    $name = 'theme_unesc/marketing3icon';
    $title = get_string('marketing3icon', 'theme_unesc');
    $description = get_string('marketing3icondesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3heading.
    $name = 'theme_unesc/marketing3heading';
    $title = get_string('marketing3heading', 'theme_unesc');
    $description = get_string('marketing3headingdesc', 'theme_unesc');
    $default = 'Development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3subheading.
    $name = 'theme_unesc/marketing3subheading';
    $title = get_string('marketing3subheading', 'theme_unesc');
    $description = get_string('marketing3subheadingdesc', 'theme_unesc');
    $default = 'themes and plugins';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3content.
    $name = 'theme_unesc/marketing3content';
    $title = get_string('marketing3content', 'theme_unesc');
    $description = get_string('marketing3contentdesc', 'theme_unesc');
    $default = 'We develop themes and plugins as your desires';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3url.
    $name = 'theme_unesc/marketing3url';
    $title = get_string('marketing3url', 'theme_unesc');
    $description = get_string('marketing3urldesc', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4icon.
    $name = 'theme_unesc/marketing4icon';
    $title = get_string('marketing4icon', 'theme_unesc');
    $description = get_string('marketing4icondesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4heading.
    $name = 'theme_unesc/marketing4heading';
    $title = get_string('marketing4heading', 'theme_unesc');
    $description = get_string('marketing4headingdesc', 'theme_unesc');
    $default = 'Support';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4subheading.
    $name = 'theme_unesc/marketing4subheading';
    $title = get_string('marketing4subheading', 'theme_unesc');
    $description = get_string('marketing4subheadingdesc', 'theme_unesc');
    $default = 'we give you answers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4content.
    $name = 'theme_unesc/marketing4content';
    $title = get_string('marketing4content', 'theme_unesc');
    $description = get_string('marketing4contentdesc', 'theme_unesc');
    $default = 'MOODLE specialized support';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4url.
    $name = 'theme_unesc/marketing4url';
    $title = get_string('marketing4url', 'theme_unesc');
    $description = get_string('marketing4urldesc', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Enable or disable Slideshow settings.
    $name = 'theme_unesc/sliderenabled';
    $title = get_string('sliderenabled', 'theme_unesc');
    $description = get_string('sliderenableddesc', 'theme_unesc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Enable slideshow on frontpage guest page.
    $name = 'theme_unesc/sliderfrontpage';
    $title = get_string('sliderfrontpage', 'theme_unesc');
    $description = get_string('sliderfrontpagedesc', 'theme_unesc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_unesc/slidercount';
    $title = get_string('slidercount', 'theme_unesc');
    $description = get_string('slidercountdesc', 'theme_unesc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 13; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $slidercount = get_config('theme_unesc', 'slidercount');

    if (!$slidercount) {
        $slidercount = 1;
    }

    for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
        $fileid = 'sliderimage' . $sliderindex;
        $name = 'theme_unesc/sliderimage' . $sliderindex;
        $title = get_string('sliderimage', 'theme_unesc');
        $description = get_string('sliderimagedesc', 'theme_unesc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_unesc/slidertitle' . $sliderindex;
        $title = get_string('slidertitle', 'theme_unesc');
        $description = get_string('slidertitledesc', 'theme_unesc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);

        $name = 'theme_unesc/slidercap' . $sliderindex;
        $title = get_string('slidercaption', 'theme_unesc');
        $description = get_string('slidercaptiondesc', 'theme_unesc');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    // Enable or disable Slideshow settings.
    $name = 'theme_unesc/numbersfrontpage';
    $title = get_string('numbersfrontpage', 'theme_unesc');
    $description = get_string('numbersfrontpagedesc', 'theme_unesc');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Enable sponsors on frontpage guest page.
    $name = 'theme_unesc/sponsorsfrontpage';
    $title = get_string('sponsorsfrontpage', 'theme_unesc');
    $description = get_string('sponsorsfrontpagedesc', 'theme_unesc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_unesc/sponsorstitle';
    $title = get_string('sponsorstitle', 'theme_unesc');
    $description = get_string('sponsorstitledesc', 'theme_unesc');
    $default = get_string('sponsorstitledefault', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_unesc/sponsorssubtitle';
    $title = get_string('sponsorssubtitle', 'theme_unesc');
    $description = get_string('sponsorssubtitledesc', 'theme_unesc');
    $default = get_string('sponsorssubtitledefault', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_unesc/sponsorscount';
    $title = get_string('sponsorscount', 'theme_unesc');
    $description = get_string('sponsorscountdesc', 'theme_unesc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $sponsorscount = get_config('theme_unesc', 'sponsorscount');

    if (!$sponsorscount) {
        $sponsorscount = 1;
    }

    for ($sponsorsindex = 1; $sponsorsindex <= $sponsorscount; $sponsorsindex++) {
        $fileid = 'sponsorsimage' . $sponsorsindex;
        $name = 'theme_unesc/sponsorsimage' . $sponsorsindex;
        $title = get_string('sponsorsimage', 'theme_unesc');
        $description = get_string('sponsorsimagedesc', 'theme_unesc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_unesc/sponsorsurl' . $sponsorsindex;
        $title = get_string('sponsorsurl', 'theme_unesc');
        $description = get_string('sponsorsurldesc', 'theme_unesc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    // Enable clients on frontpage guest page.
    $name = 'theme_unesc/clientsfrontpage';
    $title = get_string('clientsfrontpage', 'theme_unesc');
    $description = get_string('clientsfrontpagedesc', 'theme_unesc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_unesc/clientstitle';
    $title = get_string('clientstitle', 'theme_unesc');
    $description = get_string('clientstitledesc', 'theme_unesc');
    $default = get_string('clientstitledefault', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_unesc/clientssubtitle';
    $title = get_string('clientssubtitle', 'theme_unesc');
    $description = get_string('clientssubtitledesc', 'theme_unesc');
    $default = get_string('clientssubtitledefault', 'theme_unesc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_unesc/clientscount';
    $title = get_string('clientscount', 'theme_unesc');
    $description = get_string('clientscountdesc', 'theme_unesc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $clientscount = get_config('theme_unesc', 'clientscount');

    if (!$clientscount) {
        $clientscount = 1;
    }

    for ($clientsindex = 1; $clientsindex <= $clientscount; $clientsindex++) {
        $fileid = 'clientsimage' . $clientsindex;
        $name = 'theme_unesc/clientsimage' . $clientsindex;
        $title = get_string('clientsimage', 'theme_unesc');
        $description = get_string('clientsimagedesc', 'theme_unesc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_unesc/clientsurl' . $clientsindex;
        $title = get_string('clientsurl', 'theme_unesc');
        $description = get_string('clientsurldesc', 'theme_unesc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_unesc_footer', get_string('footersettings', 'theme_unesc'));

    $name = 'theme_unesc/getintouchcontent';
    $title = get_string('getintouchcontent', 'theme_unesc');
    $description = get_string('getintouchcontentdesc', 'theme_unesc');
    $default = 'madriproducoes.com.br';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Website.
    $name = 'theme_unesc/website';
    $title = get_string('website', 'theme_unesc');
    $description = get_string('websitedesc', 'theme_unesc');
    $default = 'https://madriproducoes.com.br';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mobile.
    $name = 'theme_unesc/mobile';
    $title = get_string('mobile', 'theme_unesc');
    $description = get_string('mobiledesc', 'theme_unesc');
    $default = 'Mobile : +55 (11) 979970174';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mail.
    $name = 'theme_unesc/mail';
    $title = get_string('mail', 'theme_unesc');
    $description = get_string('maildesc', 'theme_unesc');
    $default = 'orcamento@madriproducoes.com.br';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_unesc/facebook';
    $title = get_string('facebook', 'theme_unesc');
    $description = get_string('facebookdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_unesc/twitter';
    $title = get_string('twitter', 'theme_unesc');
    $description = get_string('twitterdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Googleplus url setting.
    $name = 'theme_unesc/googleplus';
    $title = get_string('googleplus', 'theme_unesc');
    $description = get_string('googleplusdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_unesc/linkedin';
    $title = get_string('linkedin', 'theme_unesc');
    $description = get_string('linkedindesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_unesc/youtube';
    $title = get_string('youtube', 'theme_unesc');
    $description = get_string('youtubedesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Instagram url setting.
    $name = 'theme_unesc/instagram';
    $title = get_string('instagram', 'theme_unesc');
    $description = get_string('instagramdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Top footer background image.
    $name = 'theme_unesc/topfooterimg';
    $title = get_string('topfooterimg', 'theme_unesc');
    $description = get_string('topfooterimgdesc', 'theme_unesc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'topfooterimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Disable bottom footer.
    $name = 'theme_unesc/disablebottomfooter';
    $title = get_string('disablebottomfooter', 'theme_unesc');
    $description = get_string('disablebottomfooterdesc', 'theme_unesc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');

    $settings->add($page);

    // Forum page.
    $settingpage = new admin_settingpage('theme_unesc_forum', get_string('forumsettings', 'theme_unesc'));

    $settingpage->add(new admin_setting_heading('theme_unesc_forumheading', null,
            format_text(get_string('forumsettingsdesc', 'theme_unesc'), FORMAT_MARKDOWN)));

    // Enable custom template.
    $name = 'theme_unesc/forumcustomtemplate';
    $title = get_string('forumcustomtemplate', 'theme_unesc');
    $description = get_string('forumcustomtemplatedesc', 'theme_unesc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settingpage->add($setting);

    // Header setting.
    $name = 'theme_unesc/forumhtmlemailheader';
    $title = get_string('forumhtmlemailheader', 'theme_unesc');
    $description = get_string('forumhtmlemailheaderdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    // Footer setting.
    $name = 'theme_unesc/forumhtmlemailfooter';
    $title = get_string('forumhtmlemailfooter', 'theme_unesc');
    $description = get_string('forumhtmlemailfooterdesc', 'theme_unesc');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    $settings->add($settingpage);
}
