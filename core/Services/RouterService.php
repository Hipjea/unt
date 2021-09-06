<?php

namespace Unt\Services;

class RouterService {
    /**
     * @return string
     */
    public function getBaseUrl() : string {
        return get_home_url();
    }

    /**
     * @param string $uuid
     * @return string
     */
    public function getNoticeRoute(string $uuid, string $lang) : string {
        $route = '/notice'.$lang;
        $query = http_build_query(['lang' => $lang, 'uuid' => $uuid]);
        return $this->buildRoute($route, $query);
    }

    /**
     * @param string $uuid
     * @return string
     */
    public function getResultatsRoute(string $lang, string $sort, string $pagination, string $query) : string {
        $route = '/resultats'.$lang;
        $query = http_build_query(['lang' => $lang, 'sort' => $sort, 'pagination' => $pagination, 'query' => $query]);
        return $this->buildRoute($route, $query);
    }

    /**
     * @param string $uuid
     * @return string
     */
    public function getResultatsFiltreRoute(string $lang, string $sort, string $pagination, string $query, string $filtre) : string {
        $route = '/resultats'.$lang;
        $query = http_build_query(['lang' => $lang, 'query' => $query, 'sort' => $sort, 'pagination' => $pagination, 'facettes' => base64_encode($filtre)]);
        return $this->buildRoute($route, $query);
    }

    /**
     * @return string
     */
    public function getRessourceRoute(string $uuid, string $lang) : string {
        $route = '/ressource'.$lang;
        $query = http_build_query(['lang' => $lang, 'uuid' => $uuid]);
        return $this->buildRoute($route, $query);
    }

    /**
     * @param string $route
     * @param string|null $query
     * @return string
     */
    private function buildRoute(string $route, ?string $query = null) : string {
        $baseUrl = explode("?", $this->getBaseUrl())[0];
        if (!is_null($query)) {
            $url = sprintf('%s%s?%s', $baseUrl, $route, $query);
        } else {
            $url = sprintf('%s%s', $baseUrl, $route);
        }
        return $url;
    }
}
