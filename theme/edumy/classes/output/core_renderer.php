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

namespace theme_edumy\output;

defined('MOODLE_INTERNAL') || die;
use action_link;
use action_menu;
use action_menu_filler;
use action_menu_link_secondary;
use block_contents;
use block_move_target;
use coding_exception;
use context_course;
use context_system;
use core_text;
use custom_menu;
use custom_menu_item;
use html_writer;
use moodle_page;
use moodle_url;
use navigation_node;
use pix_icon;
use stdClass;
require_once($CFG->dirroot."/course/format/lib.php");

class core_renderer extends \core_renderer {


  /**
   * Return the image URL, if any.
   *
   * Note that maximum sizes are not applied to the image.
   *
   * @param int $maxwidth The maximum width, or null when the maximum width does not matter.
   * @param int $maxheight The maximum height, or null when the maximum height does not matter.
   * @return moodle_url|false
   */
  public function get_theme_image_headerlogo1($maxwidth = null, $maxheight = 100) {
      global $CFG;
      if (!empty($this->page->theme->settings->headerlogo1)) {
          $url = $this->page->theme->setting_file_url('headerlogo1', 'headerlogo1');
          // Get a URL suitable for moodle_url.
          $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
          $url = str_replace($relativebaseurl, '', $url);
          return new moodle_url($url);
          return parent::get_theme_image_headerlogo1($maxwidth, $maxheight);
      }

  }
  public function get_theme_image_headerlogo2($maxwidth = null, $maxheight = 100) {
      global $CFG;
      if (!empty($this->page->theme->settings->headerlogo2)) {
          $url = $this->page->theme->setting_file_url('headerlogo2', 'headerlogo2');
          // Get a URL suitable for moodle_url.
          $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
          $url = str_replace($relativebaseurl, '', $url);
          return new moodle_url($url);
          return parent::get_theme_image_headerlogo2($maxwidth, $maxheight);
      }

  }
  public function get_theme_image_headerlogo3($maxwidth = null, $maxheight = 100) {
      global $CFG;
      if (!empty($this->page->theme->settings->headerlogo3)) {
          $url = $this->page->theme->setting_file_url('headerlogo3', 'headerlogo3');
          // Get a URL suitable for moodle_url.
          $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
          $url = str_replace($relativebaseurl, '', $url);
          return new moodle_url($url);
          return parent::get_theme_image_headerlogo3($maxwidth, $maxheight);
      }

  }
  public function get_theme_image_footerlogo1($maxwidth = null, $maxheight = 100) {
      global $CFG;
      if (!empty($this->page->theme->settings->footerlogo1)) {
          $url = $this->page->theme->setting_file_url('footerlogo1', 'footerlogo1');
          // Get a URL suitable for moodle_url.
          $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
          $url = str_replace($relativebaseurl, '', $url);
          return new moodle_url($url);
          return parent::get_theme_image_footerlogo1($maxwidth, $maxheight);
      }

  }
  public function get_theme_image_heading_bg($maxwidth = null, $maxheight = 100) {
      global $CFG;
      if (!empty($this->page->theme->settings->heading_bg)) {
          $url = $this->page->theme->setting_file_url('heading_bg', 'heading_bg');
          // Get a URL suitable for moodle_url.
          $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
          $url = str_replace($relativebaseurl, '', $url);
          return new moodle_url($url);
          return parent::get_theme_image_heading_bg($maxwidth, $maxheight);
      }

  }



