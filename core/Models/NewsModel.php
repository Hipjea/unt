<?php

namespace Unt\Models;

use Timber\Post;

class NewsModel {
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
    public function getDescription(): string {
        return get_field('description', $this->post->id);
    }

    /**
     * @return string
     */
    public function getFullContent(): string {
        return $this->post->content();
    }

    /**
     * @return string
     */
    public function getImageUrl(): ?string {
        $custom_image = get_field('image', $this->post->id);
        if (isset($custom_image) && $custom_image != "") {
            return $custom_image;
        }
        return $this->get_da_image($this->post);
    }

    /**
     * Publication date
     * @return string
     */
    public function getDate(): string {
        return $this->post->date('d/m/Y');
    }

    /**
     * @return string
     */
    public function getNewsUrl(): string {
        return $this->post->link();
    }

    /**
     * Retrives the post first image URL
     * @return string
     */
    private function get_da_image($post) {
        $img = '';
        ob_start();
        ob_end_clean();
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $img = @$matches[1][0];
        return $img;
    }

}