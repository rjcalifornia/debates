<?php
/**
 * Elgg tagcloud
 * Displays a tagcloud. Accepts all output/tag options
 *
 * @uses $vars['tagcloud'] An array of stdClass objects with two elements: 'tag' (the text of the tag) and 'total' (the number of elements with this tag)
 * @uses $vars['value'] Sames as tagcloud
 */

$tagcloud = (array) elgg_extract('tagcloud', $vars, elgg_extract('value', $vars));
if (empty($tagcloud)) {
	return;
}

unset($vars['tagcloud']);
unset($vars['value']);

$max = 0;
foreach ($tagcloud as $tag) {
	if ($tag->total > $max) {
		$max = $tag->total;
	}
}

$params = $vars;

$tags = [];

foreach ($tagcloud as $tag) {
	$params['value'] = $tag->tag;

	// protecting against division by zero warnings
	$size = round((log($tag->total) / log($max + .0001)) * 100) + 30;
	if ($size < 100) {
		$size = 100;
	}
	$params['class'] = "inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500";
	//$params['style'] = "font-size: $size%;";
	$params['title'] = "$tag->tag ($tag->total)";

	$tags[] = elgg_view('output/tag', $params);
}

$cloud = implode(' ', $tags);

$cloud .= elgg_view('tagcloud/extend');

echo elgg_format_element('div', [
	'class' => 'elgg-tagcloud',
], $cloud);
