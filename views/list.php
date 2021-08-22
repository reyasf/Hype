<?php

/* 
 * List View to list all the registered users
 */
require_once 'model/Model.php';
$model = new Model();
$list = $model->list_users();
?>
<div class="list_page">
    <h1> Users List </h1>
    <div class="table_container">
        <table>
            <thead>
                <th>Sl.No</th>
                <th>Username</th>
                <th>Email</th>
            </thead>
            <?php
                $row_id = 1;
                while($row=mysqli_fetch_assoc($list)){
                    echo "<tr><td class='slno'>".$row_id++."</td><td class='username'>".$row["username"]."</td><td class='email'>".$row["email"]."</td></tr>";
                }
            ?>
        </table>
    </div>
    <a href="index.php?action=logout" class="logout_link">Logout</a>
</div>