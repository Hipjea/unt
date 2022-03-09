<?php
/**
Template Name: Contact
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = "Contact";
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$templates = [ 'contact.twig' ];
Timber::render( $templates, $timberContext );