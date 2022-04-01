<?php

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$goals = elgg_extract('goals', $vars, '');

$twig = debates_twig();


$sustainableGoalsList = [
    'poverty' => 'NO POVERTY' ,
    'hunger' => 'ZERO HUNGER' ,
	'health' => 'GOOD HEALTH AND WELL BEING' ,
	'education' => 'QUALITY EDUCATION' ,
	'gender' => 'GENDER EQUALITY',
	'clean_water' => 'CLEAN WATER AND SANITATION',
	'clean_energy' => 'AFFORDABLE AND CLEAN ENERGY',
	'economy' => 'DECENT WORK AND ECONOMIC GROWTH',
	'innovation' => 'INDUSTRY, INNOVATION AND INFRASTRUCTURE',
	'inequalities' => 'REDUCE INEQUALITIES',
	'sustainable_cities' => 'SUSTAINABLE CITIES AND COMMUNITIES',
	'consumption' => 'RESPONSIBLE CONSUMPTION AND PRODUCTION',
	'climate' => 'CLIMATE ACTION',
	'life_below_water' => 'LIFE BELOW WATER',
	'life_land' => 'LIFE ON LAND',
	'justice' => 'PEACE, JUSTICE AND STRONG INSTITUTIONS',
	'partnerships' => 'PARTNERSHIPS FOR THE GOALS',
//	'' => '',
 ];

$data['hidden_guid_input'] = '';
$guid = elgg_extract('guid', $vars, null);

if ($guid) {
	$hiddenGuid = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	$data['hidden_guid_input'] = new \Twig\Markup($hiddenGuid, 'UTF-8');
	
}

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);


$titleLabel = elgg_echo('debates:add:title');
$titleInput = elgg_view('input/text', array('name' => 'title', 'value' => $title));

$debatesInitialTextLabel = elgg_echo('debates:initial:text');
$debatesInitialTextInput = elgg_view('input/longtext', array('name' => 'description', 'value' => $desc));


$sustainableGoalsLabel = elgg_echo('debates:add:sdg');
$sustainableGoalsInput = elgg_view('input/select', array(
	'name' => 'sdg',
	'id' => 'debates_sdf',
    'required' => true,
	'options_values' => $sustainableGoalsList,
    'value' => $vars['goals'],
	'class' => 'js-goals-single selection-sdg',
    'multiple' => true,
));

$tagsLabel = elgg_echo('debates:topics');
$tagsInput = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'debates_tags',
	'value' => $vars['tags']
));

$accessLabel = elgg_echo('access');
$accessInput = elgg_view('input/access', array(
	'name' => 'access_id',
	'value' => $access_id,
	'entity' => get_entity($guid),
	'entity_type' => 'object',
	
));

$hiddenContainer = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

$footer = elgg_view_field([
	'#type' => 'submit',
	'id' => 'share',
	'value' => elgg_echo('save'),
]);




$data['title_label'] = $titleLabel;
$data['title_input'] = new \Twig\Markup($titleInput, 'UTF-8');


$data['debates_initial_text_label'] = $debatesInitialTextLabel;
$data['debates_initial_text_input'] = new \Twig\Markup($debatesInitialTextInput, 'UTF-8');

$data['sdg_label'] = $sustainableGoalsLabel;
$data['sdg_input'] = new \Twig\Markup($sustainableGoalsInput, 'UTF-8');


$data['access_label'] = $accessLabel;
$data['access_input'] = new \Twig\Markup($accessInput, 'UTF-8');

$data['tags_label'] = $tagsLabel;
$data['tags_input'] = new \Twig\Markup($tagsInput, 'UTF-8');

$data['hidden_container_input'] = new \Twig\Markup($hiddenContainer, 'UTF-8');

$data['footer'] = new \Twig\Markup(($footer), 'UTF-8');


echo $twig->render('debates/forms/add-debates.html.twig', 
        [
            'data' => $data,
        ]);