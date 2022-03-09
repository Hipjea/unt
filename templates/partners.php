<?php
/**
Template Name: PartnersList
*/

use Timber\Timber;

global $timberContext;


/** @var \Unit\Services\PartnerService $partnerService */
global $partnerService;

/** @var \Unit\Models\ThemeOptionsModel */
global $themeOptions;

$context = Timber::get_context();
$timberContext['post'] = Timber::get_post();
$timberContext['partnersList'] = $partnerService->getPartnersList();
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$timberContext['titrePage'] = "Nos membres";
$templates = ['partners-list.twig'];

Timber::render($templates, $timberContext);