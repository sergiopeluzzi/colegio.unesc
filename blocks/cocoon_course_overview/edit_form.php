<?php

class block_cocoon_course_overview_edit_form extends block_edit_form
{
    protected function specific_definition($mform)
    {

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'block_cocoon_course_overview'));
        $mform->setDefault('config_title', 'Overview');
        $mform->setType('config_title', PARAM_RAW);

        // Description
        $mform->addElement('editor', 'config_description', get_string('config_description', 'langfile'));
        $mform->setType('config_description', PARAM_RAW);

    }

}
