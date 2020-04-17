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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . "/course/format/topics/renderer.php");

class theme_edumy_format_topics_renderer extends format_topics_renderer {

  /**
   * Generate the starting container html for a list of sections
   * @return string HTML to output.
   */
  protected function start_section_list() {
      return html_writer::start_tag('div', array('class' => 'ccn_course_content topics'));
  }

  /**
   * Generate the closing container html for a list of sections
   * @return string HTML to output.
   */
  protected function end_section_list() {
      return html_writer::end_tag('div');
  }

  protected function section_header($section, $course, $onsectionpage, $sectionreturn=null) {
      global $PAGE;

      $o = '';
      $currenttext = '';
      $sectionstyle = '';

      if ($section->section != 0) {
          // Only in the non-general sections.
          if (!$section->visible) {
              $sectionstyle = ' hidden';
          }
          if (course_get_format($course)->is_section_current($section)) {
              $sectionstyle = ' current';
          }
      }

      $o.= html_writer::start_tag('li', array('id' => 'section-'.$section->section,
          'class' => 'section main clearfix details'.$sectionstyle, 'role'=>'region',
          'aria-label'=> get_section_name($course, $section)));

          // $o.= html_writer::start_tag('li', array('id' => 'section-'.$section->section,
          //     'class' => 'section main clearfix'.$sectionstyle, 'role'=>'region',
          //     'aria-label'=> get_section_name($course, $section)));

      $o .= '<div id="accordion" class="panel-group cc_tab">
              <div class="panel">
                <div class="panel-heading"><h4 class="panel-title">
                  <a href="#panel-'.$section->section.'" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">'.get_section_name($course, $section).'</a>
                </h4></div><div id="panel-'.$section->section.'" class="panel-collapse collapse"><div class="panel-body">';


      // Create a span that contains the section title to be used to create the keyboard section move menu.
      $o .= html_writer::tag('span', get_section_name($course, $section), array('class' => 'hidden sectionname'));

      $leftcontent = $this->section_left_content($section, $course, $onsectionpage);
      $o.= html_writer::tag('div', $leftcontent, array('class' => 'left side'));

      $rightcontent = $this->section_right_content($section, $course, $onsectionpage);
      $o.= html_writer::tag('div', $rightcontent, array('class' => 'right side'));
      $o.= html_writer::start_tag('div', array('class' => 'content'));

      // When not on a section page, we display the section titles except the general section if null
      $hasnamenotsecpg = (!$onsectionpage && ($section->section != 0 || !is_null($section->name)));

      // When on a section page, we only display the general section title, if title is not the default one
      $hasnamesecpg = ($onsectionpage && ($section->section == 0 && !is_null($section->name)));

      $classes = ' accesshide';
      if ($hasnamenotsecpg || $hasnamesecpg) {
          $classes = '';
      }
      $sectionname = html_writer::tag('span', $this->section_title($section, $course));
      $o.= $this->output->heading($sectionname, 3, 'sectionname' . $classes);

      $o .= $this->section_availability($section);

      $o .= html_writer::start_tag('div', array('class' => 'summary'));
      if ($section->uservisible || $section->visible) {
          // Show summary if section is available or has availability restriction information.
          // Do not show summary if section is hidden but we still display it because of course setting
          // "Hidden sections are shown in collapsed form".
          $o .= $this->format_summary_text($section);
      }
      $o .= html_writer::end_tag('div');

      return $o;
  }

  /**
   * Generate the display of the footer part of a section
   *
   * @return string HTML to output.
   */
  protected function section_footer() {
      $o = html_writer::end_tag('div');
      $o.= '</div></div></div></div>';
      $o.= html_writer::end_tag('li');

      return $o;
  }

}
