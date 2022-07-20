<?php
/**
Template Name: Equipe
*/

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\EquipeService $equipeService */
global $equipeService;

$context = Timber::get_context();
$timberContext['post'] = Timber::get_post();
$timberContext['equipe'] = $equipeService->getEquipeList();
$timberContext['titrePage'] = $timberContext['post']->{'post_title'};
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$templates = ['equipe.twig'];
Timber::render($templates, $timberContext);