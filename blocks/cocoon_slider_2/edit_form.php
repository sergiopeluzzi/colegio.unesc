<?php

class block_cocoon_slider_2_edit_form extends block_edit_form {
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

        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'config_style', '', 'Standard', 0, $attributes);
        $radioarray[] = $mform->createElement('radio', 'config_style', '', 'Fullsize', 1, $attributes);
        $mform->addGroup($radioarray, 'config_style', 'Slider Size', array(' '), false);

        $slidesrange = range(0, 12);
        $mform->addElement('select', 'config_slidesnumber', get_string('slides_number', 'block_cocoon_slider_2'), $slidesrange);
        $mform->setDefault('config_slidesnumber', $data->slidesnumber);

        $mform->addElement('text', 'config_prev_1', get_string('config_prev_1', 'theme_edumy'));
        $mform->setDefault('config_prev_1', 'PR');
        $mform->setType('config_prev_1', PARAM_TEXT);

        $mform->addElement('text', 'config_prev_2', get_string('config_prev_2', 'theme_edumy'));
        $mform->setDefault('config_prev_2', 'EV');
        $mform->setType('config_prev_2', PARAM_TEXT);

        $mform->addElement('text', 'config_next_1', get_string('config_next_1', 'theme_edumy'));
        $mform->setDefault('config_next_1', 'NE');
        $mform->setType('config_next_1', PARAM_TEXT);

        $mform->addElement('text', 'config_next_2', get_string('config_next_2', 'theme_edumy'));
        $mform->setDefault('config_next_2', 'XT');
        $mform->setType('config_next_2', PARAM_TEXT);

        for($i = 1; $i <= $data->slidesnumber; $i++) {
            $mform->addElement('header', 'config_header' . $i , 'Slide ' . $i);

            $mform->addElement('text', 'config_slide_title' . $i, get_string('config_title', 'theme_edumy', $i));
            $mform->setDefault('config_slide_title' .$i , 'Self Education Resources and Infos');
            $mform->setType('config_slide_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_slide_subtitle' . $i, get_string('config_subtitle', 'theme_edumy', $i));
            $mform->setDefault('config_slide_subtitle' .$i , 'Technology is brining a massive wave of evolution on learning things on different ways.');
            $mform->setType('config_slide_subtitle' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_slide_btn_text' . $i, get_string('config_button_text', 'theme_edumy', $i));
            $mform->setDefault('config_slide_btn_text' .$i , 'Ready to Get Started?');
            $mform->setType('config_slide_btn_text' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_slide_btn_url' . $i, get_string('config_button_link', 'theme_edumy', $i));
            $mform->setDefault('config_slide_btn_url' .$i , '#');
            $mform->setType('config_slide_btn_url' . $i, PARAM_TEXT);


            $filemanageroptions = array('maxbytes'      => $CFG->maxbytes,
                                        'subdirs'       => 0,
                                        'maxfiles'      => 1,
                                        'accepted_types' => array('.jpg', '.png', '.gif'));

            $f = $mform->addElement('filemanager', 'config_file_slide' . $i, get_string('config_image', 'theme_edumy', $i), null, $filemanageroptions);
        }

    }

    function set_data($defaults) {
        if (!empty($this->block->config) && is_object($this->block->config)) {

            for($i = 1; $i <= $this->block->config->slidesnumber; $i++) {
                $field = 'file_slide' . $i;
                $conffield = 'config_file_slide' . $i;
                $draftitemid = file_get_submitted_draft_itemid($conffield);
                file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_cocoon_slider_2', 'slides', $i, array('subdirs'=>false));
                $defaults->$conffield['itemid'] = $draftitemid;
                $this->block->config->$field = $draftitemid;
            }
        }

        parent::set_data($defaults);
    }
}
