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
 * {{cookiecutter.theme_name}} theme settings.
 *
 * @package    theme_{{cookiecutter.theme_id}}
 * @copyright  2016 Damyon Wiese
 * @copyright   2017 Liip AG <https://www.liip.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesetting{{cookiecutter.theme_id}}', get_string('configtitle', 'theme_{{cookiecutter.theme_id}}'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_{{cookiecutter.theme_id}}_general', get_string('generalsettings', 'theme_{{cookiecutter.theme_id}}'));

    // Replicate the preset setting from boost.
    $name = 'theme_{{cookiecutter.theme_id}}/preset';
    $title = get_string('preset', 'theme_{{cookiecutter.theme_id}}');
    $description = get_string('preset_desc', 'theme_{{cookiecutter.theme_id}}');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_{{cookiecutter.theme_id}}', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_{{cookiecutter.theme_id}}/presetfiles';
    $title = get_string('presetfiles','theme_{{cookiecutter.theme_id}}');
    $description = get_string('presetfiles_desc', 'theme_{{cookiecutter.theme_id}}');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_{{cookiecutter.theme_id}}/brandcolor';
    $title = get_string('brandcolor', 'theme_{{cookiecutter.theme_id}}');
    $description = get_string('brandcolor_desc', 'theme_{{cookiecutter.theme_id}}');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_{{cookiecutter.theme_id}}_advanced', get_string('advancedsettings', 'theme_{{cookiecutter.theme_id}}'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_{{cookiecutter.theme_id}}/scsspre',
        get_string('rawscsspre', 'theme_{{cookiecutter.theme_id}}'), get_string('rawscsspre_desc', 'theme_{{cookiecutter.theme_id}}'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_configtextarea('theme_{{cookiecutter.theme_id}}/scss', get_string('rawscss', 'theme_{{cookiecutter.theme_id}}'),
        get_string('rawscss_desc', 'theme_{{cookiecutter.theme_id}}'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}