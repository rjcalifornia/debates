<?php

use Elgg\Debates\DebatesUtils;

$full = elgg_extract('full_view', $vars, FALSE);
$debates = elgg_extract('entity', $vars, FALSE);
$entity = elgg_extract('entity', $vars, FALSE);
$site_url = elgg_get_site_url();
$comments_link = null;
$categories = null;
if (!$debates) {
	return;
}
$twig = debates_twig();
$debatesUtils = new DebatesUtils();
$owner = $debates->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$vars['owner_url'] = "debates/owner/$owner->username";
$by_line = elgg_view('page/elements/by_line', $vars);

$subtitle = "$by_line $comments_link $categories";

$menu = elgg_view_menu('entity', [
	'entity' => $entity,
	'handler' => elgg_extract('handler', $vars),
	'prepare_dropdown' => true,
	'class' => 'flex justify-center items-center size-9 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800'
]);

if (elgg_extract('full_view', $vars)) {
	
	$tags = $debates->tags;
	$entity_details = elgg_view('custom/debates/user', $vars);
	$sustainable_goals = $debates->goals;
	$vars['class'] = '';
	$responses = elgg_view_comments($entity, true, $vars);

	$labels = [
		'explore' => elgg_echo('debates:explore'),	
		'total_support' => elgg_echo('debates:total_support'),
    	'total_against' => elgg_echo('debates:total_against'),
	];

	$data = [
				'entity_details' => new \Twig\Markup($entity_details,'UTF-8'),
				'entity_description' => new \Twig\Markup($debates->description, 'UTF-8'),
				'entity' => $debates->toObject(),
				'sustainable_goals' => $sustainable_goals,
				'site_url' => $site_url,
				'responses' => new \Twig\Markup($responses, 'UTF-8'),
    			'tags' => $tags,
				'menu' => new \Twig\Markup($menu, 'UTF-8')
			];
	

	echo $twig->render('debates/pages/view.twig', 
    [
        'data' => $data,
		'labels' => $labels,
    ]);

}else {

	

	$social = elgg_view_menu('social', [
        'entity' => $entity,
        'handler' => elgg_extract('handler', $vars),
        'class' => 'elgg-menu-hz',
    ]);
     
	$labels =[
		'comments' => elgg_echo('debates:comments'),
	];
	$data = [
		'entity' => $entity->toObject(),
	 	'site_url' => $site_url,
		'tags' => $debates->tags,
		'menu' => new \Twig\Markup($menu, 'UTF-8'),
		'social' => new \Twig\Markup($social, 'UTF-8'),
		'created_by' => $owner,
		'summary' => $entity->getExcerpt(),
		'totals' => $debatesUtils->getDebateVotes($entity),
		];

	 //var_dump($entity);
	echo $twig->render('debates/elements/item.html.twig',  [ 
        'data' => $data, 
		'labels' => $labels,
        
    ]);
	
}