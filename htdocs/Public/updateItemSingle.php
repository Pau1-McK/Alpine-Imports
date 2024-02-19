<?php

/**
 * Use an HTML form to edit an entry in the
 * products table.
 *
 */
require "./common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $products = [
            "CarVin" => escape($_POST['CarVin']),
            "CarReg" => escape($_POST['CarReg']),
            "CarPrice" => escape($_POST['CarPrice']),
            "CarMake" => escape($_POST['CarMake']),
            "CarColor" => escape($_POST['CarColor']),
            "CarImage" => escape($_POST['CarImage']),
            "CarModel" => escape($_POST['CarModel']),
            "CarEngineSize" => escape($_POST['CarEngineSize']),
            "CarMileage" => escape($_POST['CarMileage']),
        ];
        $sql = "UPDATE products
            SET CarVin = :CarVin,
            CarReg = :CarReg,
            CarPrice = :CarPrice,
            CarMake = :CarMake,
            CarColor = :CarColor,
            CarImage = :CarImage,
            CarModel = :CarModel,
            CarEngineSize = :CarEngineSize,
            CarMileage = :CarMileage
            
            WHERE CarVin = :CarVin";
        $statement = $connection->prepare($sql);
        $statement->execute($products);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['CarVin'])) {
    try {
        require_once '../src/DBconnect.php';
        $CarVin = $_GET['CarVin'];
        $sql = "SELECT * FROM products WHERE CarVin = :CarVin";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':CarVin', $CarVin);
        $statement->execute();
        $products = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['CarVin']); ?> successfully updated.
<?php endif; ?>
<h2>Edit a products</h2>
<form method="post">
    <?php foreach ($products as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" CarVin="<?php echo $key;
                                                            ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'CarVin' ?
                                                'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
<a href="index.php">Back to home</a>
