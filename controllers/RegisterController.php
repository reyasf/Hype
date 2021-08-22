<?php

/* 
 * Handle registration action
 */

require_once '../model/Model.php';

class RegisterController extends Model{
    public $fields = ['username' => 'text', 'password' => 'password', 'confirmpassword' => 'confirmpassword', 'email' => 'email'];
    
    /* Process registration after securing and validation of the data */
    public function processRequest($data) {
        $this->insert_user($data);
    }
    
}
