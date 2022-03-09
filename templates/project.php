<?php
/**
Template Name: Project
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = $timberContext['post']->{'post_title'};
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$children = $timberContext['post']->{'children'};

foreach ($children as $child) {
    if ($child->post_content != "") {
        $top_image_id = $child->top_image;
        $child->topImage = new \Timber\Image($top_image_id);
        $timberContext['project_children'][] = $child;
    }
}

$templates = ['project.twig'];
Timber::render($templates, $timberContext);