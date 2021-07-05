<?php

namespace Unt\Models;


use Timber\Post;

class HomePageModel {
    /** @var Post */
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->post->content();
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
    public function getNewsletterForm(): string {
        $newsletterForm = "";

        $shortCode = get_field('newsletter_shortcode',  $this->post->id);
        if ($shortCode) {
            $newsletterForm = do_shortcode($shortCode) ;
        }

        return $newsletterForm;
    }

    /**
     * @return string
     */
    public function getNewsletterLink(): ?string {
        $link = get_field('lien_newsletter',  $this->post->id);
        return $link;
    }

    /**
     * @return string
     */
    public function getBlockProjects(): ?string {
        return $this->post->{'block_projects'};
    }
}