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


if (elgg_extract('full_view', $vars)) {
	
	$tags = $debates->tags;
	$entity_details = elgg_view('custom/debates/user', $vars);
	$sustainable_goals = $debates->goals;
	
	//$responses = elgg_view_comments($debates, true);
	$responses = elgg_view_comments($entity, true, $vars);



	

	
	$data['entity_details'] = new \Twig\Markup($entity_details,'UTF-8');
	$data['entity_description'] = new \Twig\Markup($debates->description, 'UTF-8');
	$data['entity'] = $debates->toObject();
	
	$data['sustainable_goals'] = $sustainable_goals;
	$data['site_url'] = $site_url;
	$data['responses'] = new \Twig\Markup($responses, 'UTF-8');
    $data['tags'] = $tags;
	
	

	echo $twig->render('debates/pages/view.twig', 
    [
        'data' => $data,
    ]);

}else {

	$menu = elgg_view_menu('entity', [
        'entity' => $entity,
        'handler' => elgg_extract('handler', $vars),
        'prepare_dropdown' => true,
    ]);

	$social = elgg_view_menu('social', [
        'entity' => $entity,
        'handler' => elgg_extract('handler', $vars),
        'class' => 'elgg-menu-hz',
    ]);
    $data['totals'] = $debatesUtils->getDebateVotes($entity);

	$data['entity'] = $entity->toObject();
	$data['site_url'] = $site_url;
	$data['tags'] = $debates->tags;
	$data['menu'] = new \Twig\Markup($menu, 'UTF-8');
	$data['social'] = new \Twig\Markup($social, 'UTF-8');
	$data['created_by'] = $owner;
	$data['summary'] = $entity->getExcerpt();

	 //var_dump($entity);
	echo $twig->render('debates/elements/item.html.twig',  [ 
        'data' => $data, 
        
    ]);
	
}