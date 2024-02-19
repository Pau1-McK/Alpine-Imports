<?php

/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submit'])) {
    try {
        require "./common.php";
        require_once '../src/DBconnect.php';
        $sql = "SELECT *
 FROM products
 WHERE CarMake = :CarMake";
        $CarMake = $_POST['CarMake'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':CarMake', $CarMake, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
require "templates/header.php";
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
?>
        <h2>Results</h2>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['CarMake']); ?>.
<?php }
} ?>
<h2>Find Car based on Make</h2>
<form method="post">
    <label for="CarMake">Make</label>
    <input type="text" id="CarMake" name="CarMake">
    <input type="submit" name="submit" value="View Results">
</form>
<a href="index.php">Back to home</a>





?>