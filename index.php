<?php
$timber = new \Timber\Timber();
$context = $timber->get_context();
$context['post'] = new \Timber\Post();
Timber::render('templates/news-single.twig', $context);
?>
