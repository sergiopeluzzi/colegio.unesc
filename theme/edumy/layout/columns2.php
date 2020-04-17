<?php
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/behat/lib.php');

global $COURSE;
global $CFG;
global $USER;

if (is_siteadmin()) {$user_status = 'role-supreme';} else {$user_status = 'role-standard';}
if(!empty($OUTPUT->get_theme_image_headerlogo1())){
  $headerlogo1 = $OUTPUT->get_theme_image_headerlogo1(null, 100);
} else {
  $headerlogo1 = $CFG->wwwroot . '/theme/edumy/images/header-logo.png';
}
if(!empty($OUTPUT->get_theme_image_headerlogo2())){
  $headerlogo2 = $OUTPUT->get_theme_image_headerlogo2(null, 100);
} else {
  $headerlogo2 = $CFG->wwwroot . '/theme/edumy/images/header-logo2.png';
}
if(!empty($OUTPUT->get_theme_image_headerlogo3())){
  $headerlogo3 = $OUTPUT->get_theme_image_headerlogo3(null, 100);
} else {
  $headerlogo3 = $CFG->wwwroot . '/theme/edumy/images/header-logo4.png';
}
if(!empty($OUTPUT->get_theme_image_footerlogo1())){
  $footerlogo1 = $OUTPUT->get_theme_image_footerlogo1(null, 100);
} else {
  $footerlogo1 = $CFG->wwwroot . '/theme/edumy/images/header-logo.png';
}
if(!empty($OUTPUT->get_theme_image_heading_bg())){
  $heading_bg = $OUTPUT->get_theme_image_heading_bg(null, 100);
} else {
  $heading_bg = $CFG->wwwroot . '/theme/edumy/images/background/inner-pagebg.jpg';
}
$headertype = get_config('theme_edumy', 'headertype');
$footertype = get_config('theme_edumy', 'footertype');
$blogstyle = get_config('theme_edumy', 'blogstyle');
$courseliststyle = get_config('theme_edumy', 'courseliststyle');
$extraclasses = array('ccn_header_style_' . $headertype, 'ccn_footer_style_' . $footertype, 'ccn_blog_style_' . $blogstyle, 'ccn_course_list_style_' . $courseliststyle, $user_status);
$bodyclasses = implode(" ",$extraclasses);
$bodyattributes = $OUTPUT->body_attributes($bodyclasses);
$pageheading = $PAGE->heading;
$blockshtml = $OUTPUT->blocks('side-pre');
$leftblocks = $OUTPUT->blocks('left');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$hasleftblocks = strpos($leftblocks, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$hassideblocks = ($hasblocks || $hasleftblocks);
$blocks_user_notifications = $OUTPUT->blocks('user-notif');
$blocks_user_messages = $OUTPUT->blocks('user-messages');
$blocks_fullwidth_top = $OUTPUT->blocks('fullwidth-top');
$blocks_fullwidth_bottom = $OUTPUT->blocks('fullwidth-bottom');
$blocks_above_content = $OUTPUT->blocks('above-content');
$blocks_below_content = $OUTPUT->blocks('below-content');
$loginblocks = $OUTPUT->blocks('login');
$searchblocks = $OUTPUT->blocks('search');
$cocoon_facebook_url = get_config('theme_edumy', 'cocoon_facebook_url');
$cocoon_copyright = get_config('theme_edumy', 'cocoon_copyright');
$courseid = $PAGE->course->id;
$coursefullname = $PAGE->course->fullname;
$courseshortname = $PAGE->course->shortname;
if (!empty($PAGE->category->name)){$coursecategory = $PAGE->category->name;}else{$coursecategory = '';}
$coursesummary = $PAGE->course->summary;
$courseformat = $PAGE->course->format;
$coursecreated = userdate($PAGE->course->timecreated, get_string('strftimedatefullshort', 'langconfig'), 0);
$coursemodified = userdate($PAGE->course->timemodified, get_string('strftimedatefullshort', 'langconfig'), 0);
$coursestartdate = userdate($PAGE->course->startdate, get_string('strftimedatefullshort', 'langconfig'), 0);
$courseenddate = userdate($PAGE->course->enddate, get_string('strftimedatefullshort', 'langconfig'), 0);
$context = context_course::instance($courseid);
$numberofusers = count_enrolled_users($context);
if (isloggedin()) {
  $isloggedin = 'TRUE';
  $messages_link = $CFG->wwwroot . '/message/index.php';
  $profile_link = $CFG->wwwroot . '/user/profile.php?id=' . $USER->id;
  $grades_link = $CFG->wwwroot . '/grade/report/overview/index.php';
  $preferences_link = $CFG->wwwroot . '/user/preferences.php';
} else {
  $isloggedin = 'FALSE';
  $messages_link = '';
  $profile_link = '';
  $grades_link = '';
  $preferences_link = '';
}
if (function_exists('signup_is_enabled()') && signup_is_enabled()) {
  $signup_is_enabled = 'TRUE';
} else {
  $signup_is_enabled = 'FALSE';
}
if (get_config('theme_edumy', 'logotype') == 1){
  $logotype = false;
} else {
  $logotype = true;
}
if (get_config('theme_edumy', 'logo_image') == 1){
  $logo_image = false;
} else {
  $logo_image = true;
}
if (!$logotype && !$logo_image){
  $logo = false;
} else {
  $logo = true;
}
if (get_config('theme_edumy', 'logotype_footer') == 1){
  $logotype_footer = false;
} else {
  $logotype_footer = true;
}
if (get_config('theme_edumy', 'logo_image_footer') == 1){
  $logo_image_footer = false;
} else {
  $logo_image_footer = true;
}
if (!$logotype_footer && !$logo_image_footer){
  $logo_footer = false;
} else {
  $logo_footer = true;
}
if(get_config('theme_edumy', 'custom_css')){
  $custom_css = '<style>'.get_config('theme_edumy', 'custom_css').'</style>';
} else {
  $custom_css = '';
}
if(get_config('theme_edumy', 'custom_css_dashboard')){
  $custom_css_dashboard = '<style>'.get_config('theme_edumy', 'custom_css_dashboard').'</style>';
} else {
  $custom_css_dashboard = '';
}
if(get_config('theme_edumy', 'custom_js')){
  $custom_js = '<script>'.get_config('theme_edumy', 'custom_js').'</script>';
} else {
  $custom_js = '';
}
if(get_config('theme_edumy', 'custom_js_dashboard')){
  $custom_js_dashboard = '<script>'.get_config('theme_edumy', 'custom_js_dashboard').'</script>';
} else {
  $custom_js_dashboard = '';
}
if(!empty($USER->username)){$USER->username = $USER->username;}else{$USER->username = '';}
if(!empty($USER->firstname)){$USER->firstname = $USER->firstname;}else{$USER->firstname = '';}
if(!empty($USER->lastname)){$USER->lastname = $USER->lastname;}else{$USER->lastname = '';}
if(!empty($USER->email)){$USER->email = $USER->email;}else{$USER->email = '';}
if(!empty($USER->lang)){$USER->lang = $USER->lang;}else{$USER->lang = '';}
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'pageheading' => $pageheading,
    'sidepreblocks' => $blockshtml,
    'library_list_blocks' => $OUTPUT->blocks('library-list'),
    'has_library_list_blocks' => strpos($OUTPUT->blocks('library-list'), 'data-block=') !== false,
    'navbar_blocks' => $OUTPUT->blocks('navbar'),
    'has_navbar_blocks' => strpos($OUTPUT->blocks('navbar'), 'data-block=') !== false,
    'leftblocks' => $leftblocks,
    'hasblocks' => $hasblocks,
    'hasleftblocks' => $hasleftblocks,
    'hassideblocks' => $hassideblocks,
    'bodyattributes' => $bodyattributes,
    'headerlogo1' => $headerlogo1,
    'headerlogo2' => $headerlogo2,
    'headerlogo3' => $headerlogo3,
    'footerlogo1' => $footerlogo1,
    'heading_bg' => $heading_bg,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'loginblocks' => $loginblocks,
    'hasloginblocks' => !empty($loginblocks),
    'searchblocks' => $searchblocks,
    'hassearchblocks' => !empty($searchblocks),
    'blocks_user_notifications' => $blocks_user_notifications,
    'blocks_user_messages' => $blocks_user_messages,
    'blocks_fullwidth_top' => $blocks_fullwidth_top,
    'blocks_above_content' => $blocks_above_content,
    'has_blocks_above_content' => !empty($blocks_above_content),
    'blocks_below_content' => $blocks_below_content,
    'has_blocks_below_content' => !empty($blocks_below_content),
    'is_course' => $PAGE->bodyid == 'page-course-view-topics',
    'is_blog' => $PAGE->bodyid == 'page-blog-index',
    'is_frontpage' => $PAGE->bodyid == 'page-site-index',
    'courseid' => $courseid,
    'coursefullname' => $coursefullname,
    'courseshortname' => $courseshortname,
    'coursecategory' => $coursecategory,
    'coursesummary' => $coursesummary,
    'courseformat' => $courseformat,
    'coursecreated' => $coursecreated,
    'coursemodified' => $coursemodified,
    'coursestartdate' => $coursestartdate,
    'courseenddate' => $courseenddate,
    'numberofusers' => $numberofusers,
    'cocoon_facebook_url' => format_text(get_config('theme_edumy', 'cocoon_facebook_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_twitter_url' => format_text(get_config('theme_edumy', 'cocoon_twitter_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_instagram_url' => format_text(get_config('theme_edumy', 'cocoon_instagram_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_pinterest_url' => format_text(get_config('theme_edumy', 'cocoon_pinterest_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_dribbble_url' => format_text(get_config('theme_edumy', 'cocoon_dribbble_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_google_url' => format_text(get_config('theme_edumy', 'cocoon_google_url'), FORMAT_HTML, array('filter' => true)),
    'cocoon_copyright' => format_text(get_config('theme_edumy', 'cocoon_copyright'), FORMAT_HTML, array('filter' => true)),
    'footer_col_1_title' => format_text(get_config('theme_edumy', 'footer_col_1_title'), FORMAT_HTML, array('filter' => true)),
    'footer_col_1_body' => format_text(get_config('theme_edumy', 'footer_col_1_body'), FORMAT_HTML, array('filter' => true)),
    'footer_col_2_title' => format_text(get_config('theme_edumy', 'footer_col_2_title'), FORMAT_HTML, array('filter' => true)),
    'footer_col_2_body' => format_text(get_config('theme_edumy', 'footer_col_2_body'), FORMAT_HTML, array('filter' => true)),
    'footer_col_3_title' => format_text(get_config('theme_edumy', 'footer_col_3_title'), FORMAT_HTML, array('filter' => true)),
    'footer_col_3_body' => format_text(get_config('theme_edumy', 'footer_col_3_body'), FORMAT_HTML, array('filter' => true)),
    'footer_col_4_title' => format_text(get_config('theme_edumy', 'footer_col_4_title'), FORMAT_HTML, array('filter' => true)),
    'footer_col_4_body' => format_text(get_config('theme_edumy', 'footer_col_4_body'), FORMAT_HTML, array('filter' => true)),
    'footer_col_5_title' => format_text(get_config('theme_edumy', 'footer_col_5_title'), FORMAT_HTML, array('filter' => true)),
    'footer_col_5_body' => format_text(get_config('theme_edumy', 'footer_col_5_body'), FORMAT_HTML, array('filter' => true, 'noclean' => true)),
    'footer_menu' => format_text(get_config('theme_edumy', 'footer_menu'), FORMAT_HTML, array('filter' => true)),
    'cta_text' => format_text(get_config('theme_edumy', 'cta_text'), FORMAT_HTML, array('filter' => true)),
    'cta_link' => format_text(get_config('theme_edumy', 'cta_link'), FORMAT_HTML, array('filter' => true)),
    'email_address' => format_text(get_config('theme_edumy', 'email_address'), FORMAT_HTML, array('filter' => true)),
    'phone' => format_text(get_config('theme_edumy', 'phone'), FORMAT_HTML, array('filter' => true)),
    'custom_css' => $custom_css,
    'custom_css_dashboard' => $custom_css_dashboard,
    'custom_js' => $custom_js,
    'custom_js_dashboard' => $custom_js_dashboard,
    'logotype' => $logotype,
    'logo_image' => $logo_image,
    'logo' => $logo,
    'logotype_footer' => $logotype_footer,
    'logo_image_footer' => $logo_image_footer,
    'logo_footer' => $logo_footer,
    'user_profile_picture' => new moodle_url('/user/pix.php/'.$USER->id.'/f1.jpg'),
    'user_username' => $USER->username,
    'user_firstname' => $USER->firstname,
    'user_lastname' => $USER->lastname,
    'user_email' => $USER->email,
    'user_language' => $USER->lang,
    'user_id' => $USER->id,
    'isloggedin' => $isloggedin == 'TRUE',
    'notloggedin' => $isloggedin == 'FALSE',
    'signup_is_enabled' => $signup_is_enabled == 'TRUE',
    'signup_is_disabled' => $signup_is_enabled == 'FALSE',
    'header_1' => $headertype == 1,
    'header_2' => $headertype == 2,
    'header_3' => $headertype == 3,
    'header_4' => $headertype == 4,
    'header_5' => $headertype == 5,
    'header_6' => $headertype == 6,
    'header_7' => $headertype == 7,
    'header_8' => $headertype == 8,
    'footer_1' => $footertype == 1,
    'footer_2' => $footertype == 2,
    'footer_3' => $footertype == 3,
    'footer_4' => $footertype == 4,
    'gmaps_key' => get_config('theme_edumy', 'gmaps_key'),
    'messages_link' => $messages_link,
    'profile_link' => $profile_link,
    'preferences_link' => $preferences_link,
    'grades_link' => $grades_link,
];

$nav = $PAGE->flatnav;
$templatecontext['flatnavigation'] = $nav;
$templatecontext['firstcollectionlabel'] = $nav->get_collectionlabel();
echo $OUTPUT->render_from_template('theme_boost/columns2', $templatecontext);
