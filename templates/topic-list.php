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

$category = get_category_by_slug('actualites');
$timberContext['newsList'] = $newsService->getNewsList($pagination, $category);
$timberContext['newsCount'] = $newsService->getNewsCount($category);
$timberContext['newsPage'] = $pagination;
$timberContext['newsPerPage'] = $newsService->getNewsPerPage();
$timberContext['pageCount'] = ceil($newsService->getNewsCount($category) / $newsService->getNewsPerPage());

$timberContext['titrePage'] = "Actualités";
$templates = ['news-list.twig'];
Timber::render($templates, $timberContext);