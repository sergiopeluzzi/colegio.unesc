<?php

class block_cocoon_parallax_apps_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        // Fields for editing HTML block title and contents.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_title', 'Download & Enjoy');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_subtitle', 'Access your courses anywhere, anytime & prepare with practice tests.');
        $mform->setType('config_subtitle', PARAM_RAW);

        $mform->addElement('header', 'config_app_store_btn', get_string('config_app_store_btn', 'block_cocoon_parallax_apps'));

        $mform->addElement('text', 'config_app_store_btn_title', get_string('config_app_store_btn_title', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_app_store_btn_title', 'App Store');
        $mform->setType('config_app_store_btn_title', PARAM_RAW);

        $mform->addElement('text', 'config_app_store_btn_subtitle', get_string('config_app_store_btn_subtitle', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_app_store_btn_subtitle', 'Available on the');
        $mform->setType('config_app_store_btn_subtitle', PARAM_RAW);

        $mform->addElement('text', 'config_app_store_btn_link', get_string('config_app_store_btn_link', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_app_store_btn_link', '#');
        $mform->setType('config_app_store_btn_link', PARAM_RAW);

        $mform->addElement('header', 'config_play_store_btn', get_string('config_play_store_btn', 'block_cocoon_parallax_apps'));

        $mform->addElement('text', 'config_play_store_btn_title', get_string('config_play_store_btn_title', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_play_store_btn_title', 'Google Play');
        $mform->setType('config_play_store_btn_title', PARAM_RAW);

        $mform->addElement('text', 'config_play_store_btn_subtitle', get_string('config_play_store_btn_subtitle', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_play_store_btn_subtitle', 'Get it on');
        $mform->setType('config_play_store_btn_subtitle', PARAM_RAW);

        $mform->addElement('text', 'config_play_store_btn_link', get_string('config_play_store_btn_link', 'block_cocoon_parallax_apps'));
        $mform->setDefault('config_play_store_btn_link', '#');
        $mform->setType('config_play_store_btn_link', PARAM_RAW);

        for($i = 1; $i <= 2; $i++) {
            $mform->addElement('header', 'config_header' . $i , 'Image ' . $i);

            $filemanageroptions = array('maxbytes'      => $CFG->maxbytes,
                                        'subdirs'       => 0,
                                        'maxfiles'      => 1,
                                        'accepted_types' => array('.jpg', '.png', '.gif'));

            $f = $mform->addElement('filemanager', 'config_image' . $i, get_string('config_image', 'block_cocoon_parallax_apps', $i), null, $filemanageroptions);
        }

    }

    function set_data($defaults) {
        if (!empty($this->block->config) && is_object($this->block->config)) {

            for($i = 1; $i <= 2; $i++) {
                $field = 'image' . $i;
                $config_field = 'config_image' . $i;
                $draftitemid = file_get_submitted_draft_itemid($config_field);
                file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_cocoon_parallax_apps', 'images', $i, array('subdirs'=>false));
                $defaults->$config_field['itemid'] = $draftitemid;
                $this->block->config->$field = $draftitemid;
            }
        }

        parent::set_data($defaults);
    }
}
