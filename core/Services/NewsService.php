<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\NewsModel;

class NewsService {
    private function parsePostIntoNewsModel(Post $post) : NewsModel {
        return new NewsModel($post);
    }

    public function getNewsList(int $page) : array {
        $results = [];

        /** @var Post $post */
        $postList = Timber::get_posts(array('post_type' => 'post', 
                                            'posts_per_page' => 8, 
                                            'paged' => $page, 
                                            'suppress_filters' => 0, 
                                            'category_name' => 'actualites'));
        foreach ($postList as $post) {
            $model = $this->parsePostIntoNewsModel($post);
            array_push($results, $model);
        }

        return $results;
    }

    public function getNewsCount() : int {
        return $postList = count(Timber::get_posts(array('post_type' => 'post', 'suppress_filters' => 0)));
    }

    public function getCurrentNews() : ?NewsModel {
        $result = null;
        /** @var Post $post */
        $post = Timber::get_post();
        if (!is_null($post)) {
            $result = $this->parsePostIntoNewsModel($post);
        }

        return $result;
    }
}