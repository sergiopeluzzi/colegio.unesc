<?php

defined('MOODLE_INTERNAL') || die();

//require_once($CFG->libdir. '/coursecatlib.php');
require_once($CFG->dirroot. '/course/renderer.php');

class block_cocoon_featuredcourses extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_cocoon_featuredcourses');
    }

    public function get_content() {
        global $CFG;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
        $this->content->text = '';
        if(!empty($this->config->title)){$this->content->title = $this->config->title;}
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;}
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;}
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;}
        if(!empty($this->config->hover_text)){$this->content->hover_text = $this->config->hover_text;}else{$this->content->hover_text = 'Preview Course';}
        if(!empty($this->config->hover_accent)){$this->content->hover_accent = $this->config->hover_accent;}else{$this->content->hover_accent = 'Best Seller';}

        $this->content-> text .= '



        <section id="our-top-courses" class="our-courses">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="main-title text-center">
          <h3 class="mt0">'. format_text($this->content->title, FORMAT_HTML, array('filter' => true)) .'</h3>
          <p>'.format_text($this->content->subtitle, FORMAT_HTML, array('filter' => true)).'</p>
        </div>
      </div>
    </div>
    <div class="row">
';



        $courses = self::get_featured_courses();
        $chelper = new coursecat_helper();
        $total_courses = count($courses);

        if($total_courses < 2) {
          $col_class = 'col-md-12';
        } else if($total_courses == 2) {
          $col_class = 'col-md-6';
        } else if($total_courses == 3) {
          $col_class = 'col-md-4';
        } else  {
          $col_class = 'col-md-6 col-lg-4 col-xl-3';
        }

        foreach ($courses as $course) {

            $course = new core_course_list_element($course);
$courseid = $course->id;
$context = context_course::instance($courseid);
$numberofusers = count_enrolled_users($context);


            $content = '';

            $coursename = $chelper->get_course_formatted_name($course);


            $coursenamelink = new moodle_url('/course/view.php', array('id' => $course->id));

            if ($course->has_summary()) {
                $content .= $chelper->get_course_formatted_summary($course,
                        array('overflowdiv' => true, 'noclean' => true, 'para' => false));
            }

            // Display course overview files.
            $contentimages = $contentfiles = '';
            foreach ($course->get_course_overviewfiles() as $file) {
                $isimage = $file->is_valid_image();
                $url = file_encode_url("{$CFG->wwwroot}/pluginfile.php",
                        '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                        $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                if ($isimage) {
                    $contentimages .= $url;
                } else {
                    $image = $this->output->pix_icon(file_file_icon($file, 24), $file->get_filename(), 'moodle');
                    $filename = html_writer::tag('span', $image, array('class' => 'fp-icon')).
                            html_writer::tag('span', $file->get_filename(), array('class' => 'fp-filename'));
                    $contentfiles .= html_writer::tag('span',
                            html_writer::link($url, $filename),
                            array('class' => 'coursefile fp-filename-icon'));
                }
            }



            if(!empty($this->config->hover_text)){$this->content->hover_text = $this->config->hover_text;}
            if(!empty($this->config->hover_accent)){$this->content->hover_accent = $this->config->hover_accent;}

            $this->content->text .='

            <div class="'.$col_class.'">
							<div class="top_courses">
              <a href="'. $coursenamelink .'">
								<div class="thumb">
									<img class="img-whp" src="'. $contentimages .'" alt="'.$coursename.'">
									<div class="overlay">
										<div class="tag">'.format_text($this->content->hover_accent, FORMAT_HTML, array('filter' => true)).'</div>
										<span class="tc_preview_course">'.format_text($this->content->hover_text, FORMAT_HTML, array('filter' => true)).'</span>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
                  <p>'.get_string('updated', 'theme_edumy').' '.userdate($course->timemodified, get_string('strftimedatefullshort', 'langconfig'), 0).'</p>
										<h5>'. $coursename .'</h5>
										<ul class="tc_review">
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										</ul>
									</div>
									<div class="tc_footer">
										<ul class="tc_meta float-left">
											<li class="list-inline-item"><i class="flaticon-profile"></i></li>
											<li class="list-inline-item">'. $numberofusers .'</li>
											<li class="list-inline-item"><i class="flaticon-comment"></i></li>
											<li class="list-inline-item">'.$course->newsitems.'</li>
										</ul>
									</div>
								</div></a>
							</div>
						</div>


            ';

        }



$this->content-> text .= '        <div class="col-lg-6 offset-lg-3">
					<div class="courses_all_btn text-center">
						<a class="btn btn-transparent" href="'.format_text($this->content->button_link, FORMAT_HTML, array('filter' => true)).'">'.format_text($this->content->button_text, FORMAT_HTML, array('filter' => true)).'</a>
					</div>
				</div>
 			</div>
		</div>
	</section>

';

        return $this->content;
    }

    function applicable_formats() {
        return array(
          'all' => true,
          'my' => false,
        );
    }


    public function instance_allow_multiple() {
          return false;
    }

    public function has_config() {
        return false;
    }

    public function cron() {
        return true;
    }

    public static function get_featured_courses() {
        global $DB;

        $sql = 'SELECT c.id, c.shortname, c.fullname, fc.sortorder
                  FROM {block_cocoon_featuredcourses} fc
                  JOIN {course} c
                    ON (c.id = fc.courseid)
              ORDER BY sortorder';
        return $DB->get_records_sql($sql);
    }

    public static function delete_cocoon_featuredcourse($courseid) {
        global $DB;
        return $DB->delete_records('block_cocoon_featuredcourses', array('courseid' => $courseid));
    }
}
