# {{cookiecutter.theme_name}} Moodle Theme

This theme is based on [Moodle Boost theme](https://docs.moodle.org/35/en/Boost_theme).
It has been generated with cookiecutter base on the [Moodle Theme Template](https://github.com/liip-elearning/moodle-theme-template).

## Development

### Moodle configuration

For _DEVELOPMENT_, the best is to use Liip eLearning's [moodle-docker](https://github.com/liip-elearning/moodle-docker/) with :

```
export MOODLE_CODENAME=mdl-test
export MOODLE_DOCKER_THEMEDEVEL={{cookiecutter.theme_id}}
moodle-compose up -d
```

Then access https://browsersync.mdl-test.docker.test/
