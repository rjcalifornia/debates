<?php

$site_url = elgg_get_site_url();
$twig = debates_twig();

$entityGuid = elgg_extract('debate_guid', $vars);

$entity = get_entity($entityGuid);

$likeUrl= "action/debates/support?guid=$entityGuid&value=yes";

$canSupport = true;

$annotations = $entity->getAnnotations(
	[	
		'annotation_name' => 'yes',    // The type of annotation
	]	
	);
	//'annotation_name' => 'page',
	$totalYes = $entity->getAnnotationsSum(['annotation_name' => 'yes']); 
    $totalNo = $entity->getAnnotationsSum(['annotation_name' => 'no']); 
	
    $totals = ['yes'=> $totalYes, 'no'=> $totalNo, 'total_votes' => ($totalNo + $totalYes)];

    

    if (elgg_annotation_exists($entity->guid, 'yes') || elgg_annotation_exists($entity->guid, 'no')  ) {
       $canSupport = false;
        //return elgg_ok_response('', elgg_echo('likes:alreadyliked'));
    }

    if (elgg_annotation_exists($entity->guid, 'yes')) {
        $data['is_supporting'] = true;
     }

     if (elgg_annotation_exists($entity->guid, 'no')) {
        $data['is_supporting'] = false;
        
     }
    


$like = elgg_view('output/url', array(
    'href' => $likeUrl,
    'text' => '<i class="fas fa-thumbs-up"></i>',
    'class' => 'elgg-menu-content elgg-button elgg-button-action',
    'confirm' => true,
));


$dislikeUrl= "action/debates/support?guid=$entityGuid&value=no";


$dislike = elgg_view('output/url', array(
    'href' => $dislikeUrl,
    'text' => '<i class="fas fa-thumbs-down"></i>',
    'class' => 'elgg-menu-content elgg-button elgg-button-action',
    'confirm' => true,
));


$data['site_url'] = $site_url;
$data['like_button'] = new \Twig\Markup($like, 'UTF-8');
$data['can_support'] = $canSupport;
$data['totals'] = $totals;
$data['dislike_button'] = new \Twig\Markup($dislike, 'UTF-8');


echo $twig->render('layouts/single_sidebar.html.twig', 
    [
        'data' => $data,
    ]);