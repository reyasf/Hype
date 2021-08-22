<?php

/* 
 * Handle all the application action from here
 */

require 'controllers/ViewController.php';

session_start();

$session_token = uniqid();

$_SESSION['session_token'] = $session_token;

$view = new ViewController();

$request = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "login";

$view->header();

switch($request) {
    case "login":
        $view->login($session_token);
    break;
    case "register":
        $view->register($session_token);
    break;
    case "error":
        $view->error($_REQUEST["formtype"]);
    break;
    case "success":
        $view->success($_REQUEST["formtype"]);
    break;
    case "list":
        if(isset($_SESSION["username"])) {
            $view->list_users();
        } else {
            header("Location: index.php?action=login");
        }
    break;
    case "logout":
        if(isset($_SESSION["username"])) {
            unset($_SESSION["username"]);
            header("Location: index.php?action=login");
        }
    break;
    default:
        header("Location: 404.php");
    break;
}

$view->footer();