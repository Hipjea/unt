<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 08/04/2019
 * Time: 12:03
 */

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\ALaUneModel;

class ALaUneService {
    private function parsePostIntoALaUneModel(Post $post) : ALaUneModel {
        return new ALaUneModel($post);
    }

    public function getALaUneList() : array {
        $results = [];

        /** @var Post $post */
        $postList = Timber::get_posts(array('post_type' => 'aLaUne', "suppress_filters" => 0));

        foreach ($postList as $post) {
            $model = $this->parsePostIntoALaUneModel($post);
            array_push($results, $model);
        }

        return $results;
    }

    public function getCurrentALaUne() : ?ALaUneModel {
        $result = null;
        /** @var Post $post */
        $post = Timber::get_post();
        if (!is_null($post)) {
            $result = $this->parsePostIntoALaUneModel($post);
        }

        return $result;
    }
}