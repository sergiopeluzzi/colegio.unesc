<?php
global $CFG;

class block_cocoon_gallery extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_gallery', 'block_cocoon_gallery');
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
        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_gallery', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image .= '
                <div class="col-sm-6 col-md-6 col-lg-3">
					<div class="gallery_item">
						<img class="img-fluid img-circle-rounded w100" src="' . $url . '" alt="' . $filename . '">
						<div class="gallery_overlay"><a class="ccn-icon popup-img" href="' . $url . '"><span class="flaticon-zoom-in"></span></a></div>
					</div>
          </div>
				';
            }
        }



        $this->content->text = '


        <section class="about-section pb30">
      		<div class="container">
      			<div class="row">
'. $this->content->image .'
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
