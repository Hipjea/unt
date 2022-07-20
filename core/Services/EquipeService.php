<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\EquipeModel;

class EquipeService {
    private function parsePostIntoModel(Post $post) : EquipeModel {
        return new EquipeModel($post);
    }

    public function getEquipeList() : array {
        $results = [];

        /** @var Post $post */
        $postList = Timber::get_posts(array(
            'post_type' => 'equipe',
            'numberposts' => -1,
            'meta_key' => 'ordre',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'suppress_filters' => 0));

        foreach ($postList as $post) {
            $model = $this->parsePostIntoModel($post);
            array_push($results, $model);
        }

        return $results;
    }

    public function getCurrentEquipe() : ?EquipeModel {
        $result = null;
        /** @var Post $post */
        $post = Timber::get_post();
        if (!is_null($post)) {
            $result = $this->parsePostIntoModel($post);
        }
        return $result;
    }
}
