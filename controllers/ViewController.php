<?php

/* 
 * Handle all the views
 */

class ViewController {
    public function login($session_token) {
        include_once 'views/login.php';
    }
    public function list_users() {
        include_once 'views/list.php';
    }
    public function register($session_token) {
        include_once 'views/register.php';
    }
    public function success($formtype) {
        include_once 'views/success.php';
    }
    public function error($formtype) {
        include_once 'views/error.php';
    }
    public function header() {
        include_once 'views/header.php';
    }
    public function footer() {
        include_once 'views/footer.php';
    }
    public function pageError() {
        include_once 'views/pageError.php';
    }
}