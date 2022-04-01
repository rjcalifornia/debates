<?php
$site_url = elgg_get_site_url();
$twig = debates_twig();

echo $twig->render('debates/layouts/add_new_sidebar.html.twig', 
    [
        'data' => $data,
    ]);