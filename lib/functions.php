<?php

$autoload_path = __DIR__ . '/../vendor/autoload.php';
require_once($autoload_path);

function debates_twig(){
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../resources');
	$twig = new \Twig\Environment($loader, [
		'cache' => false,
	]);

    return $twig;
}



function debates_prepare_form_vars($post = NULL, $revision = NULL) {

	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
		'tags' => NULL,
		'goals' => NULL,
		'container_guid' => NULL,
		'guid' => NULL,
		'draft_warning' => '',
		'comments_on' => 'On',
	);

	if ($post) {
		foreach (array_keys($values) as $field) {
			if (isset($post->$field)) {
				$values[$field] = $post->$field;
			}
		}

		if ($post->status == 'draft') {
			$values['access_id'] = $post->future_access;
		}
	}

	if (elgg_is_sticky_form('debates')) {
		$sticky_values = elgg_get_sticky_values('debates');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('debates');

	if (!$post) {
		return $values;
	}

	// load the revision annotation if requested
	if ($revision instanceof ElggAnnotation && $revision->entity_guid == $post->getGUID()) {
		$values['revision'] = $revision;
		$values['description'] = $revision->value;
	}

	// display a notice if there's an autosaved annotation
	// and we're not editing it.
	$auto_save_annotations = $post->getAnnotations(array(
		'annotation_name' => 'debates_auto_save',
		'limit' => 1,
	));
	if ($auto_save_annotations) {
		$auto_save = $auto_save_annotations[0];
	} else {
		$auto_save = false;
	}
	/* @var ElggAnnotation|false $auto_save */

	if ($auto_save && $revision && $auto_save->id != $revision->id) {
		$values['draft_warning'] = elgg_echo('debates:messages:warning:draft');
	}

	return $values;
}