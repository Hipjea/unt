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

setup_postdata($post);

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
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

if (array_filter($categories, function($obj) {
        return $obj->name == "blog"; 
    })) {
    // Get the author infos if the category is "blog"
    $timberContext['author'] = get_the_author();
    $timberContext['authorAvatar'] = get_avatar(get_the_author_meta('ID'));
}

$templates = ['single.twig'];
Timber::render($templates, $timberContext);
