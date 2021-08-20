<?php

$title = get_input('title');
$initialText = get_input('description');
$goals = get_input('sdg');
$access_id = get_input('access_id');
$tags = get_input('tags');
$guid = get_input('guid');
$container = (int)get_input('container_guid');

$tagarray = string_to_tag_array($tags);

if ($guid) {
    $debatesEntity = get_entity($guid);
}
else{
    $debatesEntity = new \ElggDebates();
}

$debatesEntity->title = $title;
$debatesEntity->description = $initialText;
$debatesEntity->access_id = $access_id;
$debatesEntity->tags = $tagarray;

if($goals){
    $goalsArray = string_to_tag_array($goals);
    $debatesEntity->goals= $goalsArray;
}

$debatesEntity->save();

$forward_url = $debatesEntity->getURL();

return elgg_ok_response('', elgg_echo('debate:save:success'), $forward_url);

//system_message($test);