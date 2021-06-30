<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Timber\Timber;
use Unt\Models\NewsModel;

global $timberContext;

/** @var \Unt\Services\NewsService $newsService */
global $newsService;

$post = new \Timber\Post();

$category = get_the_category($post->id)[0];
$args = array(
    'posts_per_page' => 4,
    'offset' => 0,
    'cat' => $category->id,
    'orderby' => 'ID',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 
);
$latest = get_posts($args);


$timberContext['news'] = $newsService->getCurrentNews();
$timberContext['categorie'] = $category;
$timberContext['latestPosts'] = array();

foreach($latest as $p) {
    $newPost = new \Timber\Post($p);
    $model = new NewsModel($newPost);
    $newPost->imageUrl = $model->getImageUrl($newPost);
    $timberContext['latestPosts'][] = $newPost;
}

//$timberContext['urlCategorie'] = get_category_link($category);

$templates = [ 'single.twig' ];
Timber::render( $templates, $timberContext );
