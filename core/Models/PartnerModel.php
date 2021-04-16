<?php

namespace Unt\Models;

use Timber\Post;

class PartnerModel {
    /** @var Post */
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->post->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->post->post_title;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string {
        return get_field('logo', $this->post->id);
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return get_field('url', $this->post->id);
    }
}