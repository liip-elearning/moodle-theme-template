# {{cookiecutter.theme_name}} Moodle Theme

This theme is based on [Moodle Boost theme](https://docs.moodle.org/35/en/Boost_theme).
It has been generated with cookiecutter base on the [Moodle Theme Template](https://github.com/liip-elearning/moodle-theme-template).

## Development

### Moodle configuration

For _DEVELOPMENT_, the best is to configure Moodle as follows:

```
$CFG->theme = '{{cookiecutter.theme_id}}';
$CFG->devel_custom_additional_head = '<link rel="stylesheet" type="text/css" href="/theme/{{cookiecutter.theme_id}}/build/stylesheets/compiled.css" />';
$CFG->browsersyncurl = 'http://192.168.122.17:3000';
```

### Launch Browsersync

    npm install
    gulp
