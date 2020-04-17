<?php

defined('MOODLE_INTERNAL') || die();

class block_cocoon_courses_slider_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $CFG;

        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edumy'));
        $mform->setDefault('config_title', 'Featured Courses');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'theme_edumy'));
        $mform->setDefault('config_subtitle', 'Cum doctus civibus efficiantur in imperdiet deterruisset.');
        $mform->setType('config_subtitle', PARAM_RAW);

        // Hover text
        $mform->addElement('text', 'config_hover_text', get_string('config_hover_text', 'block_cocoon_featuredcourses'));
        $mform->setDefault('config_hover_text', 'Preview Course');
        $mform->setType('config_hover_text', PARAM_RAW);

        // Hover accent
        $mform->addElement('text', 'config_hover_accent', get_string('config_hover_accent', 'block_cocoon_featuredcourses'));
        $mform->setDefault('config_hover_accent', 'Top Seller');
        $mform->setType('config_hover_accent', PARAM_RAW);

        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'config_style', '', 'Standard', 0, $attributes);
        $radioarray[] = $mform->createElement('radio', 'config_style', '', 'Background', 1, $attributes);
        $mform->addGroup($radioarray, 'config_style', 'Style', array(' '), false);

        $mform->addElement('static', 'link',
                           get_string('editlink', 'block_cocoon_courses_slider',
                                      $CFG->wwwroot.'/blocks/cocoon_courses_slider/cocoon_courses_slider.php'));
    }
}
