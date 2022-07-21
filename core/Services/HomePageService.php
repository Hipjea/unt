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
    public function getProjectsPageId() {
        $args = [
            'post_type' => 'page',
            'post_parent' => 0,
            'fields' => 'ids',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'templates/project.php'
        ];
        $pages = get_posts($args);
        return isset($pages[0]) ? $pages[0] : null;
    }

    /**
     * @return string
     */
    public function getParagrapheIntroduction(): ?string {
        return $this->post->{'paragraphe_dintroduction'};
    }

    /**
     * @return string
     */
    public function getBlockProjects(): ?string {
        return $this->post->{'block_projects'};
    }
}
