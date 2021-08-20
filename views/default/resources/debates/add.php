<?php
/**
 * Add debates page
 *
 * @package Debates
 */

use Elgg\Exceptions\Http\EntityPermissionsException;

$guid = elgg_extract('guid', $vars);
if (!$guid) {
	$guid = elgg_get_logged_in_user_guid();
}

elgg_require_js("debates/select2");

$container = get_entity($guid);

elgg_entity_gatekeeper($guid);

$page_owner = elgg_get_page_owner_entity();

// Make sure user has permissions to add to container
if (!$container->canWriteToContainer(0, 'object', 'debates')) {
	throw new EntityPermissionsException();
}

$title = elgg_echo('debates:add');
elgg_push_breadcrumb($title);

$vars = debates_prepare_form_vars();

$content = elgg_view_form('debates/save', array(), $vars);

$params['sidebar'] = elgg_view('custom/debates/add_new_sidebar', [
    'page' => $page_type,
    //'twig'=> $vars['twig'],
   // 'proposal_guid' => $debates->guid
]);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
    'sidebar' => $params['sidebar']
));

echo elgg_view_page($title, $body);