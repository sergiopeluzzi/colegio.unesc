<?php
global $CFG;

class block_cocoon_course_instructor extends block_base
{
    // Declare first
    public function init()
    {
        $this->title = get_string('cocoon_course_instructor', 'block_cocoon_course_instructor');
    }

    // Declare second
    public function specialization()
    {
        $this->title = isset($this->config->title) ? format_string($this->config->title) : '';
        $this->name = isset($this->config->name) ? format_string($this->config->name) : '';
        $this->position = isset($this->config->position) ? format_string($this->config->position) : '';
        $this->students = isset($this->config->students) ? format_string($this->config->students) : '';
        $this->reviews = isset($this->config->reviews) ? format_string($this->config->reviews) : '';
        $this->courses = isset($this->config->courses) ? format_string($this->config->courses) : '';
        $this->image = isset($this->config->image) ? format_string($this->config->image) : '';
        $this->bio = isset($this->config->bio) ? format_string($this->config->bio) : '';
    }

    function applicable_formats() {
        return array(
          'all' => true,
          'my' => false,
        );
    }



    public function get_content()
    {
        global $CFG, $DB;
        require_once($CFG->libdir . '/filelib.php');


        if ($this->content !== null) {
            return $this->content;
        }

        // Declare third
        $this->content         =  new stdClass;

        if(!empty($this->config->title)){$this->content->title = $this->config->title;}
        if(!empty($this->config->name)){$this->content->name = $this->config->name;}
        if(!empty($this->config->position)){$this->content->position = $this->config->position;}
        if(!empty($this->config->students)){$this->content->students = $this->config->students;}
        if(!empty($this->config->reviews)){$this->content->reviews = $this->config->reviews;}
        if(!empty($this->config->courses)){$this->content->courses = $this->config->courses;}
        if(!empty($this->config->bio)){$this->content->bio = $this->config->bio['text'];}
        if(!empty($this->config->rating)){$this->content->rating = $this->config->rating;}




        //Begin CCN Image Processing
        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_course_instructor', 'content');
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image = '<img src="' . $url . '" alt="' . $filename . '" />';
            }
        }
        // End CCN Image Processing



        $this->content->text = '
        <div class="cs_row_four">
          <div class="about_ins_container">';
          if($this->content->title){
          $this->content->text .='
            <h4 class="aii_title">'. format_text($this->content->title, FORMAT_HTML, array('filter' => true)) .'</h4>';
          }
          if($this->content->image){
          $this->content->text .='
            <div class="about_ins_info">
              <div class="thumb">'. $this->content->image .'</div>
            </div>';
          }
          $this->content->text .='
            <div class="details">';
          if($this->content->rating){
          $this->content->text .='
              <ul class="review_list">
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                <li class="list-inline-item">'.$this->content->rating.'</li>
              </ul>';
            }
            $this->content->text .='
              <ul class="about_info_list">';
            if($this->content->reviews){
              $this->content->text .='
                <li class="list-inline-item"><span class="flaticon-comment"></span> '. format_text($this->content->reviews, FORMAT_HTML, array('filter' => true)) .' </li>';
            }
            if($this->content->students){
              $this->content->text .='
                <li class="list-inline-item"><span class="flaticon-profile"></span> '. format_text($this->content->students, FORMAT_HTML, array('filter' => true)) .' </li>';
            }
            if($this->content->courses){
              $this->content->text .='
                <li class="list-inline-item"><span class="flaticon-play-button-1"></span> '. format_text($this->content->courses, FORMAT_HTML, array('filter' => true)) .' </li>';
            }
            $this->content->text .='
              </ul>';
            if($this->content->name){
            $this->content->text .='
              <h4>'. format_text($this->content->name, FORMAT_HTML, array('filter' => true)) .'</h4>';
            }
            if($this->content->position){
            $this->content->text .='
              <p class="subtitle">'. format_text($this->content->position, FORMAT_HTML, array('filter' => true)) .'</p>';
            }
            if($this->content->bio){
              $this->content->text .= format_text($this->content->bio, FORMAT_HTML, array('filter' => true));
            }
            $this->content->text .='
            </div>
          </div>
        </div>';
        return $this->content;
    }
}
