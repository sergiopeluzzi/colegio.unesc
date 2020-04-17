<?php

defined('MOODLE_INTERNAL') || die();

class block_cocoon_globalsearch extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_cocoon_globalsearch');
    }

    /**
     * Gets the block contents.
     *
     * If we can avoid it better not check the server status here as connecting
     * to the server will slow down the whole page load.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT;
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';
        $this->title = '';
        $this->content->text = '';

        if (\core_search\manager::is_global_search_enabled() === false) {
            $this->content->text .= get_string('globalsearchdisabled', 'search');
            return $this->content;
        }

        $url = new moodle_url('/search/index.php');
        $this->content->footer .= '';

        $this->content->text .= html_writer::start_tag('form', array('class' => 'ccn-mk-fullscreen-searchform','action' => $url->out()));
        $this->content->text .= html_writer::start_tag('fieldset');

        // Input.
        $inputoptions = array('id' => 'searchform_search', 'name' => 'q', 'class' => 'ccn-mk-fullscreen-search-input', 'placeholder' => get_string('search_courses', 'theme_edumy'),
            'type' => 'text', 'size' => '15');
        $this->content->text .= html_writer::empty_tag('input', $inputoptions);

        // Context id.
        if ($this->page->context && $this->page->context->contextlevel !== CONTEXT_SYSTEM) {
            $this->content->text .= html_writer::empty_tag('input', ['type' => 'hidden',
                    'name' => 'context', 'value' => $this->page->context->id]);
        }

        // Search button.
        $this->content->text .= '<i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit" id="searchform_button"></i>';
        $this->content->text .= html_writer::end_tag('fieldset');
        $this->content->text .= html_writer::end_tag('form');

        return $this->content;
    }
}
