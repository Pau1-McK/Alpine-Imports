<?php
if (isset($_POST['submit'])) {
    try {
        require "./common.php";
        require_once '../src/DBconnect.php';
        $sql = "SELECT *
 FROM users
 WHERE lastname = :lastname";
        $lastname = $_POST['lastname'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
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
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Account level</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo escape($row["id"]); ?></td>
                        <td><?php echo escape($row["firstname"]); ?></td>
                        <td><?php echo escape($row["lastname"]); ?></td>
                        <td><?php echo escape($row["email"]); ?></td>
                        <td><?php echo escape($row["age"]); ?></td>
                        <td><?php echo escape($row["location"]); ?></td>
                        <td><?php echo escape($row["date"]); ?> </td>
                        <td><?php echo escape($row["is_admin"]); ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['lastname']); ?>.
<?php }
} ?>
<h2>Find user based on lastname</h2>
<form method="post">
    <label for="lastname">lastname:</label>
    <input type="text" id="lastname" name="lastname">
    <input type="submit" name="submit" value="View Results">
</form>
<a href="index.php">Back to home</a>
