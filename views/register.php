<?php

/* 
 * Register View
 */

?>
<div class="register_page">
    <form action="controllers/FormController.php" method="post">
        <h1> Register </h1>
        <label>Username</label>
        <input type="text" name="username" class="inputbox" />
        <label>Password</label>
        <input type="password" name="password" class="inputbox" />
        <label>Confirm Password</label>
        <input type="password" name="confirmpassword" class="inputbox" />
        <label>Email</label>
        <input type="text" name="email" class="inputbox" />
        <input type="hidden" name="session_token" value="<?php echo $session_token; ?>" />
        <input type="hidden" name="formtype" value="register" />
        <input type="submit" name="submitform" class="inputsubmit" />
    </form>
    <a href="index.php?action=login" class="signup_link">Sign In</a>
</div>

