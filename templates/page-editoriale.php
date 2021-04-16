<?php
/**
Template Name: Editorial
 */

use Timber\Timber;

global $timberContext;

$timberContext['post'] = Timber::get_post();

$timberContext['titrePage'] = $timberContext['post']->{'post_title'};

$children = $timberContext['post']->{'children'};

foreach ($children as $child) {
    if ($child->post_content != "") {
        $top_image_id = $child->top_image;
        $child->topImage = new \Timber\Image($top_image_id);
        $timberContext['editorial_children'][] = $child;
    }
}


$templates = ['page-editorial.twig'];
Timber::render($templates, $timberContext);