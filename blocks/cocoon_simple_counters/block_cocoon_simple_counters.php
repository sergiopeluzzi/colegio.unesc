<?php
global $CFG;

class block_cocoon_simple_counters extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_simple_counters', 'block_cocoon_simple_counters');
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
        if(!empty($this->config->counter_1)){$this->content->counter_1 = $this->config->counter_1;}
        if(!empty($this->config->counter_1_text)){$this->content->counter_1_text = $this->config->counter_1_text;}
        if(!empty($this->config->counter_2)){$this->content->counter_2 = $this->config->counter_2;}
        if(!empty($this->config->counter_2_text)){$this->content->counter_2_text = $this->config->counter_2_text;}
        if(!empty($this->config->counter_3)){$this->content->counter_3 = $this->config->counter_3;}
        if(!empty($this->config->counter_3_text)){$this->content->counter_3_text = $this->config->counter_3_text;}
        if(!empty($this->config->counter_4)){$this->content->counter_4 = $this->config->counter_4;}
        if(!empty($this->config->counter_4_text)){$this->content->counter_4_text = $this->config->counter_4_text;}


        $this->content->text = '
        <div class="container">
        <div class="row mb60">
  <div class="col-lg-12 text-center mt60">
    <h3 class="fz26">'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h3>
  </div>
  <div class="col-lg-9 text-center mt40 offset-lg-2">
    <div class="row ccn-simple-facts">
      <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
        <div class="funfact_two text-left">
          <div class="details">
            <h5>'.format_text($this->content->counter_1_text, FORMAT_HTML, array('filter' => true)).'</h5>
            <div class="timer">'.format_text($this->content->counter_1, FORMAT_HTML, array('filter' => true)).'</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
        <div class="funfact_two text-left">
          <div class="details">
            <h5>'.format_text($this->content->counter_2_text, FORMAT_HTML, array('filter' => true)).'</h5>
            <div class="timer">'.format_text($this->content->counter_2, FORMAT_HTML, array('filter' => true)).'</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
        <div class="funfact_two text-left">
          <div class="details">
            <h5>'.format_text($this->content->counter_3_text, FORMAT_HTML, array('filter' => true)).'</h5>
            <div class="timer">'.format_text($this->content->counter_3, FORMAT_HTML, array('filter' => true)).'</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
        <div class="funfact_two text-left">
          <div class="details">
            <h5>'.format_text($this->content->counter_4_text, FORMAT_HTML, array('filter' => true)).'</h5>
            <div class="timer">'.format_text($this->content->counter_4, FORMAT_HTML, array('filter' => true)).'</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
';
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
