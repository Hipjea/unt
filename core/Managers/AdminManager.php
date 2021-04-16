<?php

namespace Unt\Managers;

use Unt\Services\AssetService;

/**
 * Class AdminManager
 * @package Unt\Managers
 *
 * Load scripts in the administration + render app version
 */
class AdminManager {
    /** @var AssetService */
    private $assetService;

    public function __construct(AssetService $assetService) {
        $this->assetService = $assetService;
    }

    public function init() {
        add_filter('update_footer', [$this, 'renderVersionNumber'], 1000);
    }

    public function renderVersionNumber($msg) {
        return "UNT " . UNT_APP_VERSION . ' -- ' . $msg;
    }
}
