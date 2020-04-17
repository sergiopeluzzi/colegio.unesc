<?php
global $CFG;
class block_cocoon_course_intro extends block_base {
    public function init() { $this->title = get_string('cocoon_course_intro', 'block_cocoon_course_intro'); }
    public function specialization() { $this->title = isset($this->config->title) ? format_string($this->config->title) : ''; }
    public function get_content() {
        global $CFG, $DB;
        global $COURSE;
        $courseid = $COURSE->id;
        $context = context_course::instance($courseid);
        require_once($CFG->libdir . '/behat/lib.php');
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        if(!empty($this->config->title)){$this->content->title = $this->config->title;}
        if(!empty($this->config->teacher)){$this->content->teacher = $this->config->teacher;}
        if(!empty($this->config->accent)){$this->content->accent = $this->config->accent;}
        if(!empty($this->config->video)){$this->content->video = $this->config->video;}
        if(!empty($this->config->style)){$this->content->style = $this->config->style;}
        if(!empty($this->config->rating)){$this->content->rating = $this->config->rating;}
        $cocoon_share_fb = 'https://www.facebook.com/sharer/sharer.php?u='. $this->page->url;
        if(!empty($this->content->style) && $this->content->style == 1){
          $white = 'color-white';
          $breadcrumb = 'ccn-pullto-breadcrumb';
        } elseif(!empty($this->content->style) && $this->content->style == 2){
          $white = 'color-white';
          $breadcrumb = 'ccn-pullto-breadcrumb-fullwidth';
        } else {
          $white = '';
          $breadcrumb = '';
        }
        //Begin CCN Image Processing
        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_cocoon_course_intro', 'content');
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if ($filename <> '.') {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                $this->content->image = '<img class="thumb" src="' . $url . '" alt="' . $filename . '" />';
            }
        }
        // End CCN Image Processing

        $this->content->text = '
          <div class="cs_row_one '.$breadcrumb.'">
            <div class="cs_ins_container">
              <div class="ccn-identify-course-intro">
                <div class="cs_instructor">
                  <ul class="cs_instrct_list float-left mb0">';
                  if(!empty($this->config->image)) {
                   $this->content->text .='
                    <li class="list-inline-item">'. $this->content->image .'</li>';
                  }
                  $this->content->text .='
                    <li class="list-inline-item"><a class="'.$white.'">'. format_text($this->content->teacher, FORMAT_HTML, array('filter' => true)) .'</a></li>
                    <li class="list-inline-item"><a class="'.$white.'">'.get_string('last_updated', 'theme_edumy').' '. userdate($COURSE->timemodified, get_string('strftimedate', 'langconfig'), 0) .'</a></li>
                  </ul>
                  <ul class="cs_watch_list float-right mb0">
                    <li class="list-inline-item"><a class="'.$white.'" target="_blank" href="'.$cocoon_share_fb.'"><span class="flaticon-share"> '.get_string('share','theme_edumy').'</span></a></li>
                  </ul>
                </div>
                <h3 class="cs_title '.$white.'">'. $COURSE->fullname .'</h3>
                <ul class="cs_review_seller">';
                  if(!empty($this->content->accent)) {
                    $this->content->text .='
                    <li class="list-inline-item"><a href="#"><span>'. format_text($this->content->accent, FORMAT_HTML, array('filter' => true)) .'</span></a></li>';
                  }
                  if(!empty($this->content->rating)) {
                  $this->content->text .='
                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                    <li class="list-inline-item"><i class="fa fa-star"></i></li>';
                  }
                  $this->content->text .='
                </ul>
                <ul class="cs_review_enroll">
                  <li class="list-inline-item"><a class="'.$white.'" href="#"><span class="flaticon-profile"></span> '. count_enrolled_users($context) .' '.get_string('students_enrolled', 'theme_edumy').'</a></li>
                  <li class="list-inline-item"><a class="'.$white.'" href="#"><span class="flaticon-comment"></span> '. $COURSE->newsitems .' '.get_string('topics', 'theme_edumy').'</a></li>
                </ul>
              </div>';
              if(!empty($this->content->video)) {
                $this->content->text .='
              <div class="courses_big_thumb">
                <div class="thumb">
                  <iframe class="iframe_video" src="'.format_text($this->content->video, FORMAT_HTML, array('filter' => true)).'" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>';
              }
              $this->content->text .='
            </div>
          </div>';
        return $this->content;
    }

    public function instance_allow_multiple() {
          return true;
    }
    function applicable_formats() {
        return array(
          'all' => true,
          'my' => false,
        );
    }


}
