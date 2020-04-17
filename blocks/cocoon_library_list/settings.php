<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $options = array('all'=>get_string('allcourses', 'block_cocoon_library_list'), 'own'=>get_string('owncourses', 'block_cocoon_library_list'));

    $settings->add(new admin_setting_configselect('block_cocoon_library_list_adminview', get_string('adminview', 'block_cocoon_library_list'),
                       get_string('configadminview', 'block_cocoon_library_list'), 'all', $options));

    $settings->add(new admin_setting_configcheckbox('block_cocoon_library_list_hideallcourseslink', get_string('hideallcourseslink', 'block_cocoon_library_list'),
                       get_string('confighideallcourseslink', 'block_cocoon_library_list'), 0));
}
