<?php
global $CFG;

class block_cocoon_gallery_slider extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_gallery_slider', 'block_cocoon_gallery_slider');
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
        if(!empty($this->config->title)){$this->content->title = $this->config->title;}else{$this->content->title = 'Media';}
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;}else{$this->content->subtitle = 'Cum doctus civibus efficiantur in imperdiet deterruisset.';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_gallery_slider', 'content');
        $this->content->image = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image .= '
                <div class="item">
                							<div class="media_item_box">
                								<div class="thumb"><img class="img-fluid img-rounded" src="'.$url.'" alt="'. $filename .'"></div>
                							</div>
                						</div>				';
            }
        }



        $this->content->text = '


        <section class="our-media">
		<div class="container-fluid p0">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h3 class="mt0">'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h3>
						<p>'.format_text($this->content->subtitle, FORMAT_HTML, array('filter' => true)).'</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="media_slider_home7">

'. $this->content->image .'
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
