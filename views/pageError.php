<?php

/* 
 * Page Error View
 */

?>
<div class="error_page">
<h1> 404 </h1>
<p class="error_message"> Requested page is not found </p>
</div>

<?php
header("Refresh: 6; URL= index.php?action=login");
exit();