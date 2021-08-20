<?php
/**
 * Debates details summary
 * Passing an 'icon' with the variables will wrap the listing in an image block. In that case,
 * variables not listed in @uses (e.g. image_alt) will be passed to the image block.
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['metadata']  HTML for entity menu and metadata (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['icon']      Object icon. If set, the listing will be wrapped with an image block
 * @uses $vars['class']     Class selector for the image block
 * @uses $vars['image_block_vars'] Attributes for the image block wrapper
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof ElggEntity) {
	return;
}
$vars['icon'] = true;
// build image block content
$summary = '';

//Display entity details
$summary .= elgg_view('object/elements/summary/subtitle', $vars);

// image block image
$icon = elgg_view('object/elements/summary/icon', $vars);

// image block params
$params = (array) elgg_extract('image_block_vars', $vars, []);
$class = elgg_extract_class($params);
$class = elgg_extract_class($vars, $class);
$params['class'] = $class;
$params['data-guid'] = $entity->guid;

echo elgg_view_image_block($icon, $summary, $params);
