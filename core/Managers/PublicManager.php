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
        $bootstrap = $this->assetService->getUri() . '/bootstrap.js';
        wp_enqueue_script('unt-public-bootstrap', $bootstrap, '', '', true);
        $vendor = $this->assetService->getUri() . '/vendor.js';
        wp_enqueue_script('unt-public-vendor', $vendor, '', '', true);
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
