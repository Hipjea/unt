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

global $timberContext;

/** @var \Unt\Services\NewsService $newsService */
global $newsService;

/** @var \Unt\Models\ThemeOptionsModel */
global $themeOptions;

$post = new \Timber\Post();

$categories = get_the_category($post->id);
array_map(function ($cat) {
    $cat->name = strtolower($cat->name);
    $cat->link = get_category_link($cat->cat_ID);
}, $categories);
$timberContext['news'] = $newsService->getCurrentNews();
$timberContext['category'] = $categories[0];
$timberContext['categories'] = $categories;
$timberContext['latestPosts'] = array();
$timberContext['latestPosts'] = $newsService->getLatestNews($post, $categories[0]);
$timberContext['twitter'] = @$themeOptions->getSocialSettings('twitter');

$templates = ['single.twig'];
Timber::render($templates, $timberContext);
