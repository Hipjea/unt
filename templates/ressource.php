<?php
/**
Template Name: Ressource
 */

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\SolrService $solrService */
global $solrService;

$currentNotice = new \Unt\Models\NoticeModel($solrService->getNoticeDetail($_GET['uuid']));

if($currentNotice->getDisplayInIframe()) {
    $timberContext['ressourceType'] = "iframe";
} elseif ($currentNotice->getRessourceType() == "html") {
    $timberContext['ressourceType'] = "html";
}
$timberContext['ressourceContent'] = $currentNotice->getRessource();
$timberContext['evaluationForm'] = $currentNotice->getEvaluationForm();
$timberContext['sidebar'] = Timber::get_sidebar('sidebar.php');

$timberContext['titrePage'] = "Ressource";
$templates = [ 'ressource.twig' ];
Timber::render( $templates, $timberContext );