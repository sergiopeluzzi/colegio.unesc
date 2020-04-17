<?php

class block_cocoon_featured_text_edit_form extends block_edit_form
{
    protected function specific_definition($mform)
    {

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_cocoon_featured_text'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_RAW);

        $mform->addElement('text', 'config_heading', get_string('blockheading', 'block_cocoon_featured_text'));
        $mform->setDefault('config_heading', '');
        $mform->addHelpButton('config_heading', 'blockheading', 'block_cocoon_featured_text');
        $mform->setType('config_heading', PARAM_RAW);

        $mform->addElement('text', 'config_subheading', get_string('blocksubheading', 'block_cocoon_featured_text'));
        $mform->setDefault('config_subheading', '');
        $mform->addHelpButton('config_subheading', 'blocksubheading', 'block_cocoon_featured_text');
        $mform->setType('config_subheading', PARAM_RAW);

        $mform->addElement('text', 'config_btntext', get_string('blockbtntext', 'block_cocoon_featured_text'));
        $mform->setDefault('config_btntext', '');
        $mform->addHelpButton('config_btntext', 'blockbtntext', 'block_cocoon_featured_text');
        $mform->setType('config_btntext', PARAM_RAW);

        $mform->addElement('text', 'config_btnurl', get_string('blockbtnurl', 'block_cocoon_featured_text'));
        $mform->setDefault('config_btnurl', '');
        $mform->addHelpButton('config_btnurl', 'blockbtnurl', 'block_cocoon_featured_text');
        $mform->setType('config_btnurl', PARAM_RAW);

        $mform->addElement('filemanager', 'config_image', get_string('blockimage', 'block_cocoon_featured_text'), null,
                array('subdirs' => 0, 'maxbytes' => $maxbytes, 'areamaxbytes' => 10485760, 'maxfiles' => 1,
                'accepted_types' => array('.png', '.jpg', '.gif') ));
        $mform->addHelpButton('config_image', 'imagefile', 'block_slideshow');

    }
}
