<?php
namespace theme_edumy\output;

use renderer_base;
use pix_icon;

defined('MOODLE_INTERNAL') || die();

class icon_system_fontawesome extends \core\output\icon_system_fontawesome {
public function get_core_icon_map() {
    $iconmap = parent::get_core_icon_map();

    $overrides = Array(
      'core:t/messages' => 'flaticon-speech-bubble',
      'core:t/message' => 'flaticon-speech-bubble',
      'core:i/notifications' => 'flaticon-alarm',
    );

    $merged = array_merge($iconmap, $overrides);

    return $merged;
}

}
