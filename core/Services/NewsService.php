<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\NewsModel;

class NewsService {
    const NEWSPERPAGE = 9;

    private function parsePostIntoNewsModel(Post $post) : NewsModel {
        return new NewsModel($post);
    }

    public function getNewsList(int $page, $category) : array {
        $results = [];
        if (isset($category->name)) {
            $query = array('post_type' => 'post', 
                'posts_per_page' => self::NEWSPERPAGE, 
                'paged' => $page, 
                'suppress_filters' => 0, 
                'category_name' => $category->name);
        } else {
            $query = array('post_type' => 'post', 
                'posts_per_page' => self::NEWSPERPAGE, 
                'paged' => $page, 
                'suppress_filters' => 0);
        }
        /** @var Post $post */
        $postList = Timber::get_posts($query);
        foreach ($postList as $post) {
            $model = $this->parsePostIntoNewsModel($post);
            array_push($results, $model);
        }
        return $results;
    }

    public function getSubcategories($category) : array {
        $topcategories = get_categories('child_of=' . $category->ID . '&hide_empty=1&parent=0');
        foreach ($topcategories as $topcategory) {
            $subcategories = get_categories('parent=' . $topcategory->cat_ID . '&hide_empty=1');
            $topcategories = array_merge($topcategories, $subcategories);
        }
        array_map(function ($cat) use ($category) {
            $cat->active = false;
            $cat->link = get_category_link($cat->cat_ID);
            if ($cat->cat_ID == $category->cat_ID) {
                $cat->active = true;
            }
        }, $topcategories);
        return $topcategories;
    }

    public function getNewsPerPage() : int {
        return self::NEWSPERPAGE;
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

    public function getLatestNews($currentpost, $category) : array {
        $results = array();
        $args = array(
            'posts_per_page' => 4,
            'offset' => 0,
            'cat' => $category->id,
            'orderby' => 'ID',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
            'suppress_filters' => true 
        );
        $latest = Timber::get_posts($args);
        
        foreach($latest as $post) {
            if ($post->ID != $currentpost->ID) {
                $newPost = new \Timber\Post($post);
                $model = $this->parsePostIntoNewsModel($newPost);
                $newPost->imageUrl = $model->getImageUrl($newPost);
                $newPost->postUrl = $model->getNewsUrl();
                $results[] = $newPost;
            }
        }
        return $results;
    }
}
