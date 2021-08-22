<?php

/* 
 * Success View
 */

?>

<div class="error_page">
<h1> Success </h1>
<p class="error_message"> User created successfully </p>
</div>

<?php
header("Refresh: 6; URL= index.php?action=".$formtype);
exit();