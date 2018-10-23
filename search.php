<?php
/*
Template Name: Search Page
*/
global $query_string;

wp_parse_str( $query_string, $search_query );
$timber = new \Timber\Timber();
$context = $timber->get_context();
$context['post'] = new Timber\Post(); // It's a new Timber\Post object, but an existing post from WordPress.
$context['search'] = Timber::get_posts($search_query);
$context['query'] = $s;

Timber::render('templates/search.twig', $context);

 ?>
