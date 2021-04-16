<?php
/**
Template Name: Notice
 */

use Timber\Timber;

global $timberContext;

// Enqueue Specific Script
/** @var \Unt\Managers\PublicManager $publicManager */
global $publicManager;
/** @var \Unt\Services\SolrService $solrService */
global $solrService;

$publicManager->enqueueNoticeScripts();

if(isset($_GET['uuid'])) {
    $solrNotice = $solrService->getNoticeDetail($_GET['uuid']);
}

if(isset($solrNotice)) {
    $currentNotice = new \Unt\Models\NoticeModel($solrNotice);

    $noticesList = [];{
        if($currentNotice->getAPourPrerequisUuid() != null)
            foreach ($solrService->getNoticesDetail($currentNotice->getAPourPrerequisUuid()) as $notice) {
                $newNotice = new \Unt\Models\NoticeModel($notice);
                $newNotice->setAssociationType("noticeRelationAPourPrerequis");
                array_push($noticesList, $newNotice);
            }
    }

    if($currentNotice->getEstPrerequisDeUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getEstPrerequisDeUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationEstPrerequisDe");
            array_push($noticesList, $newNotice);
        }
    }

    if($currentNotice->getContientUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getContientUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationContient");
            array_push($noticesList, $newNotice);
        }
    }

    if($currentNotice->getEstPartiDeUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getEstPartiDeUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationEstPartieDe");
            array_push($noticesList, $newNotice);
        }
    }

    if($currentNotice->getReferenceUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getReferenceUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationReference");
            array_push($noticesList, $newNotice);
        }
    }

    if($currentNotice->getEstReferenceParUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getEstReferenceParUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationEstReferencePar");
            array_push($noticesList, $newNotice);
        }
    }

    if($currentNotice->getAssocieAUuid() != null) {
        foreach ($solrService->getNoticesDetail($currentNotice->getAssocieAUuid()) as $notice) {
            $newNotice = new \Unt\Models\NoticeModel($notice);
            $newNotice->setAssociationType("noticeRelationEstAssocieA");
            array_push($noticesList, $newNotice);
        }
    }
    $timberContext['noticeRelations'] = $noticesList;

    $timberContext['noticeModel'] = $currentNotice;
}

if(isset($_SERVER['HTTP_REFERER'])) {
    $timberContext['lienRetourRecherche'] = $_SERVER['HTTP_REFERER'];
}
$timberContext['universitePartage'] = "UNT";
$timberContext['currentUrl'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$timberContext['serverDocuments'] = SERVER_DOCUMENTS;
$timberContext['serverSuplom'] = SERVER_SUPLOM;

if(isset($solrNotice)) {
    $timberContext['titrePage'] = $currentNotice->getTitre();
} else {
    $timberContext['titrePage'] = "404";
}

$templates = [ 'notice.twig' ];

Timber::render( $templates, $timberContext );