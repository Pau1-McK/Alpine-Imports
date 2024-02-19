<?php
require "templates/header.php";

?>
<h2>Add a product</h2>
<form method="post">
    <label for="CarVin">Car Vin Number</label>
    <input type="text" name="CarVin" id="CarVin">

    <label for="CarReg">Car Reg Number</label>
    <input type="text" name="CarReg" id="CarReg">

    <label for="CarPrice">Car Value</label>
    <input type="text" name="CarPrice" id="CarPrice">

    <label for="CarMake">Make of the car</label>
    <input type="text" name="CarMake" id="CarMake">

    <label for="CarColor">Car Color</label>
    <input type="text" name="CarColor" id="CarColor">

    <label for="CarImage">Car Image</label>
    <input type="file" name="CarImage" id="CarImage">

    <label for="CarModel">Car Model</label>
    <input type="text" name="CarModel" id="CarModel">

    <label for="CarEngineSize">Car Engine Size</label>
    <input type="text" name="CarEngineSize" id="CarEngineSize">

    <label for="CarMileage">Car Mileage</label>
    <input type="text" name="CarMileage" id="CarMileage">


    <input type="submit" name="submit" value="Submit">
</br></br></br></br></br>

</form>
<a href="index.php">Back to home</a>
<?php include "templates/footer.php";

// Import the customer class
require_once './car.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create a new instance of the customer class
    $car = new car($_POST['CarVin'], $_POST['CarReg'], $_POST['CarPrice'], $_POST['CarMake'], $_POST['CarColor'], $_POST['CarImage'], $_POST['CarModel'],$_POST['CarEngineSize'], $_POST['CarMileage']);

    // Set the properties of the customer object using the form data
    $car->setCarVin($_POST['CarVin']);
    $car->setCarReg($_POST['CarReg']);
    $car->setCarPrice($_POST['CarPrice']);
    $car->setCarMake($_POST['CarMake']);
    $car->setCarColor($_POST['CarColor']);
    $car->setCarImage($_POST['CarImage']);
    $car->setCarModel($_POST['CarModel']);
    $car->setCarEngineSize($_POST['CarEngineSize']);
    $car->setCarMileage($_POST['CarMileage']);



    require "../src/DBconnect.php";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    // Use a prepared statement to insert the data into the database
    $sql = "INSERT INTO products (CarVin , CarReg, CarPrice, CarMake, CarColor, CarImage, CarModel, CarEngineSize, CarMileage)
            VALUES (:CarVin, :CarReg, :CarPrice, :CarMake, :CarColor, :CarImage, :CarModel, :CarEngineSize, :CarMileage)";

    $stmt = $conn->prepare($sql);

    $CarVin = $car->getCarVin();
    $stmt->bindParam(':CarVin', $CarVin);

    $CarReg = $car->getCarReg();
    $stmt->bindParam(':CarReg', $CarReg);

    $CarPrice = $car->getCarPrice();
    $stmt->bindParam(':CarPrice', $CarPrice);

    $CarMake = $car->getCarMake();
    $stmt->bindParam(':CarMake', $CarMake); 

    $CarColor = $car->getCarColor();
    $stmt->bindParam(':CarColor', $CarColor);

    $CarImage = $car->getCarImage();
    $stmt->bindParam(':CarImage', $CarImage);

    $CarModel = $car->getCarModel();
    $stmt->bindParam(':CarModel', $CarModel);

    $CarEngineSize = $car->getCarEngineSize();
    $stmt->bindParam(':CarEngineSize', $CarEngineSize);

    $CarMileage = $car->getCarMileage();
    $stmt->bindParam(':CarMileage', $CarMileage);



    try {
        
        if ($stmt->execute()) {
            echo "New record / item has been added";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->errorInfo();
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo "<div class='dupEmail'></br><bold>Vin Number is already in use</bold>.</div>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
    

    // Close the database connection
    $conn = null;
}





?>