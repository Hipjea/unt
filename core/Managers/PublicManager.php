<?php

namespace Unt\Managers;

use Unt\Services\AssetService;

/**
 * Class PublicManager
 * @package Unt\Managers
 *
 * Load script in Public area
 */
class PublicManager {
    /** @var AssetService */
    private $assetService;

    public function __construct(AssetService $assetService) {
        $this->assetService = $assetService;
    }

    public function init() {
        add_action("wp_enqueue_scripts", [$this, 'initScripts']);
        add_action("wp_enqueue_scripts", [$this, 'initStyles']);
    }

    public function initScripts() {
        // JQuery
        $jquery = $this->assetService->getUri() . '/vendors/jquery/jquery.min.js';
        wp_enqueue_script('unt-public-jquery', $jquery, '', '', true);
        // JQuery
        $jqueryui = $this->assetService->getUri() . '/vendors/jquery-ui/jquery-ui.min.js';
        wp_enqueue_script('unt-public-jqueryui', $jqueryui, '', '', true);
        // JSTree
        $jstree = $this->assetService->getUri() . '/vendors/jstree/jstree.js';
        wp_enqueue_script('unt-public-jstree', $jstree, '', '', true);
        // OwlCarousel
        $owlcarousel = $this->assetService->getUri() . '/vendors/owlcarousel/owl.carousel.min.js';
        wp_enqueue_script('unt-public-owlcarousel', $owlcarousel, '', '', true);
        // Ponyfill
        $ponyfill = $this->assetService->getUri() . '/vendors/ponyfill/css-vars-ponyfill.min.js';
        wp_enqueue_script('unt-public-ponyfill', $ponyfill, '', '', true);
        // Bootstrap
        $bootstrap = $this->assetService->getUri() . '/bootstrap.js';
        wp_enqueue_script('unt-public-bootstrap', $bootstrap, '', '', true);
        // FontAwesome
        $fonts = $this->assetService->getUri() . '/fontawesome.js';
        wp_enqueue_script('unt-public-fonts', $fonts, '', '', true);
        // Lazyload
        $lazyload = $this->assetService->getUri() . '/vendors/vanilla-lazyload/dist/lazyload.min.js';
        wp_enqueue_script('unt-public-lazyload', $lazyload, '', '', true);
        // Unpoly
        $unpoly = $this->assetService->getUri() . '/vendors/unpoly/unpoly.min.js';
        wp_enqueue_script('unt-public-unpoly', $unpoly, '', '', true);
        // App
        $src = $this->assetService->getUri() . '/app.js';
        wp_enqueue_script('unt-public', $src, '', '', true);
    }

    public function initStyles() {
        $bootstrap = $this->assetService->getUri() . '/bootstrap.css';
        wp_register_style('unt-public-bootstrap', $bootstrap, array(), null);
        wp_enqueue_style('unt-public-bootstrap', $bootstrap, array(), null);
        $unpoly = $this->assetService->getUri() . '/unpoly.css';
        wp_register_style('unt-public-unpoly', $unpoly, array(), null);
        wp_enqueue_style('unt-public-unpoly', $unpoly, array(), null);
        $src = $this->assetService->getUri() . '/app.css';
        wp_register_style('unt-public-css', $src, array(), null);
        wp_enqueue_style('unt-public-css', $src, array(), null);
    }

    public function enqueueNoticeScripts() {
        $src = $this->assetService->getUri() . '/notice.js';
        wp_enqueue_script('unt-public-notice', $src, '', '', true);
    }

    public function enqueueResultatsScripts() {
        $src = $this->assetService->getUri() . '/resultats.js';
        wp_enqueue_script('unt-public-resultats', $src, '', '', true);
    }
}
