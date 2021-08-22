<?php

/* 
 * Handle login action
 */

require_once '../model/Model.php';

class LoginController extends Model{
    public $fields = ['username' => 'text', 'password' => 'text'];
    
    /* Process login after securing and validation of the data */
    public function processRequest($data) {
        $this->select_user($data);
    }
}

