<?php
/**
Template Name: Home
*/

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\HomePageService $homePageService */
global $homePageService;

/** @var \Unt\Services\ALaUneService $aLaUneService */
global $aLaUneService;

/** @var \Unt\Services\SolrService $solrService */
global $solrService;

/** @var \Unt\Models\ThemeOptionsModel */
global $themeOptions;

$timberContext['homePageModel'] = $homePageService->getHomePageData();
$timberContext['aLaUneModel'] = $aLaUneService->getALaUneList();
$timberContext['partnersList'] = $partnerService->getPartnersList();

$projects = Timber::get_post(47);
$children = $projects->{'children'};

foreach ($children as $child) {
    if ($child->post_content != "") {
        $top_image_id = $child->top_image;
        $child->topImage = new \Timber\Image($top_image_id);
        $timberContext['projects_children'][] = $child;
    }
}
$timberContext['projects_children'] = array_reverse($timberContext['projects_children']);

if ($themeOptions->isSolrEnabled()) {
	$listeZoomSur = $solrService->getZoomSurResults($themeOptions->getZoomSolrRequest());
	if($listeZoomSur != null) {
	    $timberContext['listeZoomSur'] = new \Unt\Models\ResultatRechercheModel($listeZoomSur, 0);
	}
}

$timberContext['titrePage'] = "Page d'accueil";
$templates = [ 'home-page.twig' ];

Timber::render( $templates, $timberContext );