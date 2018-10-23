<?php
/**
 * Template Name: Homepage
 */
 $timber = new \Timber\Timber();
 $context = $timber->get_context();
 $context['post'] = Timber::get_post();
 Timber::render('templates/home.twig', $context);

?>
