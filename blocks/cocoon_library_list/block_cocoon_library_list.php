<?php

include_once($CFG->dirroot . '/course/lib.php');
//require_once($CFG->libdir . '/coursecatlib.php');

class block_cocoon_library_list extends block_list {
    function init() {
        $this->title = get_string('pluginname', 'block_cocoon_library_list');
    }

    function has_config() {
        return true;
    }

    function applicable_formats() {
        return array('all' => true, 'my' => false, 'tag' => false);
    }

    function instance_allow_config() {
        return true;
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;

        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $icon = $OUTPUT->pix_icon('i/course', get_string('course'));

        $adminseesall = true;
        if (isset($CFG->block_cocoon_library_list_adminview)) {
           if ( $CFG->block_cocoon_library_list_adminview == 'own'){
               $adminseesall = false;
           }
        }

        $allcourselink =
            (has_capability('moodle/course:update', context_system::instance())
            || empty($CFG->block_cocoon_library_list_hideallcourseslink)) &&
            core_course_category::user_top();

        if (empty($CFG->disablemycourses) and isloggedin() and !isguestuser() and
          !(has_capability('moodle/course:update', context_system::instance()) and $adminseesall)) {    // Just print My Courses
            if ($courses = enrol_get_my_courses()) {
                foreach ($courses as $course) {
                    $coursecontext = context_course::instance($course->id);
                    $linkcss = $course->visible ? "" : " class=\"dimmed\" ";
                    $this->content->items[]="<a $linkcss title=\"" . format_string($course->shortname, true, array('context' => $coursecontext)) . "\" ".
                               "href=\"$CFG->wwwroot/course/view.php?id=$course->id\">".$icon.format_string(get_course_display_name_for_list($course)). "</a>";
                }
                $this->title = get_string('mycourses');
            /// If we can update any course of the view all isn't hidden, show the view all courses link
                if ($allcourselink) {
                    $this->content->footer = "<a href=\"$CFG->wwwroot/course/index.php\">".get_string("fulllistofcourses")."</a> ...";
                }
            }
            $this->get_remote_courses();
            if ($this->content->items) { // make sure we don't return an empty list
                return $this->content;
            }
        }

        // User is not enrolled in any courses, show list of available categories or courses (if there is only one category).
    /*    $topcategory = core_course_category::top();
        if ($topcategory->is_uservisible() && ($categories = $topcategory->get_children())) { // Check we have categories.
            if (count($categories) > 1 || (count($categories) == 1 && $DB->count_records('course') > 200)) {     // Just print top level category links
                foreach ($categories as $category) {
                    $categoryname = $category->get_formatted_name();
                    $linkcss = $category->visible ? "" : " class=\"dimmed\" ";
                    $this->content->items[]="<a $linkcss href=\"$CFG->wwwroot/course/index.php?categoryid=$category->id\">".$icon . $categoryname . "</a>";
                }
            /// If we can update any course of the view all isn't hidden, show the view all courses link
                if ($allcourselink) {
                    $this->content->footer .= "<a href=\"$CFG->wwwroot/course/index.php\">".get_string('fulllistofcourses').'</a> ...';
                }
                $this->title = get_string('categories');
            } else {                          // Just print course names of single category
                $category = array_shift($categories);
                $courses = $category->get_courses();

                if ($courses) {
                    foreach ($courses as $course) {
                        $coursecontext = context_course::instance($course->id);
                        $linkcss = $course->visible ? "" : " class=\"dimmed\" ";

                        $this->content->items[]= '
                        <a href="'.$CFG->wwwroot .'/course/view.php?id='.$course->id.'"><div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck15">
                          <label class="custom-control-label" for="customCheck15">'. $course->get_formatted_name() .' <span class="float-right">(15)</span></label>
                        </div></a>';
                    }
                /// If we can update any course of the view all isn't hidden, show the view all courses link
                     if ($allcourselink) {
                        $this->content->footer .= "<a href=\"$CFG->wwwroot/course/index.php\">".get_string('fulllistofcourses').'</a> ...';
                    }
                    $this->get_remote_courses();
                  }
                } else {

                    $this->content->icons[] = '';
                    $this->content->items[] = get_string('nocoursesyet');
                    if (has_capability('moodle/course:create', context_coursecat::instance($category->id))) {
                        $this->content->footer = '<a href="'.$CFG->wwwroot.'/course/edit.php?category='.$category->id.'">'.get_string("addnewcourse").'</a> ...';
                    }
                    $this->get_remote_courses();
                }
                $this->title = get_string('courses');
            }
        } */



        //

        $this->content->footer = '


          <ul id="vertical-menu" class="mega-vertical-menu nav navbar-nav">';


          $topcategory = core_course_category::top();
          if ($topcategory->is_uservisible() && ($categories = $topcategory->get_children())) { // Check we have categories.
              if (count($categories) > 1 || (count($categories) == 1 && $DB->count_records('course') > 200)) {     // Just print top level category links
                  foreach ($categories as $category) {
                    $children_courses = $category->get_courses();
                  //  print_object($children_courses);

                    foreach($children_courses as $child_course) {
                      if ($child_course === reset($children_courses)) {
                      foreach ($child_course->get_course_overviewfiles() as $file) {
    if ($file->is_valid_image()) {
        $imagepath = '/' . $file->get_contextid() .
                '/' . $file->get_component() .
                '/' . $file->get_filearea() .
                $file->get_filepath() .
                $file->get_filename();
        $imageurl = file_encode_url($CFG->wwwroot . '/pluginfile.php', $imagepath,
                false);
        $outputimage  =  $imageurl;
        // Use the first image found.
        break;
    }
}
}
                    }
                      $categoryname = $category->get_formatted_name();
                      $linkcss = $category->visible ? "" : " class=\"dimmed\" ";
                      $this->content->footer .= '
                      <li><a href="'.$CFG->wwwroot .'/course/index.php?categoryid='.$category->id.'">'. $categoryname .'</a></li>';

                  }
}

} else {                          // Just print course names of single category
    $category = array_shift($categories);
    $courses = $category->get_courses();

    if ($courses) {
        foreach ($courses as $course) {
            $coursecontext = context_course::instance($course->id);
            $linkcss = $course->visible ? "" : " class=\"dimmed\" ";

            $this->content->footer .= '
            <li><a href="'.$CFG->wwwroot .'/course/view.php?id='.$course->id.'">'. $course->get_formatted_name() .' <span class="float-right">()</span></a></li>

            ';
        }
      }
}


$this->content->footer .='
</ul>
';


        return $this->content;
    }

