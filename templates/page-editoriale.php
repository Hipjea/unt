<?php
/**
Template Name: Editorial
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = $timberContext['post']->{'post_title'};
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$templates = ['page-editorial.twig'];
Timber::render($templates, $timberContext);