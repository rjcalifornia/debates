<?php
/**
 * Add bookmark page
 *
 * @package Elggproposals
 */
use Elgg\Exceptions\Http\EntityNotFoundException;
elgg_gatekeeper();

$entity_guid = elgg_extract('guid', $vars);
$entity = get_entity($entity_guid);

 
elgg_import_esm("debates/select2");
 

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('debates:edit');
elgg_push_breadcrumb($title);

$vars = debates_prepare_form_vars($entity);

$content = elgg_view_form('debates/save', array(), $vars);



$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);