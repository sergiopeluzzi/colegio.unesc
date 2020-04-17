<?php

defined('MOODLE_INTERNAL') || die();

class block_cocoon_more_courses_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $CFG;

        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'block_cocoon_more_courses'));
        $mform->setDefault('config_title', 'Related Courses');
        $mform->setType('config_title', PARAM_RAW);

        // Hover text
        $mform->addElement('text', 'config_hover_text', get_string('config_hover_text', 'block_cocoon_featuredcourses'));
        $mform->setDefault('config_hover_text', 'Preview Course');
        $mform->setType('config_hover_text', PARAM_RAW);

        // Hover accent
        $mform->addElement('text', 'config_hover_accent', get_string('config_hover_accent', 'block_cocoon_featuredcourses'));
        $mform->setDefault('config_hover_accent', 'Top Seller');
        $mform->setType('config_hover_accent', PARAM_RAW);

        $mform->addElement('static', 'link',
                           get_string('editlink', 'block_cocoon_more_courses',
                                      $CFG->wwwroot.'/blocks/cocoon_more_courses/cocoon_more_courses.php'));
    }
}
