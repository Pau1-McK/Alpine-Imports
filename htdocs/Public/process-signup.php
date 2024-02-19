<?php

use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;

if (empty($_POST["firstname"])) { 

    die("Firstname is required!");
}

if (empty($_POST["lastname"])) { 
    
    die("Lastname is required!");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be atleat 9 characters");

}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

// Import the customer class
require_once './customer.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create a new instance of the customer class
    $customer = new customer($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['age'], $_POST['location'], $_POST['password'],0);

    // Set the properties of the customer object using the form data
    $customer->setFirstname($_POST['firstname']);
    $customer->setLastname($_POST['lastname']);
    $customer->setEmail($_POST['email']);
    $customer->setAge($_POST['age']);
    $customer->setLocation($_POST['location']);
    $customer->setPassword($_POST['password']);
    $customer->setIsadmin(0);

    // Check if the required fields are empty
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Please fill in all required fields.";
    }

    // If there are no errors, insert the data into the database
    if (!isset($error)) {

        require "../src/DBconnect.php";

        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        // Use a prepared statement to insert the data into the database
        $sql = "INSERT INTO users (firstname, lastname, email, age, location, password, is_admin)
                VALUES (:firstname, :lastname, :email, :age, :location, :password, :is_admin)";

        $stmt = $conn->prepare($sql);

        $firstname = $customer->getFirstname();
        $stmt->bindParam(':firstname', $firstname);

        $lastname = $customer->getLastname();
        $stmt->bindParam(':lastname', $lastname);

        $email = $customer->getEmail();
        $stmt->bindParam(':email', $email);

        $age = $customer->getAge();
        $stmt->bindParam(':age', $age);

        $location = $customer->getLocation();
        $stmt->bindParam(':location', $location);

        $password = $customer->getPassword();
        $stmt->bindParam(':password', $password);

        $is_admin = $customer->getIsadmin();
        $stmt->bindParam(':is_admin', $is_admin);


        

        try {
            $stmt->execute();
            echo "<div class='success'></br>You have successfully signed up!</div>";

        } catch(PDOException $e) {

            if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {

                echo "<div class='dupEmail'></br>Email address already exists.</div>";

            } else {

                echo "<div class='error'>Error: " . $e->getMessage() . "</div>";

            }
        }
    
        

        // Close the database connection
        $conn = null;

    }
}