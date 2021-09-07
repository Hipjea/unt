<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 15/05/2019
 * Time: 17:33
 */

namespace Unt\Services;

class ConfigService {
    /**
     * @return array of config
     */
    public function getAppConfig() : array {
        $result = [
            'currentUrl' => $_SERVER['REQUEST_URI'],
            'serverDocuments' => SERVER_DOCUMENTS,
            'solrUrl' => SOLR_URL,
            'noticeIndex' => NOTICE_INDEX,
            'autocompIndex' => AUTOCOMPLETE_INDEX,
            'suplomIndex' => SUPLOM_INDEX
        ];
        return $result;
    }

    public function getAppStrings() : array {
        return APP_STRINGS;
    }

    public function getCurrentLanguage() : string {
        return 'fr';
    }
}
