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

// fetch id from url
$id = $_GET['id'];


// FOR UPDATe
if(isset($_POST['name']) && !empty($id)){
    $firstname = $_POST['name'];
    $success= $userObj->update($firstname, $id);
    if($success){
       echo 'Updated';
    }else{
        echo 'Failed';
    }
    // header('Location: /');
}


// fetch user 
$user = $userObj->fetchUser($id);


$headerTitle = 'Update '. $user['name'] .' Information';
require_once 'layout/header.php';
?>


<form method="POST" action="">
<input type="text" name="name" placeholder="Name" value="<?php echo $user['name'];?>">
<button type="submit">Update</button>
</form>


<?php
if($user['name'] == 'Lynol') 
echo ' <h1>This is lynol</h1>';
?>
  



<?php
require_once 'layout/footer.php';
?>