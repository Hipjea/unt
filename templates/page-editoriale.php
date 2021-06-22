<?php
/**
Template Name: Editorial
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = $timberContext['post']->{'post_title'};

$templates = ['page-editorial.twig'];
Timber::render($templates, $timberContext);