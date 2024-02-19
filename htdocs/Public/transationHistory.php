<?php
session_start();
require "./templates/main-header.php";

try {
    require "./common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT * FROM purchase_history WHERE user_id = :user_id";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
} 

?>

<div class="product-center">




<table border="1px solid black">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Cart ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Purchase Date</th>
                    <th>Cart Price</th>
                </tr>
            </thead>
            <tbody>
            
                <?php foreach ($results as $result) { ?>
            
                      <td><?php echo escape($_SESSION["user_firstName"]); ?></td>
                        <td><?php echo escape($result['id']); ?></td>
                        <td><?php echo escape($result['user_id']); ?></td>
                        <td><?php echo escape($result['product_id']); ?></td>
                        <td><?php echo escape($result['purchase_date']); ?></td>
                        <td><?php echo escape($result['price']. " + VRT"); ?></p></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
       

</div>

</body>
</html> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php 
require "../Public/templates/footer.php"; 
?>