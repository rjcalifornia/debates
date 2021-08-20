<?php

$sdg = get_input('sdg');
$sdgTitle = get_input('titles');

elgg_push_collection_breadcrumbs('object', 'debates');

elgg_register_title_button('debates', 'add', 'object', 'debates');

$options = array(
'type' => 'object',
'subtype' => 'debates',
'full_view' => false,
    'metadata_names' =>array('goals'),
    'metadata_values' =>array($sdg),
    'limit' => 8,
    'no_results' => elgg_echo('debates:none'),
    'preload_owners' => true,
    'distinct' => false,
    'pagination' => false,
    'offset'=>0,

);

$filter = elgg_list_entities($options);
$title = elgg_echo('debates:sdg:selected') . $sdgTitle;

$sidebar = elgg_view('custom/debates/all',  ['page' => 'all']);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $filter,
	'title' => $title,
	'sidebar' => $sidebar,
));

echo elgg_view_page($title, $body);
