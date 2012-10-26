<?php
 
$content = elgg_view('ssearch/ajax'); 


$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $fetch,
	'filter' => false,
));

echo elgg_view_page($fetch, $body);

