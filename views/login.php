<?php

/* 
 * Login View
 */

?>
<div class="login_page">
    <form action="controllers/FormController.php" method="post">
        <h1> Login </h1>
        <label>Username</label>
        <input type="text" name="username" class="inputbox" />
        <label>Password</label>
        <input type="password" name="password" class="inputbox" />
        <input type="hidden" name="formtype" value="login" />
        <input type="hidden" name="session_token" value="<?php echo $session_token; ?>" />
        <input type="submit" name="submitform" class="inputsubmit" />
    </form>
    <a href="index.php?action=register" class="signup_link">Sign Up</a>
</div>