    function get_remote_courses() {
        global $CFG, $USER, $OUTPUT;

        if (!is_enabled_auth('mnet')) {
            // no need to query anything remote related
            return;
        }

        $icon = $OUTPUT->pix_icon('i/mnethost', get_string('host', 'mnet'));

        // shortcut - the rest is only for logged in users!
        if (!isloggedin() || isguestuser()) {
            return false;
        }

        if ($courses = get_my_remotecourses()) {
            $this->content->items[] = get_string('remotecourses','mnet');
            $this->content->icons[] = '';
            foreach ($courses as $course) {
                $this->content->items[]="<a title=\"" . format_string($course->shortname, true) . "\" ".
                    "href=\"{$CFG->wwwroot}/auth/mnet/jump.php?hostid={$course->hostid}&amp;wantsurl=/course/view.php?id={$course->remoteid}\">"
                    .$icon. format_string(get_course_display_name_for_list($course)) . "</a>";
            }
            // if we listed courses, we are done
            return true;
        }

        if ($hosts = get_my_remotehosts()) {
            $this->content->items[] = get_string('remotehosts', 'mnet');
            $this->content->icons[] = '';
            foreach($USER->mnet_foreign_host_array as $somehost) {
                $this->content->items[] = $somehost['count'].get_string('courseson','mnet').'<a title="'.$somehost['name'].'" href="'.$somehost['url'].'">'.$icon.$somehost['name'].'</a>';
            }
            // if we listed hosts, done
            return true;
        }

        return false;
    }

    /**
     * Returns the role that best describes the course list block.
     *
     * @return string
     */
    public function get_aria_role() {
        return 'navigation';
    }
}
