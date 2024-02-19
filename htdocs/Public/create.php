<?php
require "templates/header.php";

?>
<h2>Add a user</h2>
<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="email" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <label for="is_admin">Accoubt level</label>
    <input type="is_admin" name="is_admin" id="is_admin">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
<?php include "templates/footer.php";

// Import the customer class
require_once './customer.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create a new instance of the customer class
    $customer = new customer($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['age'], $_POST['location'], $_POST['password'],$_POST['is_admin']);

    // Set the properties of the customer object using the form data
    $customer->setFirstname($_POST['firstname']);
    $customer->setLastname($_POST['lastname']);
    $customer->setEmail($_POST['email']);
    $customer->setAge($_POST['age']);
    $customer->setLocation($_POST['location']);
    $customer->setPassword($_POST['password']);
    $customer->setIsadmin($_POST['is_admin']);


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
        echo "<div class='success'>You have successfully signed up!</div>";

    } catch(PDOException $e) {

        if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {

            echo "<div class='dupEmail'>Email address already exists.</div>";

        } else {

            echo "<div class='error'>Error: " . $e->getMessage() . "</div>";

        }
    }

    // Close the database connection
    $conn = null;
}





?>