<?php

class block_cocoon_faqs_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        if (!empty($this->block->config) && is_object($this->block->config)) {
            $data = $this->block->config;
        } else {
            $data = new stdClass();
            $data->slidesnumber = 0;
        }


        // Fields for editing HTML block title and contents.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'block_cocoon_faqs'));
        $mform->setDefault('config_title', 'Payments');
        $mform->setType('config_title', PARAM_RAW);

        $slidesrange = range(0, 100);
        $mform->addElement('select', 'config_slidesnumber', get_string('slides_number', 'block_cocoon_faqs'), $slidesrange);
        $mform->setDefault('config_slidesnumber', $data->slidesnumber);

        for($i = 1; $i <= $data->slidesnumber; $i++) {
            $mform->addElement('header', 'config_header' . $i , 'FAQ ' . $i);

            $mform->addElement('text', 'config_faq_title' . $i, get_string('config_faq_title', 'block_cocoon_faqs', $i));
            $mform->setDefault('config_faq_title' .$i , 'Why won\'t my payment go through?');
            $mform->setType('config_faq_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_faq_subtitle' . $i, get_string('config_faq_subtitle', 'block_cocoon_faqs', $i));
            $mform->setDefault('config_faq_subtitle' .$i , 'Course Description');
            $mform->setType('config_faq_subtitle' . $i, PARAM_TEXT);

            $mform->addElement('textarea', 'config_faq_body' . $i, get_string('config_faq_body', 'block_cocoon_faqs', $i));
            $mform->setDefault('config_faq_body' .$i , 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
            $mform->setType('config_faq_body' . $i, PARAM_TEXT);

        }

    }

    function set_data($defaults) {
        if (!empty($this->block->config) && is_object($this->block->config)) {

            for($i = 1; $i <= $this->block->config->slidesnumber; $i++) {
                $field = 'file_slide' . $i;
                $conffield = 'config_file_slide' . $i;
                $draftitemid = file_get_submitted_draft_itemid($conffield);
                file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_cocoon_faqs', 'slides', $i, array('subdirs'=>false));
                $defaults->$conffield['itemid'] = $draftitemid;
                $this->block->config->$field = $draftitemid;
            }
        }

        parent::set_data($defaults);
    }
}
