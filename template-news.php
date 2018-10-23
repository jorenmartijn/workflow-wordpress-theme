<?php
/**
 * Template Name: Nieuws overzicht
 */
$timber = new \Timber\Timber();
$context = $timber->get_context();
$context['post'] = new Timber\Post(); // It's a new Timber\Post object, but an existing post from WordPress.
$context['projects'] = Timber::get_posts(array('post_type' => 'news', 'posts_per_page' => -1));

Timber::render('templates/news.twig', $context);
?>
