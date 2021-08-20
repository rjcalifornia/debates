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
//	'' => '',
 ];

 $data['goals'] = $sustainableGoalsList;
 $data['site_url'] = $site_url;

echo $twig->render('layouts/all_sidebar.html.twig', 
    [
        'data' => $data,
    ]);