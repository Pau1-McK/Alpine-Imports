<?php

/**
 * Delete a product
 */
require "./common.php";

$success = "";
if (isset($_GET["CarVin"])) {
    try {
        require_once '../src/DBconnect.php';
        $CarVin = $_GET["CarVin"];
        $sql = "DELETE FROM products WHERE CarVin = :CarVin";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':CarVin', $CarVin);
        $statement->execute();
        $success = "Car " . $CarVin . " successfully deleted";
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
try {
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
<h2>Delete products</h2>
<?php if ($success) echo $success; ?>
<table border="1px solid black"
    <thead>
        <tr>
          
                    <th>CarVin</th>
                    <th>CarReg</th>
                    <th>CarMake</th>
                    <th>CarModel</th>
                    <th>CarEngineSize</th>
                    <th>CarMileage</th>
                    <th>CarPrice</th>
                    <th>CarColor</th>
                    <th>CarImage</th>
                    <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
            <td><?php echo escape($row["CarVin"]); ?></td>
                        <td><?php echo escape($row["CarReg"]); ?></td>
                        <td><?php echo escape($row["CarMake"]); ?></td>
                        <td><?php echo escape($row["CarModel"]); ?></td>
                        <td><?php echo escape($row["CarEngineSize"]); ?></td>
                        <td><?php echo escape($row["CarMileage"]); ?></td>
                        <td><?php echo escape($row["CarPrice"]); ?></td>
                        <td><?php echo escape($row["CarColor"]); ?></td>
                        <td><?php echo escape($row["CarImage"]); ?></td>
                <td><a href="deleteItem.php?CarVin=<?php echo escape($row["CarVin"]);
                                            ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>
