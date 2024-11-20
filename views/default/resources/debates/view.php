<?php

$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'debates');

$debates = get_entity($guid);

// no header or tabs for viewing an individual debate
$params = [
	'filter' => '',
	'title' => $debates->title
];

$container = $debates->getContainerEntity();
$crumbs_title = $container->name;

elgg_push_collection_breadcrumbs('object', 'debates');

$params['content'] = elgg_view_entity($debates, array('full_view' => true, 'show_responses' => true,));

$params['sidebar'] = elgg_view('custom/debates/single_sidebar', [
	'page' => $page_type,
	'debate_guid' => $debates->guid
]);



$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);