<?php

namespace Unt\Services;

//require_once  __DIR__ . '/../../../../plugins/un-sendgrid/services.php';

use Timber\Timber;
use Timber\Post;

class NewsletterService {
    /**
     * @return Bool
     */
    public function setEmail(String $email) {
        $service = new \UnSendgrid\UnSendgridService();
        return $service->subscribeEmail($email);
    }

    /**
     * @return string
     */
    public function getNewsletterListId(): string {
        /** @var Post $post */
        $post = Timber::get_post();
        $listId = get_option('unsendgrid_newsletter_listid');
        return $listId;
    }

    /**
     * @return String
     */
    public function getContact(String $email) {
        $service = new \UnSendgrid\UnSendgridService();
        return $service->getContact($email);
    }
}
