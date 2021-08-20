<?php
$entity_guid = get_input('guid');
$value = get_input('value');

$entity = get_entity($entity_guid);


if (!$entity) {
	return elgg_error_response(elgg_echo('likes:notfound'));
}

if (elgg_annotation_exists($entity_guid, 'yes')) {
	return elgg_ok_response('', elgg_echo('likes:alreadysupported'));
}

$user = elgg_get_logged_in_user_entity();

if($value == 'yes'){
$annotation_id = $entity->annotate('yes', 1, ACCESS_PUBLIC);
}


if($value == 'no'){
    $annotation_id = $entity->annotate('no', 1, ACCESS_PUBLIC);
    }

if (!$annotation_id) {
	return elgg_error_response(elgg_echo('debates:likes:failure'));
}

if ($entity->owner_guid === $user->guid) {
	return elgg_ok_response('', elgg_echo('debates:likes:likes'));
}

