<?php
global $CFG;

class block_cocoon_featured_event extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_featured_event', 'block_cocoon_featured_event');
    }

    // Declare second
    public function specialization()
    {
        $this->title = isset($this->config->title) ? format_string($this->config->title) : '';
    }
    public function get_content(){
        global $CFG, $DB;
        require_once($CFG->libdir . '/filelib.php');
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        if(!empty($this->config->title)){$this->content->title = $this->config->title;}
        if(!empty($this->config->body)){$this->content->body = $this->config->body;}
        if(!empty($this->config->date)){$this->content->date = $this->config->date;}
        if(!empty($this->config->time)){$this->content->time = $this->config->time;}
        if(!empty($this->config->location)){$this->content->location = $this->config->location;}
        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_featured_event', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image .=  $url;
            }
        }
        $this->content->text = '
        <div class="row event_lists p0">
          <div class="col-xl-5 pr15-xl pr0">
            <div class="blog_grid_post event_lists mb35">
              <div class="thumb">
                <img class="img-fluid w100" src="'.$this->content->image.'" alt="">
                <div class="post_date"><h2>'.userdate($this->content->date, '%d', 0).'</h2> <span>'.userdate($this->content->date, '%B', 0).'</span></div>
              </div>
            </div>
          </div>
          <div class="col-xl-7 pl15-xl pl0">
            <div class="blog_grid_post style2 event_lists mb35">
              <div class="details">
                <h3>'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h3>
                <p>'.format_text($this->content->body, FORMAT_HTML, array('filter' => true)).'</p>
                <ul class="mb0">
                  <li class="ccn-block-featured-event-detail"><span class="flaticon-appointment"></span>'.userdate($this->content->date, get_string('strftimedatefullshort', 'langconfig'), 0).'</li>
                  <li class="ccn-block-featured-event-detail"><span class="flaticon-clock"></span>'.format_text($this->content->time, FORMAT_HTML, array('filter' => true)).'</li>
                  <li class="ccn-block-featured-event-detail"><span class="flaticon-placeholder"></span>'.format_text($this->content->location, FORMAT_HTML, array('filter' => true)).'</li>
                </ul>
              </div>
            </div>
          </div>
        </div>';
        return $this->content;
    }

    /**
     * Allow multiple instances in a single course?
     *
     * @return bool True if multiple instances are allowed, false otherwise.
     */
    public function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
     function applicable_formats() {
         return array(
           'all' => true,
           'my' => false,
         );
     }

}
