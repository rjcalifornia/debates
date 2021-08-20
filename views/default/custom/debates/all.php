<?php
$site_url = elgg_get_site_url();
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

 $options = [
	'type' => 'object',
	'subtype' => 'debates',
	'threshold' => 0,
	'limit' => elgg_extract('limit', $vars, 50),
	'tag_name' => 'tags',
];

$tag_data = elgg_get_tags($options);


$cloud = elgg_view("custom/debates/trending", [
	'value' => $tag_data,
	'type' => 'object',
	
]);

$trending = new \Twig\Markup(elgg_view_module('aside', $title, $cloud),'UTF-8');

 $data['goals'] = $sustainableGoalsList;
 $data['site_url'] = $site_url;
 $data['trending'] = $trending;



echo $twig->render('layouts/all_sidebar.html.twig', 
    [
        'data' => $data,
    ]);