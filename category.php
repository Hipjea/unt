<?php
/**
Template Name: ListeActualites
 */

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\NewsService $newsService */
global $newsService;

$pagination = 1;
if(isset($_GET['pagination']) and $_GET['pagination'] > 0) {
    $pagination = $_GET['pagination'];
}

$category = get_queried_object();
$timberContext['newsList'] = $newsService->getNewsList($pagination, $category);
$timberContext['subCategories'] = $newsService->getSubcategories($category);
$timberContext['newsCount'] = $category->count;
$timberContext['newsPage'] = $pagination;
$timberContext['newsPerPage'] = $newsService->getNewsPerPage();
$timberContext['pageCount'] = ceil($category->count / $newsService->getNewsPerPage());

$timberContext['titrePage'] = $category->name;
$templates = ['news-list.twig'];
Timber::render($templates, $timberContext);