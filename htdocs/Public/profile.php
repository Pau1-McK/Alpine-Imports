<?php
session_start();
require "./templates/main-header.php";

try {
    require "./common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':email', $_SESSION['user_email'], PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION["user_firstName"] = $result['firstname'];
    $_SESSION["user_lastname"] = $result['lastname'];
    $_SESSION["user_email"] = $result['email']; 
    $_SESSION["user_age"] = $result['age'];
    $_SESSION["user_location"] = $result['location'];
    $_SESSION["user_accountLevel"] = $result['is_admin'];

    $adminType =  $_SESSION["user_accountLevel"];

  
} catch (PDOException $error) {
    
    echo $sql . "<br>" . $error->getMessage();
} 


if($test = 0){

    $adminType  = "Admin Level";

} else if($test = 1){

    $adminType  = "User Level";
}


?>

<div class="product-center">

<h1><?php echo escape($_SESSION["user_firstName"]);?> <?php echo escape($_SESSION["user_lastname"]); ?> Profile</h1>
    
        <hr width="60%">
        <p>First Name - <?php echo escape($_SESSION["user_firstName"]); ?></p>
        <hr width="60%">
        <p>Last Name - <?php echo escape($_SESSION["user_lastname"]); ?></p>
        <hr width="60%">
        <p>Email - <?php echo escape($_SESSION["user_email"]); ?></p>
        <hr width="60%">
        <p>Age - <?php echo escape($_SESSION["user_age"]); ?></p> 
        <hr width="60%">
        <p>Location - <?php echo escape($_SESSION["user_location"]); ?></p>
        <hr width="60%">

        <p>Account level - <?php echo escape($adminType); ?></p>
        <hr width="60%">
    </div>

</body> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



  

<?php 
require "../Public/templates/footer.php";
?>