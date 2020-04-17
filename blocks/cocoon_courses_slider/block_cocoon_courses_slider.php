<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

//require_once($CFG->libdir. '/coursecatlib.php');
require_once($CFG->dirroot. '/course/renderer.php');

class block_cocoon_courses_slider extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_cocoon_courses_slider');
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
        if(!empty($this->config->hover_text)){$this->content->hover_text = $this->config->hover_text;}else{$this->content->hover_text = 'Preview Course';}
        if(!empty($this->config->hover_accent)){$this->content->hover_accent = $this->config->hover_accent;}else{$this->content->hover_accent = 'Best Seller';}
        if ($this->config->style == 1) {
          $this->content->text .= '
            <section class="popular-courses bgc-thm2">
          		<div class="container-fluid style2">
          			<div class="row">
          				<div class="col-lg-6 offset-lg-3">
          					<div class="main-title text-center">
          						<h3 class="mt0 color-white">'.format_text($this->content->title, FORMAT_HTML, array('filter' => true)).'</h3>
          						<p class="color-white">'.format_text($this->content->subtitle, FORMAT_HTML, array('filter' => true)).'</p>
          					</div>
          				</div>
          			</div>
          			<div class="row">
          				<div class="col-lg-12">
          					<div class="popular_course_slider">';
                    $courses = self::get_featured_courses();
                    $chelper = new coursecat_helper();
                    foreach ($courses as $course) {
                      $course = new core_course_list_element($course);
                      $courseid = $course->id;
                      $context = context_course::instance($courseid);
                      $numberofusers = count_enrolled_users($context);
                      $content = '';
                      $coursename = $chelper->get_course_formatted_name($course);
                      $coursenamelink = new moodle_url('/course/view.php', array('id' => $course->id));
                      if ($course->has_summary()) {
                        $content .= $chelper->get_course_formatted_summary($course, array('overflowdiv' => true, 'noclean' => true, 'para' => false));
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
                      $this->content->text .='
                        <div class="item">
            							<div class="top_courses home2 mb0">
            								<div class="thumb">
            									<img class="img-whp" src="'. $contentimages .'" alt="'.$coursename.'">
            									<div class="overlay">
            										<div class="tag">'.format_text($this->content->hover_accent, FORMAT_HTML, array('filter' => true)).'</div>
            										<a class="tc_preview_course" href="'. $coursenamelink .'">'.format_text($this->content->hover_text, FORMAT_HTML, array('filter' => true)).'</a>
            									</div>
            								</div>
            								<div class="details">
            									<div class="tc_content">
            										<p>Updated '.userdate($course->timemodified, get_string('strftimedatefullshort', 'langconfig'), 0).'</p>
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
            								</div>
            							</div>
            						</div>';
                      }
                  $this->content->text .= '
                           </div>
				                 </div>
			                 </div>
                     </div>
	                 </section>';
                    } else {
                      $this->content->text .= '



        <section class="features-course pb20">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="main-title text-center">
          <h3 class="mb0 mt0">'. format_text($this->content->title, FORMAT_HTML, array('filter' => true)) .'</h3>
          <p>'.format_text($this->content->subtitle, FORMAT_HTML, array('filter' => true)).'</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="shop_product_slider">';



        $courses = self::get_featured_courses();
        $chelper = new coursecat_helper();
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





            $this->content->text .='

            <div class="item">
							<div class="top_courses">
								<div class="thumb">

									<img class="img-whp" src="'. $contentimages .'" alt="'.$coursename.'">
									<div class="overlay">';
                  if(!empty($this->content->hover_accent)){
									$this->content->text .='	<div class="tag">'.format_text($this->content->hover_accent, FORMAT_HTML, array('filter' => true)).'</div>';
                  }
                    if(!empty($this->content->hover_text)){
										$this->content->text .='<a class="tc_preview_course" href="'. $coursenamelink .'">'.format_text($this->content->hover_text, FORMAT_HTML, array('filter' => true)).'</a>';
                  }
									$this->content->text .='</div>
								</div>
								<div class="details">
									<div class="tc_content">
                  <p>Updated '.userdate($course->timemodified, get_string('strftimedatefullshort', 'langconfig'), 0).'</p>
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
								</div>
							</div>
						</div>


            ';

        }



$this->content->text .= '         </div>
      </div>
    </div>
  </div>
</section>';
  }

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
                  FROM {block_cocoon_courses_slider} fc
                  JOIN {course} c
                    ON (c.id = fc.courseid)
              ORDER BY sortorder';
        return $DB->get_records_sql($sql);
    }

    public static function delete_featuredcourse($courseid) {
        global $DB;
        return $DB->delete_records('block_cocoon_courses_slider', array('courseid' => $courseid));
    }
}
