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

/**
 * {{cookiecutter.theme_name}} [[pix: and [[font: proxy script
 *
 * @package    theme_{{cookiecutter.theme_id}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Disable moodle specific debug messages and any errors in output,
// comment out when debugging or better look into error log!
define('NO_DEBUG_DISPLAY', true);
define('NO_UPGRADE_CHECK', true);
define('NO_MOODLE_COOKIES', true);

require('../../config.php');

$pix  = optional_param('pix', '', PARAM_TEXT);
$font = optional_param('font', '', PARAM_TEXT);
$v    = optional_param('v', '', PARAM_TEXT);

$theme = theme_config::load('{{cookiecutter.theme_id}}');

$postfix = '';
$prefix = '';

if ($v) {
    // Cope with eventual versioning.
    $postfix = '?v=' . $v;
}

// Add Browsersync URL prefix.
if (DEBUG_DEVELOPER && strpos($CFG->devel_custom_additional_head, 'build/stylesheets/') !== false && $CFG->browsersyncurl) {
    $CFG->wwwroot = $CFG->browsersyncurl;
}

// From lib/outputlib.php's post_process.php.

// Resolve image locations.
if (preg_match('/([a-z0-9_]+\|)?([^\]]+)/', $pix, $match)) {

    $imagename = $match[2];
    $component = rtrim($match[1], '|');
    $imageurl = $theme->image_url($imagename, $component)->out(false);
    // We do not need full url because the image.php is always in the same dir.
    $imageurl = preg_replace('|^http.?://[^/]+|', '', $imageurl);
    redirect($imageurl . $postfix);
}

// Resolve font locations.
if (preg_match('/([a-z0-9_]+\|)?([^\]]+)/', $font, $match)) {
    $fontname = $match[2];
    $component = rtrim($match[1], '|');
    $fonturl = $theme->font_url($fontname, $component)->out(false);
    // We do not need full url because the font.php is always in the same dir.
    $fonturl = preg_replace('|^http.?://[^/]+|', '', $fonturl);
    redirect($fonturl . $postfix);
}

header('HTTP/1.0 404 Not found');
