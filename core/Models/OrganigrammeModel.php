<?php

namespace Unt\Models;

use Timber\Post;

class OrganigrammeModel {
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
    public function getNomComplet(): string {
        return get_field('nom_complet', $this->post->id);
    }

    /**
     * @return string
     */
    public function getOrganisme(): ?string {
        return get_field('organisme', $this->post->id);
    }
    
    /**
     * @return string
     */
    public function getFonction(): string {
        return get_field('fonction', $this->post->id);
    }

    /**
     * @return string
     */
    public function getLinkedin(): ?string {
        return get_field('linkedin', $this->post->id);
    }

    /**
     * @return string
     */
    public function getTwitter(): ?string {
        return get_field('twitter', $this->post->id);
    }

    /**
     * @return string
     */
    public function getGithub(): ?string {
        return get_field('github', $this->post->id);
    }

    /**
     * @return string
     */
    public function getImageUrl(): ?string {
        return get_field('photo', $this->post->id);
    }
}