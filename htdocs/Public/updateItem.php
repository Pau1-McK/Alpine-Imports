<?php
try {
    require "./common.php";
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
<h2>Update Products</h2>
<table border="1px solid black">
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
                    <th>Edit</th>
           
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
                <td><a href="updateItemSingle.php?CarVin=<?php echo escape($row["CarVin"]);
                                                    ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>