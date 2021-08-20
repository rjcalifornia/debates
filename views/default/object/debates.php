<?php
$full = elgg_extract('full_view', $vars, FALSE);
$debates = elgg_extract('entity', $vars, FALSE);
$site_url = elgg_get_site_url();

if (!$debates) {
	return;
}
$twig = debates_twig();

$owner = $debates->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');

$vars['owner_url'] = "debates/owner/$owner->username";
$by_line = elgg_view('page/elements/by_line', $vars);

$subtitle = "$by_line $comments_link $categories";


if (elgg_extract('full_view', $vars)) {
	
	$tags = $debates->tags;
	$entity_details = elgg_view('custom/debates/user', $vars);
	$sustainable_goals = $debates->goals;

	$responses = elgg_view_comments($debates, true);




	
	$data['entity_details'] = new \Twig\Markup($entity_details,'UTF-8');
	$data['entity_description'] = new \Twig\Markup($debates->description, 'UTF-8');
	$data['entity'] = $debates->toObject();
	$data['sustainable_goals'] = $sustainable_goals;
	$data['site_url'] = $site_url;
	$data['responses'] = new \Twig\Markup($responses, 'UTF-8');
    $data['tags'] = $tags;
	
	

	echo $twig->render('pages/view-debate.html.twig', 
    [
        'data' => $data,
    ]);

}else {
    $params = [
		'content' => $debates->getExcerpt(),
		'icon' => true,
	];
	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);
}