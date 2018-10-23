<?php
$timber = new \Timber\Timber();
$context = $timber->get_context();
$context['post'] = new Timber\Post(); // It's a new Timber\Post object, but an existing post from WordPress.

Timber::render('templates/page.twig', $context);
?>
