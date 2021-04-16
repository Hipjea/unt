<?php
/**
Template Name: Contact
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = "Contact";
$templates = [ 'contact.twig' ];
Timber::render( $templates, $timberContext );