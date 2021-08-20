<?php


//elgg_pop_breadcrumb();
elgg_push_collection_breadcrumbs('object', 'debates');

elgg_register_title_button('debates', 'add', 'object', 'debates');

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'debates',
	'full_view' => false,
	'view_toggle_type' => false,
	'no_results' => elgg_echo('debates:none'),
	'preload_owners' => true,
	'preload_containers' => true,
	'distinct' => false,
));

$title = elgg_echo('collection:object:debates:all');

$sidebar = elgg_view('custom/debates/all',  ['page' => 'all']);

$body = elgg_view_layout('content', array(
	'filter_value' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
    