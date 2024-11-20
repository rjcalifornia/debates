<?php
/**
 * List user blogs
 *
 * Note: this view has a corresponding view in the default rss type, changes should be reflected
 *
 * @uses $vars['options']        Additional listing options
 * @uses $vars['entity']         User
 * @uses $vars['created_after']  Only show blogs created after a date
 * @uses $vars['created_before'] Only show blogs created before a date
 * @uses $vars['status']         Filter by status
 */

$options = (array) elgg_extract('options', $vars);
$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ElggUser) {
	return;
}

$owner_options = [
	'owner_guid' => $entity->guid,
	'preload_owners' => false,
];

$vars['options'] = array_merge($options, $owner_options);


$defaults = [
	'type' => 'object',
	'subtype' => 'debates',
	'full_view' => false,
	'no_results' => elgg_echo('blog:none'),
	'distinct' => false,
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

$after = elgg_extract('created_after', $vars);
if (!empty($after)) {
	$options['created_after'] = $after;
}

$before = elgg_extract('created_before', $vars);
if (!empty($before)) {
	$options['created_before'] = $before;
}

$status = elgg_extract('status', $vars);
if (!empty($status)) {
	$options['metadata_name_value_pairs']['status'] = $status;
}

echo elgg_list_entities($options);
