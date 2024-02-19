<?php 
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