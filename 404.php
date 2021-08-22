<?php

/* 
 * Page not Found
 */

require 'controllers/ViewController.php';

$view = new ViewController();

$view->header();
$view->pageError();
$view->footer();
?>

