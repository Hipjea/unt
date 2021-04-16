<?php
/**
Template Name: Newsletter
 */

use Timber\Timber;

global $timberContext;

/** @var \Unt\Services\NewsletterService $newsletterService */
global $newsletterService;

$context = Timber::get_context();
$timberContext['post'] = Timber::get_post();
if (isset($_POST['email'])) {
    $valid = is_email($_POST['email']);
    if ($valid) {
        $email = $_POST['email'];
        $timberContext['subscribed'] = $newsletterService->setEmail($email);
    }
}

$timberContext['titrePage'] = $timberContext['post']->{'post_title'};
$templates = ['newsletter.twig'];
Timber::render($templates, $timberContext);