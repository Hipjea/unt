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

$timberContext['newsList'] = $newsService->getNewsList($pagination);
$timberContext['newsCount'] = $newsService->getNewsCount();
$timberContext['newsPage'] = $pagination;

$timberContext['titrePage'] = "Actualités";
$templates = ['news-list.twig'];
Timber::render($templates, $timberContext);