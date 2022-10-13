<?php
/*
Plugin Name: login system  plugin
Plugin URI: https://www.zehntech.com/
Description: This is an simple short code for login system.
Version: 1.0.1
Author: Shailendra singh panwar

*/
define("loginsystem1" ,plugin_dir_path(__FILE__) );

add_shortcode("login", "loginsystem");
function loginsystem(){
include_once loginsystem1 .'/view/start.php';
}
?>