  /**
   * Renders a custom menu object (located in outputcomponents.php)
   *
   * The custom menu this method produces makes use of the YUI3 menunav widget
   * and requires very specific html elements and classes.
   *
   * @staticvar int $menucount
   * @param custom_menu $menu
   * @return string
   */
  protected function render_custom_menu(custom_menu $menu) {
      global $CFG;

      $langs = get_string_manager()->get_list_of_translations();
      $haslangmenu = $this->lang_menu() != '';

      if (!$menu->has_children() && !$haslangmenu) {
          return '';
      }

      if ($haslangmenu) {
          $strlang = get_string('language');
          $currentlang = current_language();
          if (isset($langs[$currentlang])) {
              $currentlang = $langs[$currentlang];
          } else {
              $currentlang = $strlang;
          }
          $this->language = $menu->add($currentlang, new moodle_url('#'), $strlang, 10000);
          foreach ($langs as $langtype => $langname) {
              $this->language->add($langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
          }
      }

      $content = '';
      foreach ($menu->get_children() as $item) {
          $context = $item->export_for_template($this);
          $content .= $this->render_from_template('core/custom_menu_item', $context);
      }

      return $content;
  }

  /**
   * The standard tags (typically performance information and validation links,
   * if we are in developer debug mode) that should be output in the footer area
   * of the page. Designed to be called in theme layout.php files.
   *
   * @return string HTML fragment.
   */
  public function standard_footer_html() {
global $CFG, $SCRIPT;

$output = '';
if (during_initial_install()) {
    // Debugging info can not work before install is finished,
    // in any case we do not want any links during installation!
    return $output;
}

// Give plugins an opportunity to add any footer elements.
// The callback must always return a string containing valid html footer content.
$pluginswithfunction = get_plugins_with_function('standard_footer_html', 'lib.php');
foreach ($pluginswithfunction as $plugins) {
    foreach ($plugins as $function) {
        $output .= $function();
    }
}

// This function is normally called from a layout.php file in {@link core_renderer::header()}
// but some of the content won't be known until later, so we return a placeholder
// for now. This will be replaced with the real content in {@link core_renderer::footer()}.
$output .= $this->unique_performance_info_token;
if ($this->page->devicetypeinuse == 'legacy') {
    // The legacy theme is in use print the notification
    $output .= html_writer::tag('div', get_string('legacythemeinuse'), array('class'=>'legacythemeinuse'));
}

// Get links to switch device types (only shown for users not on a default device)
$output .= $this->theme_switch_links();

if (!empty($CFG->debugpageinfo)) {
    $output .= '<div class="performanceinfo pageinfo">' . get_string('pageinfodebugsummary', 'core_admin',
        $this->page->debug_summary()) . '</div>';
}
if (debugging(null, DEBUG_DEVELOPER) and has_capability('moodle/site:config', context_system::instance())) {  // Only in developer mode
    // Add link to profiling report if necessary
    if (function_exists('profiling_is_running') && profiling_is_running()) {
        $txt = get_string('profiledscript', 'admin');
        $title = get_string('profiledscriptview', 'admin');
        $url = $CFG->wwwroot . '/admin/tool/profiling/index.php?script=' . urlencode($SCRIPT);
        $link= '<a title="' . $title . '" href="' . $url . '">' . $txt . '</a>';
        $output .= '<div class="profilingfooter">' . $link . '</div>';
    }
    $purgeurl = new moodle_url('/admin/purgecaches.php', array('confirm' => 1,
        'sesskey' => sesskey(), 'returnurl' => $this->page->url->out_as_local_url(false)));
    $output .= '<li class="list-inline-item"><div class="purgecaches">' .
            html_writer::link($purgeurl, get_string('purgecaches', 'admin')) . '</div></li>';
}
if (!empty($CFG->debugvalidators)) {
    // NOTE: this is not a nice hack, $PAGE->url is not always accurate and $FULLME neither, it is not a bug if it fails. --skodak
    $output .= '<div class="validators"><ul class="list-unstyled ml-1">
      <li><a href="http://validator.w3.org/check?verbose=1&amp;ss=1&amp;uri=' . urlencode(qualified_me()) . '">Validate HTML</a></li>
      <li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=-1&amp;url1=' . urlencode(qualified_me()) . '">Section 508 Check</a></li>
      <li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=0&amp;warnp2n3e=1&amp;url1=' . urlencode(qualified_me()) . '">WCAG 1 (2,3) Check</a></li>
    </ul></div>';
}
return $output;


  }


  /**
   * Returns standard main content placeholder.
   * Designed to be called in theme layout.php files.
   *
   * @return string HTML fragment.
   */
  public function main_content() {
      // This is here because it is the only place we can inject the "main" role over the entire main content area
      // without requiring all theme's to manually do it, and without creating yet another thing people need to
      // remember in the theme.
      // This is an unfortunate hack. DO NO EVER add anything more here.
      // DO NOT add classes.
      // DO NOT add an id.
      return $this->unique_main_content_token;
  }





  public function user_menu($user = null, $withlinks = null) {
      global $USER, $CFG;
      require_once($CFG->dirroot . '/user/lib.php');

      if (is_null($user)) {
          $user = $USER;
      }

      // Note: this behaviour is intended to match that of core_renderer::login_info,
      // but should not be considered to be good practice; layout options are
      // intended to be theme-specific. Please don't copy this snippet anywhere else.
      if (is_null($withlinks)) {
          $withlinks = empty($this->page->layout_options['nologinlinks']);
      }

      // Add a class for when $withlinks is false.
      $usermenuclasses = 'usermenu';
      if (!$withlinks) {
          $usermenuclasses .= ' withoutlinks';
      }

      $returnstr = "";

      // If during initial install, return the empty return string.
      if (during_initial_install()) {
          return $returnstr;
      }

      $loginpage = $this->is_login_page();
      $loginurl = get_login_url();
      // If not logged in, show the typical not-logged-in string.
      if (!isloggedin()) {
          $returnstr = get_string('loggedinnot', 'moodle');
          if (!$loginpage) {
              $returnstr .= " (<a href=\"$loginurl\">" . get_string('login') . '</a>)';
          }
          return html_writer::div(
              html_writer::span(
                  $returnstr,
                  'login'
              ),
              $usermenuclasses
          );

      }

      // If logged in as a guest user, show a string to that effect.
      if (isguestuser()) {
          $returnstr = get_string('loggedinasguest');
          if (!$loginpage && $withlinks) {
              $returnstr .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
          }

          return html_writer::div(
              html_writer::span(
                  $returnstr,
                  'login'
              ),
              $usermenuclasses
          );
      }

      // Get some navigation opts.
      $opts = user_get_user_navigation_info($user, $this->page);

      $avatarclasses = "avatars";
      $avatarcontents = html_writer::span($opts->metadata['useravatar'], 'avatar current');
      $usertextcontents = $opts->metadata['userfullname'];

      // Other user.
      if (!empty($opts->metadata['asotheruser'])) {
          $avatarcontents .= html_writer::span(
              $opts->metadata['realuseravatar'],
              'avatar realuser'
          );
          $usertextcontents = $opts->metadata['realuserfullname'];
          $usertextcontents .= html_writer::tag(
              'span',
              get_string(
                  'loggedinas',
                  'moodle',
                  html_writer::span(
                      $opts->metadata['userfullname'],
                      'value'
                  )
              ),
              array('class' => 'meta viewingas')
          );
      }

      // Role.
      if (!empty($opts->metadata['asotherrole'])) {
          $role = core_text::strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['rolename'])));
          $usertextcontents .= html_writer::span(
              $opts->metadata['rolename'],
              'meta role role-' . $role
          );
      }

      // User login failures.
      if (!empty($opts->metadata['userloginfail'])) {
          $usertextcontents .= html_writer::span(
              $opts->metadata['userloginfail'],
              'meta loginfailures'
          );
      }

      // MNet.
      if (!empty($opts->metadata['asmnetuser'])) {
          $mnet = strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['mnetidprovidername'])));
          $usertextcontents .= html_writer::span(
              $opts->metadata['mnetidprovidername'],
              'meta mnet mnet-' . $mnet
          );
      }

      $returnstr .= html_writer::span(
          html_writer::span($usertextcontents, 'usertext mr-1') .
          html_writer::span($avatarcontents, $avatarclasses),
          'userbutton'
      );

      // Create a divider (well, a filler).
      $divider = new action_menu_filler();
      $divider->primary = false;

      $am = new action_menu();
      $am->set_menu_trigger(
          $returnstr
      );
      $am->set_action_label(get_string('usermenu'));
      $am->set_alignment(action_menu::TR, action_menu::BR);
      $am->set_nowrap_on_items();
      $ccn_nav_items = '';
      if ($withlinks) {
          $navitemcount = count($opts->navitems);
          $idx = 0;
          foreach ($opts->navitems as $key => $value) {
            $ccn_nav_items .= '<a class="dropdown-item" href="'. $value->url .'">'. $value->title .'</a>';


              switch ($value->itemtype) {
                  case 'divider':
                      // If the nav item is a divider, add one and skip link processing.
                      $am->add($divider);
                      break;

                  case 'invalid':
                      // Silently skip invalid entries (should we post a notification?).
                      break;

                  case 'link':
                      // Process this as a link item.
                      $pix = null;
                      if (isset($value->pix) && !empty($value->pix)) {
                          $pix = new pix_icon($value->pix, '', null, array('class' => 'iconsmall'));
                      } else if (isset($value->imgsrc) && !empty($value->imgsrc)) {
                          $value->title = html_writer::img(
                              $value->imgsrc,
                              $value->title,
                              array('class' => 'iconsmall')
                          ) . $value->title;
                      }

                      $al = new action_menu_link_secondary(
                          $value->url,
                          $pix,
                          $value->title,
                          array('class' => 'icon')
                      );
                      if (!empty($value->titleidentifier)) {
                          $al->attributes['data-title'] = $value->titleidentifier;
                      }
                      $am->add($al);
                      break;
              }

              $idx++;

          }
      }

     /* return html_writer::div(
          $this->render($am),
          $usermenuclasses
      );*/
      return $ccn_nav_items;
  }


}
