<?php

namespace Unt\Services;

/**
 * Class ApiService
 * Manage routes called in ajax from the client
 * @package Unt\Services
 */
class ApiService {
    private $solrService;

    public function __construct(SolrService $solrService) {
        $this->solrService = $solrService;
    }

    public function initApiRoutes() {
        add_action( 'rest_api_init', [$this, 'my_customize_rest_cors'], 15 );
        add_action( 'rest_api_init', [$this , 'registerAutocomRoute']);
    }

    public function registerAutocomRoute() {
        register_rest_route('app/v1', '/autocomp/(?P<query>\w+)', array(
            'methods' => 'GET',
            'callback' => [$this, 'autocompRoute'],
            'args' => [
                'query' => []
            ],
            'permission_callback' => '__return_true'
        ));
    }

    public function autocompRoute(\WP_REST_Request $request) {
        $query = $request->get_param('query');
        $result = $this->solrService->automplete($query);
        return $result;
    }

    function my_customize_rest_cors() {
        remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
        add_filter( 'rest_pre_serve_request', function( $value ) {
            $origin = get_http_origin();
            if ( $origin ) {
                header( 'Access-Control-Allow-Origin: ' . esc_url_raw( $origin ) );
            }
            header( 'Access-Control-Allow-Origin: ' . esc_url_raw( site_url() ) );
            header( 'Access-Control-Allow-Methods: GET' );

            return $value;

        });
    }
}
