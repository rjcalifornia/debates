<?php

$title = get_input('title');
$initialText = get_input('description');
$goals = get_input('sdg');
$access_id = get_input('access_id');
$tags = get_input('tags');
$guid = get_input('guid');
$container = (int)get_input('container_guid');


$tagarray = elgg_string_to_array($tags);

if ($guid) {
    $debate = get_entity($guid);
}
else{
    $debate = new \ElggDebates();
}

$debate->title = $title;
$debate->description = $initialText;
$debate->access_id = $access_id;
$debate->tags = $tagarray;
$debate->comments_on = 'On';
$debate->status = 'published';

if($goals){
    $goalsArray = ($goals);
    $debate->goals= $goalsArray;
}

$debate->save();

$forward_url = $debate->getURL();

return elgg_ok_response('', elgg_echo('debate:save:success'), $forward_url);

//system_message($test);