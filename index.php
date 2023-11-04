<?php

// import Database.php and UserManager.php files
require_once 'Database.php';
require_once 'UserManager.php';

// declare a new database connection
$dbObj = new Database();
// open database connection
$dbConnection = $dbObj->openConnection();
// declare a new user manager and pass the database connection
$userObj = new UserManager($dbConnection);
// fetch user list
$userList = $userObj->fetchAll();



?>


<?php
$headerTitle = 'This is homepage';
require_once 'layout/header.php';
?>



<table>

    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Action</th>
    </tr>


    <?php
    foreach ($userList as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo '<td> <a href="/PageUserUpdate.php?id='.$user['id'].'">Edit</a></td>';
        echo "</tr>";
    }
    ?>

</table>

<?php
require_once 'layout/footer.php';
?>