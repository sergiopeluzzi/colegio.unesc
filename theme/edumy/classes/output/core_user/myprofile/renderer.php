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

namespace theme_edumy\output\core_user\myprofile;

defined('MOODLE_INTERNAL') || die;

use \core_user\output\myprofile\category;
use core_user\output\myprofile\tree;
use core_user\output\myprofile;

class renderer extends \core_user\output\myprofile\renderer {

  public function render_tree(tree $tree) {
      global $CFG, $USER, $DB, $SESSION, $SITE, $PAGE;

      $ccn_user_id = optional_param('id', 0, PARAM_INT);
      $ccn_user_id = $ccn_user_id ? $ccn_user_id : $USER->id;       // Owner of the page.
      $ccn_page->id = $ccn_user_id;

      if(!($ccn_page->id == $USER->id)) {
        if (!isset($SESSION->theme_edumy_counter)) {
          $SESSION->theme_edumy_counter = array();
        }
        if (!isset($SESSION->theme_edumy_counter[$ccn_page->id])) {
          $SESSION->theme_edumy_counter[$ccn_page->id] = array();
        }

        $ccn_ip = getremoteaddr();
        $ccn_time_difference = 0;

        if (!isset($SESSION->theme_edumy_counter[$ccn_page->id]['time'])) {
          $sql = "SELECT MAX(time) AS mintime FROM {$CFG->prefix}theme_edumy_counter
              WHERE course = {$ccn_page->id}
              AND ip = '$ccn_ip'";

          $time = $DB->get_record_sql($sql);

          $SESSION->theme_edumy_counter[$ccn_page->id]['time'] = $time && $time->mintime ? $time->mintime : 0;
        }

        $ccn_increase = false;

        if ($SESSION->theme_edumy_counter[$ccn_page->id]['time'] < (time() - $ccn_time_difference)) {
          $dataobject = new \stdClass();
          $dataobject->ip = $ccn_ip;
          $dataobject->course = $ccn_page->id;
          $dataobject->time = time();
          $DB->insert_record('theme_edumy_counter', $dataobject, false);
          $SESSION->theme_edumy_counter[$ccn_page->id]['time'] = time();
          $ccn_increase = true;
        }

        // $stats = $DB->get_record('theme_edumy_stats', array('course' => $ccn_page->id));
        // if (!$stats) {
        //   $stats = new \stdClass();
        //   $stats->course = $ccn_page->id;
        //   $stats->time = time();
        //   $stats->currenttime = 0;
        //   $stats->sum = 0;
        //   $stats->id = $DB->insert_record('theme_edumy_stats', $stats, true);
        // }
        //
        // // Count the view
        //
        // if ($ccn_increase) {
        //     $stats->sum++;
        // }

        // $count = $stats->sum;
        //
        // $timestamp = strtotime("-1 week");
        //
        // $table = 'theme_edumy_counter';
        // $conditions = array('course'=>$ccn_page->id);
        //
        // $dayone = strtotime("-1 day");
        //
        // $csx = $DB->get_records($table,array('course'=>$ccn_page->id),$fields='course,time');
        //
        // $ccnmethodsa = array_column($csx, null, "time");
        //
        // $visits = array_keys($ccnmethodsa);
        // foreach ($visits as $visit) {
        //   $dates = date('m/d/Y', $visit);
        //   $cdates[] = array('date' => $dates);
        // }
        //
        // $visitArray = array_count_values(array_column($cdates, 'date'));
        // $visitArrayR = array_reverse($visitArray);
        //
        // print_object($visitArrayR);

      }

      $return = \html_writer::start_tag('div', array('class' => 'ccn_col_tree'));
      $categories = $tree->categories;
      foreach ($categories as $category) {
          $return .= $this->render($category);
      }
      $return .= \html_writer::end_tag('div');
      return $return;
  }
  public function render_category(category $category) {
      $classes = $category->classes;
      if (empty($classes)) {
          $return = \html_writer::start_tag('section', array('class' => 'ccn_col_branch'));
      } else {
          $return = \html_writer::start_tag('section', array('class' => 'ccn_col_branch ' . $classes));
      }
      $return .= \html_writer::tag('h3', $category->title);
      $nodes = $category->nodes;
      if (empty($nodes)) {
          // No nodes, nothing to render.
          return '';
      }
      $return .= \html_writer::start_tag('ul');
      foreach ($nodes as $node) {
          $return .= $this->render($node);
      }
      $return .= \html_writer::end_tag('ul');
      $return .= \html_writer::end_tag('section');
      return $return;
  }
}
