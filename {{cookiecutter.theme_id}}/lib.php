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
 * {{cookiecutter.theme_name}} theme background callbacks.
 *
 * @package    theme_{{cookiecutter.theme_id}}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_{{cookiecutter.theme_id}}_get_main_scss_content($theme) {
    global $CFG;

    if (debugging('', DEBUG_DEVELOPER) && isset($CFG->devel_custom_additional_head) &&
        strpos($CFG->devel_custom_additional_head, 'build/stylesheets/') !== false) {
        // If we're designing the theme and we have an overlay for gulp, empty all CSS.
        return "head.see-compiled-css-by-gulp { color: white; }";
    }

    return file_get_contents($CFG->dirroot . '/theme/{{cookiecutter.theme_id}}/scss/{{cookiecutter.theme_id}}.scss');
}
