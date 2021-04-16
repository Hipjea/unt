<?php
/**
Template Name: Resultats
 */

use Timber\Timber;

global $timberContext;
// Enqueue Specific Script
/** @var \Unt\Managers\PublicManager $publicManager */
global $publicManager;
/** @var \Unt\Services\FooterService $footerService */
global $footerService;
/** @var \Unt\Services\SolrService $solrService */
global $solrService;
/** @var \Unt\Models\ThemeOptionsModel */
global $themeOptions;

if ($themeOptions->isSolrEnabled()) {
	
	$publicManager->enqueueResultatsScripts();
	
	
	if(isset($_GET['pagination']) and $_GET['pagination'] > 0) {
	    $page = $_GET['pagination'];
	} else {
	    $page = 1;
	}
	
	if($page == 1) {
	    $start = 0;
	} else {
	    $start = ($page*9)-9;
	}
	$sort = "score";
	if(isset($_GET['sort'])) {
	    $sort = $_GET['sort'];
	}
	
	$facettes = null;
	$encodedFacette = null;
	if(isset($_GET['facettes'])) {
	    $facettes = json_decode(base64_decode($_GET['facettes']));
	}
	$query = '';
	if(isset($_GET['query'])) {
	    $query = $_GET['query'];
	} else {
	    $sort = "date_publication";
	}
	
	$footerMenuList = $footerService->getFooterMenuList();
	$facettesList = $solrService->getFacettes($query, $facettes);
	$listeResultats = $solrService->getResults($query, $start, $facettes, $sort);
	
	$timberContext = array_merge($timberContext, $footerMenuList);
	
	if($listeResultats != null) {
	    $timberContext['resultats'] = new \Unt\Models\ResultatRechercheModel($listeResultats, $page);
	}
	$timberContext['currentUri'] = explode("?", $_SERVER['REQUEST_URI'])[0];
	$timberContext['universitePartage'] = "UNT";
	$timberContext['facettes'] = $facettesList;
	$timberContext['currentQuery'] = $query;
	$timberContext['currentSort'] = $sort;
	$timberContext['currentFacettes'] = $facettes;
	
	$timberContext['titrePage'] = "Résultats de recherche";
	$templates = [ 'resultats.twig' ];
	Timber::render( $templates, $timberContext );
} else {
	wp_redirect(home_url(), 301);
	exit;
}