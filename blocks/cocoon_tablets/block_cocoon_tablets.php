<?php
global $CFG;

class block_cocoon_tablets extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_tablets', 'block_cocoon_tablets');
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
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;}
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;}
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;}
        if(!empty($this->config->feature_1_title)){$this->content->feature_1_title = $this->config->feature_1_title;}
        if(!empty($this->config->feature_1_subtitle)){$this->content->feature_1_subtitle = $this->config->feature_1_subtitle;}
        if(!empty($this->config->feature_1_icon)){$this->content->feature_1_icon = $this->config->feature_1_icon;}
        if(!empty($this->config->feature_2_title)){$this->content->feature_2_title = $this->config->feature_2_title;}
        if(!empty($this->config->feature_2_subtitle)){$this->content->feature_2_subtitle = $this->config->feature_2_subtitle;}
        if(!empty($this->config->feature_2_icon)){$this->content->feature_2_icon = $this->config->feature_2_icon;}
        if(!empty($this->config->feature_3_title)){$this->content->feature_3_title = $this->config->feature_3_title;}
        if(!empty($this->config->feature_3_subtitle)){$this->content->feature_3_subtitle = $this->config->feature_3_subtitle;}
        if(!empty($this->config->feature_3_icon)){$this->content->feature_3_icon = $this->config->feature_3_icon;}
        if(!empty($this->config->feature_4_title)){$this->content->feature_4_title = $this->config->feature_4_title;}
        if(!empty($this->config->feature_4_subtitle)){$this->content->feature_4_subtitle = $this->config->feature_4_subtitle;}
        if(!empty($this->config->feature_4_icon)){$this->content->feature_4_icon = $this->config->feature_4_icon;}
        if(!empty($this->config->body)){$this->content->body = $this->config->body['text'];}
        if(!empty($this->config->style)){
          if ($this->config->style == 1) {
            $this->content->style = 'ccn-tablets-left';
          } else {
            $this->content->style = 'ccn-tablets-right';
          }
        }else {
            $this->content->style = 'ccn-tablets-left';
        }

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_tablets', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image .= '
                <li class="list-inline-item"><img class="img-fluid" src="'.$url.'" alt="'.$filename.'"></li>';
            }
        }



        $this->content->text = '
        <section class="home4_about">
      		<div class="container">
      			<div class="row '.$this->content->style.'">
      				<div class="col-lg-6 col-xl-6">
      					<div class="about_home3">
      						<h3>'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h3>
      						<h5>'.format_text($this->content->subtitle, FORMAT_HTML, array('filter' => true)).'</h5>
      						'.format_text($this->content->body, FORMAT_HTML, array('filter' => true)).'
      						<a href="'.format_text($this->content->button_link, FORMAT_HTML, array('filter' => true)).'" class="btn about_btn_home3">'.format_text($this->content->button_text, FORMAT_HTML, array('filter' => true)).'</a>
      						<ul class="partners_thumb_list">
      							'.$this->content->image.'
      						</ul>
      					</div>
      				</div>
      				<div class="col-lg-6 col-xl-6">
      					<div class="row">
      						<div class="col-sm-6 col-lg-6">
      							<div class="home3_about_icon_box five">
      								<div class="icon ccn-icon-reset"><span class="'.format_text($this->content->feature_1_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
      								<div class="details">
      									<h4>'.format_text($this->content->feature_1_title, FORMAT_HTML, array('filter' => true)).'</h4>
      									<p>'.format_text($this->content->feature_1_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      								</div>
      							</div>
      						</div>
      						<div class="col-sm-6 col-lg-6">
      							<div class="home3_about_icon_box two">
      								<div class="icon ccn-icon-reset"><span class="'.format_text($this->content->feature_2_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
      								<div class="details">
      									<h4>'.format_text($this->content->feature_2_title, FORMAT_HTML, array('filter' => true)).'</h4>
      									<p>'.format_text($this->content->feature_2_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      								</div>
      							</div>
      						</div>
      						<div class="col-sm-6 col-lg-6">
      							<div class="home3_about_icon_box six">
      								<div class="icon ccn-icon-reset"><span class="'.format_text($this->content->feature_3_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
      								<div class="details">
      									<h4>'.format_text($this->content->feature_3_title, FORMAT_HTML, array('filter' => true)).'</h4>
      									<p>'.format_text($this->content->feature_3_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      								</div>
      							</div>
      						</div>
      						<div class="col-sm-6 col-lg-6">
      							<div class="home3_about_icon_box seven">
      								<div class="icon ccn-icon-reset"><span class="'.format_text($this->content->feature_4_icon, FORMAT_HTML, array('filter' => true)).'"></span></div>
      								<div class="details">
      									<h4>'.format_text($this->content->feature_4_title, FORMAT_HTML, array('filter' => true)).'</h4>
      									<p>'.format_text($this->content->feature_4_subtitle, FORMAT_HTML, array('filter' => true)).'</p>
      								</div>
      							</div>
      						</div>
      					</div>
      				</div>
      			</div>
      			<div class="row">
      				<div class="col-lg-12">
      					<div class="about_home3_shape_container">
      						<div class="about_home3_shape"><img src="'.$CFG->wwwroot.'/theme/edumy/images/about/shape1.png" alt="shape1.png"></div>
      					</div>
      				</div>
      			</div>
      		</div>
      	</section>';
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
