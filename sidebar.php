<?php
/* sidebar.php */

use Timber\Timber;

global $sidebarContext;

$sidebarContext = array();
$sidebarContext['widget'] = dynamic_sidebar('widget-sidebar');

Timber::render('sidebar.twig', $sidebarContext);
