<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\OrganigrammeModel;

class OrganigrammeService {
    private function parsePostIntoModel(Post $post) : OrganigrammeModel {
        return new OrganigrammeModel($post);
    }

    public function getOrganigrammeList() : array {
        $results = [];

        /** @var Post $post */
        $postList = Timber::get_posts(array(
            'post_type' => 'organigramme', 
            'meta_key' => 'ordre',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'suppress_filters' => 0));

        $ogs = array_map(function ($ar) { return $ar->organisme; }, $postList);
        $organismes = array_unique($ogs);

        $i = 0;
        foreach ($organismes as $org) {
            $posts = wp_list_filter($postList, ['organisme' => $org]);
            array_push($results, array('name' => $org));
            foreach ($posts as $post) {
                $model = $this->parsePostIntoModel($post);
                array_push($results[$i], $model);
            }
            $i++;
        }

        return $results;
    }

    public function getCurrentOrganigramme() : ?OrganigrammeModel {
        $result = null;
        /** @var Post $post */
        $post = Timber::get_post();
        if (!is_null($post)) {
            $result = $this->parsePostIntoModel($post);
        }

        return $result;
    }
}