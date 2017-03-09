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
 * {{cookiecutter.theme_name}} theme config.
 *
 * @package    theme_{{cookiecutter.theme_id}}
 * @copyright  2016 Damyon Wiese
 * @copyright   2017 Liip AG <https://www.liip.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = '{{cookiecutter.theme_id}}';
$THEME->parents = array('bootstrap');

$THEME->doctype     = 'html5';
$THEME->yuicssmodules = array();
$THEME->enable_dock = true;
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->supportscssoptimisation = false;
$THEME->lessfile = '{{cookiecutter.theme_id}}';
$THEME->parents_exclude_sheets = array('bootstrap' => array('moodle'));
$THEME->lessvariablescallback = 'theme_{{cookiecutter.theme_id}}_less_variables';
$THEME->extralesscallback = 'theme_{{cookiecutter.theme_id}}_extra_less';

