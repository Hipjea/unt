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

$category = get_the_category($post->id)[0];
$timberContext['news'] = $newsService->getCurrentNews();
$timberContext['categorie'] = $category;
$timberContext['latestPosts'] = array();
$timberContext['latestPosts'] = $newsService->getLatestNews($post, $category);
$timberContext['twitter'] = $themeOptions->getSocialSettings('twitter');

$templates = [ 'single.twig' ];
Timber::render( $templates, $timberContext );
