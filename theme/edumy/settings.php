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

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingedumy', get_string('configtitle', 'theme_edumy'));

    // CCN General settings
    $page = new admin_settingpage('theme_edumy_general', get_string('general_settings', 'theme_edumy'));

    // Blog style
    $setting = new admin_setting_configselect('theme_edumy/blogstyle',
        get_string('blogstyle', 'theme_edumy'),
        get_string('blogstyle_desc', 'theme_edumy'), null,
                array('1' => 'Blog style 1',
                      '2' => 'Blog style 2',
                      '3' => 'Blog style 3'
                    ));
    $page->add($setting);
    // Course list style
    $setting = new admin_setting_configselect('theme_edumy/courseliststyle',
        get_string('courseliststyle', 'theme_edumy'),
        get_string('courseliststyle_desc', 'theme_edumy'), null,
                array('1' => 'Grid',
                      '2' => 'List'
                    ));
    $page->add($setting);

    // Page heading background
    $name='theme_edumy/heading_bg';
    $title = get_string('heading_bg', 'theme_edumy');
    $description = get_string('heading_bg_desc', 'theme_edumy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'heading_bg');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // CCN Header settings
    $page = new admin_settingpage('theme_edumy_header', get_string('header_settings', 'theme_edumy'));

    // Logotype
    $setting = new admin_setting_configselect('theme_edumy/logotype',
        get_string('logotype', 'theme_edumy'),
        get_string('logotype_desc', 'theme_edumy'), null,
                array('0' => 'Visible',
                      '1' => 'Hidden'
                    ));
    $page->add($setting);

    // Logo image
    $setting = new admin_setting_configselect('theme_edumy/logo_image',
        get_string('logo_image', 'theme_edumy'),
        get_string('logo_image_desc', 'theme_edumy'), null,
                array('0' => 'Visible',
                      '1' => 'Hidden'
                    ));
    $page->add($setting);

    // Header type
    $setting = new admin_setting_configselect('theme_edumy/headertype',
        get_string('headertype', 'theme_edumy'),
        get_string('headertype_desc', 'theme_edumy'), null,
                array('1' => 'Header 1',
                      '2' => 'Header 2',
                      '3' => 'Header 3',
                      '4' => 'Header 4',
                      '5' => 'Header 5',
                      '6' => 'Header 6',
                      '7' => 'Header 7',
                      '8' => 'Header 8'
                    ));
    $page->add($setting);
    // Header logo 1
    $name='theme_edumy/headerlogo1';
    $title = get_string('headerlogo1', 'theme_edumy');
    $description = get_string('headerlogo1_desc', 'theme_edumy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerlogo1');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Header logo 2
    $name='theme_edumy/headerlogo2';
    $title = get_string('headerlogo2', 'theme_edumy');
    $description = get_string('headerlogo2_desc', 'theme_edumy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerlogo2');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Header logo 3
    $name='theme_edumy/headerlogo3';
    $title = get_string('headerlogo3', 'theme_edumy');
    $description = get_string('headerlogo3_desc', 'theme_edumy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerlogo3');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Header email address
    $setting = new admin_setting_configtext('theme_edumy/email_address', get_string('email_address','theme_edumy'), get_string('email_address_desc', 'theme_edumy'), 'hello@edumy.com', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Header phone
    $setting = new admin_setting_configtext('theme_edumy/phone', get_string('phone','theme_edumy'), get_string('phone_desc', 'theme_edumy'), '(56) 123 456 789', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Call to Action Text
    $setting = new admin_setting_configtext('theme_edumy/cta_text', get_string('cta_text','theme_edumy'), get_string('cta_text_desc', 'theme_edumy'), 'Become an Instructor', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Call to Action Link
    $setting = new admin_setting_configtext('theme_edumy/cta_link', get_string('cta_link','theme_edumy'), get_string('cta_link_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // CCN Footer settings
    $page = new admin_settingpage('theme_edumy_footer', get_string('footer_settings', 'theme_edumy'));
    // Footer settings
    $page->add(new admin_setting_heading('theme_edumy/footer_settings', get_string('footer_settings', 'theme_edumy'), NULL));

    // Logotype Footer
    $setting = new admin_setting_configselect('theme_edumy/logotype_footer',
        get_string('logotype_footer', 'theme_edumy'),
        get_string('logotype_footer_desc', 'theme_edumy'), null,
                array('0' => 'Visible',
                      '1' => 'Hidden'
                    ));
    $page->add($setting);

    // Logo image Footer
    $setting = new admin_setting_configselect('theme_edumy/logo_image_footer',
        get_string('logo_image_footer', 'theme_edumy'),
        get_string('logo_image_footer_desc', 'theme_edumy'), null,
                array('0' => 'Visible',
                      '1' => 'Hidden'
                    ));
    $page->add($setting);

    // Footer logo 1
    $name='theme_edumy/footerlogo1';
    $title = get_string('footerlogo1', 'theme_edumy');
    $description = get_string('footerlogo1_desc', 'theme_edumy');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'footerlogo1');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer copyright
    $setting = new admin_setting_configtext('theme_edumy/cocoon_copyright', get_string('cocoon_copyright','theme_edumy'), get_string('cocoon_copyright_desc', 'theme_edumy'), 'Copyright © 2020 Edumy Moodle Theme by Cocoon. All Rights Reserved.', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer style
    $setting = new admin_setting_configselect('theme_edumy/footertype',
        get_string('footertype', 'theme_edumy'),
        get_string('footertype_desc', 'theme_edumy'), null,
                array('1' => 'Footer 1',
                      '2' => 'Footer 2',
                      '3' => 'Footer 3',
                      '4' => 'Footer 4'
                    ));
    $page->add($setting);
    // Footer column 1
    $page->add(new admin_setting_heading('theme_edumy/footer_col_1', get_string('footer_col_1', 'theme_edumy'), NULL));
    // Footer column title
    $setting = new admin_setting_configtext('theme_edumy/footer_col_1_title', get_string('footer_col_title','theme_edumy'), get_string('footer_col_title_desc', 'theme_edumy'), 'Contact', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column body
    $setting = new admin_setting_configtextarea('theme_edumy/footer_col_1_body', get_string('footer_col_body','theme_edumy'), get_string('footer_col_body_desc', 'theme_edumy'), 'Body text for the first column.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column 2
    $page->add(new admin_setting_heading('theme_edumy/footer_col_2', get_string('footer_col_2', 'theme_edumy'), NULL));
    // Footer column title
    $setting = new admin_setting_configtext('theme_edumy/footer_col_2_title', get_string('footer_col_title','theme_edumy'), get_string('footer_col_title_desc', 'theme_edumy'), 'Company', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column body
    $setting = new admin_setting_configtextarea('theme_edumy/footer_col_2_body', get_string('footer_col_body','theme_edumy'), get_string('footer_col_body_desc', 'theme_edumy'), 'Body text for the second column.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column 3
    $page->add(new admin_setting_heading('theme_edumy/footer_col_3', get_string('footer_col_3', 'theme_edumy'), NULL));
    // Footer column title
    $setting = new admin_setting_configtext('theme_edumy/footer_col_3_title', get_string('footer_col_title','theme_edumy'), get_string('footer_col_title_desc', 'theme_edumy'), 'Programs', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column body
    $setting = new admin_setting_configtextarea('theme_edumy/footer_col_3_body', get_string('footer_col_body','theme_edumy'), get_string('footer_col_body_desc', 'theme_edumy'), 'Body text for the third column.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column 4
    $page->add(new admin_setting_heading('theme_edumy/footer_col_4', get_string('footer_col_4', 'theme_edumy'), NULL));
    // Footer column title
    $setting = new admin_setting_configtext('theme_edumy/footer_col_4_title', get_string('footer_col_title','theme_edumy'), get_string('footer_col_title_desc', 'theme_edumy'), 'Support', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column body
    $setting = new admin_setting_configtextarea('theme_edumy/footer_col_4_body', get_string('footer_col_body','theme_edumy'), get_string('footer_col_body_desc', 'theme_edumy'), 'Body text for the fourth column.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column 5
    $page->add(new admin_setting_heading('theme_edumy/footer_col_5', get_string('footer_col_5', 'theme_edumy'), NULL));
    // Footer column title
    $setting = new admin_setting_configtext('theme_edumy/footer_col_5_title', get_string('footer_col_title','theme_edumy'), get_string('footer_col_title_desc', 'theme_edumy'), 'Mobile', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer column body
    $setting = new admin_setting_configtextarea('theme_edumy/footer_col_5_body', get_string('footer_col_body','theme_edumy'), get_string('footer_col_body_desc', 'theme_edumy'), 'Body text for the fifth column.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Footer menu
    $page->add(new admin_setting_heading('theme_edumy/footer_menu', get_string('footer_menu', 'theme_edumy'), NULL));
    // Footer menu
    $setting = new admin_setting_configtextarea('theme_edumy/footer_menu', get_string('footer_menu','theme_edumy'), get_string('footer_menu_desc', 'theme_edumy'), 'Body text for the footer menu.', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // CCN Social settings
    $page = new admin_settingpage('theme_edumy_social_settings', get_string('social_settings', 'theme_edumy'));
    // Facebook URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_facebook_url', get_string('cocoon_facebook_url','theme_edumy'), get_string('cocoon_facebook_url_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Twitter URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_twitter_url', get_string('cocoon_twitter_url','theme_edumy'), get_string('cocoon_twitter_url_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Instagram URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_instagram_url', get_string('cocoon_instagram_url','theme_edumy'), get_string('cocoon_instagram_url_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Pinterest URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_pinterest_url', get_string('cocoon_pinterest_url','theme_edumy'), get_string('cocoon_pinterest_url_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Dribbble URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_dribbble_url', get_string('cocoon_dribbble_url','theme_edumy'), get_string('cocoon_dribbble_url_desc', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Google URL
    $setting = new admin_setting_configtext('theme_edumy/cocoon_google_url', get_string('cocoon_google_url','theme_edumy'), get_string('cocoon_google_url', 'theme_edumy'), '#', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // CCN Color settings
    $page = new admin_settingpage('theme_edumy_color', get_string('color_settings', 'theme_edumy'));

    // Title: Gradients
    $page->add(new admin_setting_heading('theme_edumy/color_settings_gradient', get_string('color_settings_gradient', 'theme_edumy'), NULL));

    // Gradient Start
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_gradient_start', get_string('color_gradient_start','theme_edumy'), get_string('color_gradient_start_desc', 'theme_edumy'), '#ff1053');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Gradient End
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_gradient_end', get_string('color_gradient_end','theme_edumy'), get_string('color_gradient_end_desc', 'theme_edumy'), '#3452ff');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Main colors
    $page->add(new admin_setting_heading('theme_edumy/color_settings_main', get_string('color_settings_main', 'theme_edumy'), NULL));

    // Primary Color
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_primary', get_string('color_primary','theme_edumy'), get_string('color_primary_desc', 'theme_edumy'), '#2441e7');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Secondary Color
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_secondary', get_string('color_secondary','theme_edumy'), get_string('color_secondary_desc', 'theme_edumy'), '#ff1053');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Accent Color
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_accent', get_string('color_accent','theme_edumy'), get_string('color_accent_desc', 'theme_edumy'), '#e35a9a');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Accent Color 2
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_accent_2', get_string('color_accent_2','theme_edumy'), get_string('color_accent_2_desc', 'theme_edumy'), '#c75533');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Header Style 2
    $page->add(new admin_setting_heading('theme_edumy/color_settings_header_style_2', get_string('color_settings_header_style_2', 'theme_edumy'), NULL));

    // Header Style 2: Header Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_header_style_2_top', get_string('color_header_color_top','theme_edumy'), get_string('color_header_color_top_desc', 'theme_edumy'), '#000');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Header Style 2: Header Bottom
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_header_style_2_bottom', get_string('color_header_color_bottom','theme_edumy'), get_string('color_header_color_bottom_desc', 'theme_edumy'), '#141414');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Header Style 4
    $page->add(new admin_setting_heading('theme_edumy/color_settings_header_style_4', get_string('color_settings_header_style_4', 'theme_edumy'), NULL));

    // Header Style 4: Header Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_header_style_4_top', get_string('color_header_color_top','theme_edumy'), get_string('color_header_color_top_desc', 'theme_edumy'), '#3452ff');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Header Style 5
    $page->add(new admin_setting_heading('theme_edumy/color_settings_header_style_5', get_string('color_settings_header_style_5', 'theme_edumy'), NULL));

    // Header Style 5
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_header_style_5', get_string('color_header_color','theme_edumy'), get_string('color_header_color_desc', 'theme_edumy'), '#ffffff');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Header Style 6
    $page->add(new admin_setting_heading('theme_edumy/color_settings_header_style_6', get_string('color_settings_header_style_6', 'theme_edumy'), NULL));

    // Header Style 6: Header Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_header_style_6_top', get_string('color_header_color_top','theme_edumy'), get_string('color_header_color_top_desc', 'theme_edumy'), '#3452ff');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Title: Footer Style 1
    $page->add(new admin_setting_heading('theme_edumy/color_settings_footer_style_1', get_string('color_settings_footer_style_1', 'theme_edumy'), NULL));

    // Footer Style 1: Footer Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_1_top', get_string('color_footer_color_top','theme_edumy'), get_string('color_footer_color_top_desc', 'theme_edumy'), '#151515');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer Style 1: Footer Bottom
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_1_bottom', get_string('color_footer_color_bottom','theme_edumy'), get_string('color_footer_color_bottom_desc', 'theme_edumy'), '#0a0a0a');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Footer Style 2
    $page->add(new admin_setting_heading('theme_edumy/color_settings_footer_style_2', get_string('color_settings_footer_style_2', 'theme_edumy'), NULL));

    // Footer Style 2: Footer Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_2_top', get_string('color_footer_color_top','theme_edumy'), get_string('color_footer_color_top_desc', 'theme_edumy'), '#f9fafc');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer Style 2: Footer Bottom
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_2_bottom', get_string('color_footer_color_bottom','theme_edumy'), get_string('color_footer_color_bottom_desc', 'theme_edumy'), '#ebeef4');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Title: Footer Style 3
    $page->add(new admin_setting_heading('theme_edumy/color_settings_footer_style_3', get_string('color_settings_footer_style_3', 'theme_edumy'), NULL));

    // Footer Style 3: Footer Top
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_3_top', get_string('color_footer_color_top','theme_edumy'), get_string('color_footer_color_top_desc', 'theme_edumy'), '#f9fafc');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer Style 3: Footer Middle
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_3_middle', get_string('color_footer_color_middle','theme_edumy'), get_string('color_footer_color_middle_desc', 'theme_edumy'), '#ffffff');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Footer Style 3: Footer Bottom
    $setting = new admin_setting_configcolourpicker('theme_edumy/color_footer_style_3_bottom', get_string('color_footer_color_bottom','theme_edumy'), get_string('color_footer_color_bottom_desc', 'theme_edumy'), '#fafafa');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // CCN Advanced settings
    $page = new admin_settingpage('theme_edumy_advanced', get_string('advanced_settings', 'theme_edumy'));
    // Google Maps API Key
    $setting = new admin_setting_configtext('theme_edumy/gmaps_key', get_string('gmaps_key','theme_edumy'), get_string('gmaps_key_desc', 'theme_edumy'), '', PARAM_NOTAGS, 50);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Custom CSS
    $setting = new admin_setting_configtextarea('theme_edumy/custom_css', get_string('custom_css','theme_edumy'), get_string('custom_css_desc', 'theme_edumy'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Custom CSS Dashboard
    $setting = new admin_setting_configtextarea('theme_edumy/custom_css_dashboard', get_string('custom_css_dashboard','theme_edumy'), get_string('custom_css_dashboard_desc', 'theme_edumy'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Custom JavaScript
    $setting = new admin_setting_configtextarea('theme_edumy/custom_js', get_string('custom_js','theme_edumy'), get_string('custom_js_desc', 'theme_edumy'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Custom JavaScript Dashboard
    $setting = new admin_setting_configtextarea('theme_edumy/custom_js_dashboard', get_string('custom_js_dashboard','theme_edumy'), get_string('custom_js_dashboard_desc', 'theme_edumy'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

}
