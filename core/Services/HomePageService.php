<?php

namespace Unt\Services;

use Timber\Post;
use Timber\Timber;
use Unt\Models\HomePageModel;

class HomePageService {
    /**
     * @return HomePageModel
     */
    public function getHomePageData() : HomePageModel {
        /** @var Post $post */
        $post = Timber::get_post();
        return new HomePageModel($post);
    }

    /**
     * @return Timber\Post
     */
    public function getProjectsPageId() : int {
        $args = [
            'post_type' => 'page',
            'post_parent' => 0,
            'fields' => 'ids',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'templates/project.php'
        ];
        $pages = get_posts($args);
        return $pages[0];
    }
}
