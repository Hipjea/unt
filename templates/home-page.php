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
$timberContext['projectsPageId'] = $homePageService->getProjectsPageId();
$timberContext['aLaUneModel'] = $aLaUneService->getALaUneList();
$timberContext['partnersList'] = $partnerService->getPartnersList();
$timberContext['isHomePage'] = true;


$projects = Timber::get_post($timberContext['projectsPageId']);
if (isset($projects)) {
    $children = $projects->{'children'};

    if (count($children) > 0) {
        $tmp = 0;
        foreach ($children as $child) if ($tmp < 3) {
            if ($child->post_content != "") {
                $top_image_id = $child->top_image;
                $child->topImage = new \Timber\Image($top_image_id);
                $timberContext['projects_children'][] = $child;
                $tmp++;
            }
        }
        $timberContext['projects_children'] = array_reverse($timberContext['projects_children']);
    }
}

if ($themeOptions->isSolrEnabled()) {
	$listeZoomSur = $solrService->getZoomSurResults($themeOptions->getZoomSolrRequest());
	if($listeZoomSur != null) {
	    $timberContext['listeZoomSur'] = new \Unt\Models\ResultatRechercheModel($listeZoomSur, 0);
	}
}

$timberContext['titrePage'] = "Page d'accueil";
$templates = [ 'home-page.twig' ];

Timber::render( $templates, $timberContext );