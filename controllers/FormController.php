<?php

/* 
 * Form actions are handled, data is validated and secured here
 */

include_once 'LoginController.php';
include_once 'RegisterController.php';
include_once 'ViewController.php';

class FormController {
    /*Secure the form data and validate the data*/
    public function secure_and_ValidateRequestData($fields) {
        $data = array();
        $error = array();
        foreach($fields as $field => $type) {
            $data[$field] = htmlspecialchars(trim($_POST[$field]));
            if($_POST[$field] === '') {
                array_push($error, $field);
            } else {
                switch($type) {
                    case "email":
                        if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
                            array_push($error, $field);
                        }
                    break;
                    case "confirmpassword":
                        if (strcmp($_POST[$field], $_POST["password"]) !== 0) {
                            array_push($error, $field);
                        }
                    break;
                }
            }
        }
        return array("data"=>$data,"error"=>$error);
    }
}

session_start();
if( isset( $_POST['submitform'] ) && $_POST['session_token'] === $_SESSION['session_token']) {
    $form_controller = new FormController();
    $form_action = null;
    switch($_POST['formtype']) {
        case "login":
            $form_action = new LoginController();
        break;
        case "register":
            $form_action = new RegisterController();
        break;
    }
    $fields = $form_action->fields;
    $secure_and_validate_data = $form_controller->secure_and_ValidateRequestData($fields);
    if(!empty($secure_and_validate_data["error"])) {
        $_SESSION['errors'] = $secure_and_validate_data["error"];
        header("Location: ../index.php?action=error&formtype=".$_POST['formtype']);
    } else {
        if($form_action !== null) {
            $form_action->processRequest($secure_and_validate_data["data"]);
        }
    }
    $_SESSION['session_token'] = "";
} else {
    echo "there is an issue";
}