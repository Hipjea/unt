<?php

namespace Unt\Services;

use function Sodium\add;
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
}
