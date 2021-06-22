<?php

namespace Unt\Services;

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
if (is_plugin_active('un-sendgrid/un-sendgrid.php')) {
    require_once  __DIR__ . '/../../../../plugins/un-sendgrid/services.php';
}

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
