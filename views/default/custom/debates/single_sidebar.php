<?php

$site_url = elgg_get_site_url();
$twig = debates_twig();

$entityGuid = elgg_extract('debate_guid', $vars);

$entity = get_entity($entityGuid);

$likeUrl = "action/debates/support?guid=$entityGuid&value=yes";

$canSupport = true;

$annotations = $entity->getAnnotations(
    [
        'annotation_name' => 'yes',    // The type of annotation
    ]);

$totalYes = $entity->getAnnotationsSum('yes');
$totalNo = $entity->getAnnotationsSum('no');

$totals = ['yes' => $totalYes, 'no' => $totalNo, 'total_votes' => ($totalNo + $totalYes)];



if (elgg_annotation_exists($entity->guid, 'yes') || elgg_annotation_exists($entity->guid, 'no')) {
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
    'text' => '<i class="bi bi-hand-thumbs-up-fill text-xl"></i>',
    'class' => 'inline-flex justify-center items-center size-[46px] rounded-full bg-blue-600 text-white dark:bg-blue-500',
    'style' => 'text-decoration: none',
    'confirm' => true,
));


$dislikeUrl = "action/debates/support?guid=$entityGuid&value=no";


$dislike = elgg_view('output/url', array(
    'href' => $dislikeUrl,
    'text' => '<i class="bi bi-hand-thumbs-down-fill text-xl"></i>',
    'class' => 'inline-flex justify-center items-center size-[46px] rounded-full bg-red-500 text-white dark:bg-blue-500',
    'style' => 'text-decoration: none',
    'confirm' => true,
));

$labels = [
    'not_supporting' => elgg_echo('debates:not_supporting'),
    'supporting' => elgg_echo('debates:supporting'),
    'total_votes' => elgg_echo('debates:total_votes'),
    'total_support' => elgg_echo('debates:total_support'),
    'total_against' => elgg_echo('debates:total_against'),
    'sidebar_title' => elgg_echo('debates:sidebar_title'),
];


$data['site_url'] = $site_url;
$data['like_button'] = new \Twig\Markup($like, 'UTF-8');
$data['can_support'] = $canSupport;
$data['totals'] = $totals;
$data['dislike_button'] = new \Twig\Markup($dislike, 'UTF-8');


echo $twig->render(
    'debates/layouts/single_sidebar.html.twig',
    [
        'data' => $data,
        'labels' => $labels,
    ]
);
