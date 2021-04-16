<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 08/04/2019
 * Time: 14:41
 */

namespace Unt\Models;

use Timber\Post;

class ALaUneModel
{
    /** @var Post */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->post->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->post->post_title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return get_field('description', $this->post->id);
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return get_field('image', $this->post->id);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return get_field('url', $this->post->id);
    }
}