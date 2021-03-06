<?php
error_reporting(-1);
/**
 * In cli mode
 * $arg = array(
 *              0 => 'script name' - always has the script name
 *              1 => 'project' - eg nspc_dev
 *              2 => 'plugin type'
 *              3 => 'plugin name'
 *          );
 */
if (php_sapi_name() == "cli") {
    $arg = $argv;
    // get the plugin type
    // eg blocks, local
    $project = $arg[1];
    $plugin_type = $arg[2];
    $plugin_name = $arg[3];

} else {
    // if in browser mode
    $plugin_name = $_GET['name'];
    $plugin_type = $_GET['type'];
    $project = $_GET['project'];
}


// check plugin file exists
// check function init exists
// call init function
if(file_exists('plugins/'.$plugin_type.'.php')) {
    require_once ('plugins/'.$plugin_type.'.php');
    if(function_exists('init_'.$plugin_type)) {
        call_user_func('init_'.$plugin_type, $plugin_name, $project);
    }
}