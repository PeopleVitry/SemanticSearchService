<?php

elgg_register_event_handler('init', 'system', 'ssearch_init');

function ssearch_init() {

elgg_register_page_handler('ssearch','ssearch_page_handler');
				
$item = new ElggMenuItem('ssearch', 'My search', 'ssearch');
elgg_register_menu_item('site', $item);

elgg_extend_view('css/elgg', 'ssearch/css/css');

elgg_extend_view('page/elements/head','ssearch/llee/js');


if (!elgg_is_active_plugin('LiangleeFramework')) {
 if (elgg_is_admin_logged_in()) {
 /*
 * Register Error to Admin if framework is missing.
 *
 * @access admin
 */
 register_error(elgg_echo('lianglee:framewrok:miss'));
 } else {
/*
 * Register Error to Users in Code if framework is missing.
 *
 * @access public
 */ 
 register_error(elgg_echo('lianglee:framewrok:miss:code'));	
     }
    }  
}


function ssearch_page_handler($page) {
	$base_dir = elgg_get_plugins_path() . 'ssearch/pages/ssearch';

	if (!isset($page[0])) {
		$page = array('view');
	}

	switch ($page[0]) {
		case "view":
			include "$base_dir/view.php";
			break;
			
		default:
			return false;
	}
	return true;
}
	?>
