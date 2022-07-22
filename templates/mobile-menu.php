<?php
/**
Template Name: MobileMenu
*/

use Timber\Timber;

global $timberContext;

$templates = [ 'mobile-menu.twig' ];

Timber::render( $templates, $timberContext );
