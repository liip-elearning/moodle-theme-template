# Moodle theme template

Templates to easily generate a custom theme, inheriting from the Moodle default themes.

## Requirements
This uses cookiecutter, which can be installed easily:

    pip install cookiecutter

## Usage

Cookiecutter will ask several parameters:

Parameter     | Format                                        | Example
------------- | --------------------------------------------- | ----------
theme_id      | Lowercase, no special characters, no spaces   | liip
theme_name    | For textual use, no specific format required  | L//P
theme_version | YYYYMMDD or YYYYMMDDVV (VV as version number) | 2017032100
theme_release | V.V                                           | 1.5

### Moodle 3.2
For Moodle 3.2, the theme will inherit from **Boost**.

    cd Moodle/theme
    cookiecutter gh:liip-elearning/moodle-theme-template

### Moodle 3.1
For Moodle 3.1 the theme will inherit from **Bootstrap**.
Please be sure you have the **Bootstrap** Theme installed. You can find it here: [Boostrap Moodle Theme](https://github.com/bmbrands/theme_bootstrap)

    cd Moodle/theme
    cookiecutter --checkout MOODLE_31 gh:liip-elearning/moodle-theme-template
