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


/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_edumy_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'headerlogo1' || $filearea === 'headerlogo2' || $filearea === 'headerlogo3' || $filearea === 'footerlogo1' || $filearea === 'heading_bg')) {
        $theme = theme_config::load('edumy');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_edumy_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');

    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_edumy', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_edumy and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/edumy/scss/pre.scss');
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/edumy/scss/post.scss');

    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}

/**
 * Copy the updated theme image to the correct location in dataroot for the image to be served
 * by /theme/image.php. Also clear theme caches.
 *
 * @param $settingname
 */
function theme_edumy_update_settings_images($settingname) {
    global $CFG, $OUTPUT;

    // The setting name that was updated comes as a string like 's_theme_edumy_loginbackgroundimage'.
    // We split it on '_' characters.
    $parts = explode('_', $settingname);
    // And get the last one to get the setting name..
    $settingname = end($parts);

    // Admin settings are stored in system context.
    $syscontext = context_system::instance();
    // This is the component name the setting is stored in.
    $component = 'theme_edumy';


    // This is the value of the admin setting which is the filename of the uploaded file.
    $filename = get_config($component, $settingname);
    // We extract the file extension because we want to preserve it.
    $extension = substr($filename, strrpos($filename, '.') + 1);

    // This is the path in the moodle internal file system.
    $fullpath = "/{$syscontext->id}/{$component}/{$settingname}/0{$filename}";

    // This location matches the searched for location in theme_config::resolve_image_location.
    $pathname = $CFG->dataroot . '/pix_plugins/theme/edumy/' . $settingname . '.' . $extension;

    // This pattern matches any previous files with maybe different file extensions.
    $pathpattern = $CFG->dataroot . '/pix_plugins/theme/edumy/' . $settingname . '.*';

    // Make sure this dir exists.
    @mkdir($CFG->dataroot . '/pix_plugins/theme/edumy/', $CFG->directorypermissions, true);

    // Delete any existing files for this setting.
    foreach (glob($pathpattern) as $filename) {
        @unlink($filename);
    }

    // Get an instance of the moodle file storage.
    $fs = get_file_storage();
    // This is an efficient way to get a file if we know the exact path.
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {
        // We got the stored file - copy it to dataroot.
        $file->copy_content_to($pathname);
    }

    // Reset theme caches.
    theme_reset_all_caches();
}

function theme_edumy_process_css($css, $theme) {
    global $CFG;

    $tag = '[[cocoon:edumy]]';
    $css = str_replace($tag, $CFG->wwwroot . '/theme/edumy', $css);

    $setting = $theme->settings->color_gradient_start;
    $tag = '[[setting:color_gradient_start]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#ff1053';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_gradient_end;
    $tag = '[[setting:color_gradient_end]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#3452ff';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_primary;
    $tag = '[[setting:color_primary]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#2441e7';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_secondary;
    $tag = '[[setting:color_secondary]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#ff1053';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_accent;
    $tag = '[[setting:color_accent]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#e35a9a';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_accent_2;
    $tag = '[[setting:color_accent_2]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#c75533';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_header_style_2_top;
    $tag = '[[setting:color_header_style_2_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#000';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_header_style_2_bottom;
    $tag = '[[setting:color_header_style_2_bottom]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#141414';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_header_style_4_top;
    $tag = '[[setting:color_header_style_4_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#3452ff';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_header_style_5;
    $tag = '[[setting:color_header_style_5]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#ffffff';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_header_style_6_top;
    $tag = '[[setting:color_header_style_6_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#3452ff';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_1_top;
    $tag = '[[setting:color_footer_style_1_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#151515';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_1_bottom;
    $tag = '[[setting:color_footer_style_1_bottom]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#0a0a0a';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_2_top;
    $tag = '[[setting:color_footer_style_2_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#f9fafc';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_2_bottom;
    $tag = '[[setting:color_footer_style_2_bottom]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#ebeef4';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_3_top;
    $tag = '[[setting:color_footer_style_3_top]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#f9fafc';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_3_middle;
    $tag = '[[setting:color_footer_style_3_middle]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#ffffff';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->color_footer_style_3_bottom;
    $tag = '[[setting:color_footer_style_3_bottom]]';
    $replacement = $setting;
    if(is_null($replacement)){$replacement = '#fafafa';}
    $css = str_replace($tag, $replacement, $css);

    $setting = $theme->settings->heading_bg;
    $tag = '[[setting:heading_bg]]';
    $replacement = $theme->setting_file_url('heading_bg', 'heading_bg');
    if(is_null($replacement)){$replacement = $CFG->wwwroot . '/theme/edumy/images/background/inner-pagebg.jpg';}
    $css = str_replace($tag, $replacement, $css);


    return $css;
}
