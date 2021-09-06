<?php

namespace Unt\Services;

class AssetService {
    /**
     * @return string
     */
    public function getUri() : string {
        $themeUri = get_template_directory_uri();
        $env = strtolower(UNT_ENV);
        return sprintf('%s/assets_dist/%s', $themeUri, $env);
    }

    /**
     * @param string $vendorFilePath
     * @return string
     */
    public function getVendorUrl(string $vendorFilePath) : string {
        return sprintf('%s/vendors/%s', $this->getUri(), $vendorFilePath);
    }

    /**
     * @param string $imageName
     * @return string
     */
    public function getImageUrl(string $imageName) : string {
        return sprintf('%s/images/%s', $this->getUri(), $imageName);
    }
}
