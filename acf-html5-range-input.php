<?php

/*
Plugin Name: ACF HTML5 Range Input
Plugin URI: https://github.com/prisoner2019/ACF-HTML5-Range-Input
Description: HTML5 range input for Advanced Custom Fields
Version: 1.0
Author: John Petroviak
Author URI: http://www.johnpetroviak.com
License: MIT
*/

class acf_field_range_plugin
{
    function __construct()
    {
        add_action('acf/include_field_types', array($this, 'include_field_types_range'));
    }

    function include_field_types_range() {
        include_once('range.php');
    }
}

new acf_field_range_plugin();
