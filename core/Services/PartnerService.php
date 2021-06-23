<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\PartnerModel;

class PartnerService {
    private function parsePostIntoPartnerModel(Post $post) : PartnerModel {
        return new PartnerModel($post);
    }

    public function getPartnersList() : array {
        $results = [];

        /** @var Post $post */
        $postList = Timber::get_posts(array(
            'post_type' => 'partner',
            'numberposts' => -1,
            'orderby' => 'rand',
            'suppress_filters' => 0));

        foreach ($postList as $post) {
            $model = $this->parsePostIntoPartnerModel($post);
            array_push($results, $model);
        }

        return $results;
    }

    public function getCurrentPartner() : ?PartnerModel {
        $result = null;
        /** @var Post $post */
        $post = Timber::get_post();
        if (!is_null($post)) {
            $result = $this->parsePostIntoPartnerModel($post);
        }

        return $result;
    }
}