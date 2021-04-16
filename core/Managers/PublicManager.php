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
    }

    public function initScripts() {
        $src = $this->assetService->getUri() . '/app.js';
        wp_enqueue_script('unt-public', $src, '', '', true);
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
