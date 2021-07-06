<?php
/**
Template Name: Organigramme
*/

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\OrganigrammeService $organigrammeService */
global $organigrammeService;

$context = Timber::get_context();
$timberContext['post'] = Timber::get_post();
$timberContext['organigramme'] = $organigrammeService->getOrganigrammeList();

$templates = ['organigramme.twig'];

Timber::render($templates, $timberContext);