<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * Template Name: error404
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Timber\Timber;

$timberContext['post'] = Timber::get_post();

global $timberContext;
Timber::render( '404.twig', $timberContext );
