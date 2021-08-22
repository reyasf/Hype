<?php

/* 
 * Error View
 */

$error_message["username"] = "Invalid username or password";
$error_message["password"] = "Invalid username or password";
$error_message["confirmpassword"] = "Passwords didn't match";
$error_message["email"] = "Email is invalid";
$error_message["existingemail"] = "User already exists with the email";

?>

<div class="error_page">
<h1> Input Error </h1>
<p class="error_message"> There is some issue with the <?= $formtype ?> submission </p>
<?php 
$errors = $_SESSION["errors"];
foreach($errors as $error) {
    echo "<p class='error_fields'>".$error_message[$error]."</p>";
}
?>
</div>

<?php
header("Refresh: 6; URL= index.php?action=".$formtype);
exit();