<?php
 
function homepage_init() {
         // Replace the default index page
    register_plugin_hook('index','system','new_index');
}
 
function new_index() {
    if (!include_once(dirname(dirname(__FILE__)) . "/LocalInformationService/index.php"))
        return false;
 
    return true;
}
 
register_elgg_event_handler('init','system','homepage_init');
?>