<?php

require_once __DIR__ . '/vendor/autoload.php';

/// =================================
// Load configs
/// =================================
$confDir =  __DIR__ . '/config/';
foreach (scandir($confDir) as $file) {
    // load a file if it's a common config or a conf related to the current environment
    if (strpos($file, "config.php") !== false) {
        require_once __DIR__ . "/config/" . $file;
    }
}


/// =================================
// Init Services (related to UOH domain)
/// =================================
$homePageService = new \Unt\Services\HomePageService();
$GLOBALS['homePageService'] = $homePageService;

$aLaUneService = new \Unt\Services\ALaUneService();
$GLOBALS['aLaUneService'] = $aLaUneService;

$newsService = new \Unt\Services\NewsService();
$GLOBALS['newsService'] = $newsService;

$solrService = new \Unt\Services\SolrService();
$GLOBALS['solrService'] = $solrService;

$headerService = new \Unt\Services\HeaderService();
$GLOBALS['$headerService'] = $headerService;

$footerService = new \Unt\Services\FooterService();
$GLOBALS['footerService'] = $footerService;

$assetService = new \Unt\Services\AssetService();
$GLOBALS['assetService'] = $assetService;

$routerService = new \Unt\Services\RouterService();
$GLOBALS['routerService'] = $routerService;

$configService = new \Unt\Services\ConfigService();
$GLOBALS['configService'] = $configService;

$partnerService = new \Unt\Services\PartnerService();
$GLOBALS['partnerService'] = $partnerService;

$newsletterService = new \Unt\Services\NewsletterService();
$GLOBALS['newsletterService'] = $newsletterService;

// init ajax routes
$apiService = new \Unt\Services\ApiService($solrService);
$apiService->initApiRoutes();

/// =================================
// Init managers (related to WP)
/// =================================
$customizeManager = new \Unt\Managers\CustomizeManager($assetService);
$themeOptions = $customizeManager->getThemeOptions();
$GLOBALS['themeOptions'] = $themeOptions;

if (is_admin()) {
    $adminManager = new \Unt\Managers\AdminManager($assetService);
    $adminManager->init();
} else {
    $GLOBALS['publicManager'] = new \Unt\Managers\PublicManager($assetService);
    global $publicManager;
    $publicManager->init();
}

/// ==================================
/// Init common Timber context
/// ==================================
$GLOBALS['timberContext'] = \Timber\Timber::get_context();
global $timberContext;

$headerMenuList = $headerService->getHeaderMenuList();
$footerMenuList = $footerService->getFooterMenuList();
$configURLList = $configService->getAppConfig();
$appMessage = $configService->getAppMessages();
$currentLang = $configService->getCurrentLanguage();
$timberContext['header'] = $headerMenuList;
$timberContext['footer'] = $footerMenuList;
$timberContext['configURLList'] = $configURLList;
$timberContext['appMessage'] = $appMessage;
$timberContext['currentLang'] = $currentLang;
$timberContext['themeOptions'] = $themeOptions;
$timberContext['assets'] = $assetService;
$timberContext['router'] = $routerService;
$timberContext['site'] = new \Timber\Site();
$timberContext['siteTitle'] = get_bloginfo();


/// =================================
// Custom WP fonctions
/// =================================
function add_images_lazyloading($content) {
    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $dom = new DOMDocument();
    @$dom->loadHTML($content);

    foreach ($dom->getElementsByTagName('img') as $node) {  
        $oldsrc = $node->getAttribute('src');
        $node->setAttribute('data-src', $oldsrc);
        $tempsrc = get_theme_root_uri().'/assets/images/placeholder.png';
        $node->setAttribute('src', $tempsrc);
        $classes = $node->getAttribute('class');
        $node->setAttribute('class', $classes . ' lozad');
    }
    $newHtml = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace(
        array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML())
    );
    return $newHtml;
}

add_filter('the_content', 'add_images_lazyloading');

// Remove Wordpress generator meta
remove_action('wp_head', 'wp_generator');
// Remove Wordpress Emoji garbage
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');