<?php
session_start();
require "./templates/main-header.php";

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


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    foreach ($result as $row) {

        if (isset($_GET['add_to_cart_' . $row['CarVin']])) {
            // Add selected item to the cart
            if (!isset($_SESSION['cart'][$row['CarVin']])) {
                $_SESSION['cart'][$row['CarVin']] = array(
                    "CarMake" => $row["CarMake"],
                    "CarModel" => $row["CarModel"],
                    "CarReg" => $row["CarReg"],
                    "CarEngineSize" => $row["CarEngineSize"],
                    "CarMileage" => $row["CarMileage"],
                    "CarColor" => $row["CarColor"],
                    "CarPrice" => $row["CarPrice"],
                    "CarVin" => $row["CarVin"],
                );
            } else {
                $_SESSION['cart'][$row['CarVin']];
            }
        }
    }
}








?>



<h1 class="productPageHeading">Welcome to our stock</h1>


<div class="product-center">
    <form method="GET">
        <?php foreach ($result as $row) : ?>
            <table class="products-page">
                <tr>
                    <td>
                        <img src="./images/<?php echo $row['CarImage']; ?>" alt="" width="300" height="230"> <br><br>
                        
                        <?php echo escape($row["CarMake"]); ?>
                        <?php echo escape($row["CarModel"] . " / "); ?>
                        <?php echo escape($row["CarReg"]); ?> <br><br>

                        <?php echo escape($row["CarEngineSize"] . "L / "); ?>
                        <?php echo escape($row["CarMileage"]."Mi"); ?>  <br><br>

                        <?php echo escape($row["CarColor"] . " / "); ?>
                        <?php echo "€" . escape($row["CarPrice"]); ?> <br><br>

                        <input type="submit" name="add_to_cart_<?php echo $row['CarVin']; ?>" class="product-button" value="Add To Cart">
                        <input type="hidden" name="CarVin" value="<?php echo $row['CarVin']; ?>">
                     
                    </td>
                </tr>
            </table>
        <?php endforeach;

        
        
        function calculateTotal($cart) {
            $total = 0;
            $VRT = 0; 

            foreach ($cart as $item) {
                $total += $item['CarPrice'];
                if ($item['CarEngineSize'] > 1.5) {
                    $VRT += $item['CarPrice'] * 0.14; 
                } else {
                    $VRT += $item['CarPrice'] * 0.08;
                }
            }
            $remainingTotal = $total + $VRT;
            return array('total' => $total, 'VRT' => $VRT, 'remainingTotal' => $remainingTotal);
        }

        
        ?>
          
    </form>

    <script>
function showAlert() {
  alert("Checkout complete");
  exit;

}
</script>

    
<?php 



if (!empty($_SESSION['cart'])) {
    echo "<h1>Shopping Cart</h2>";
    echo '<table class="cart-table" border 1px solid black>';

    echo "<th>";
    echo "CarMake";
    echo "</th>";

    echo "<th>";
    echo "CarModel";
    echo "</th>";

    echo "<th>";
    echo "CarReg";
    echo "</th>";

    echo "<th>";
    echo "CarLiter";
    echo "</th>";


    echo "<th>";
    echo "CarPrice";
    echo "</th>";

    

    foreach ($_SESSION['cart'] as $item) {
        echo "<tr>";
        echo "<td>" . $item['CarMake'] . "</td>";
        echo "<td>" . $item['CarModel'] . "</td>";
        echo "<td>" . $item['CarReg'] . "</td>";
        echo "<td>" . $item['CarEngineSize'] . "</td>";
        echo "<td>" . $item['CarPrice'] . "</td>";
     
        echo "</tr>";

      

    }

    $totals = calculateTotal($_SESSION['cart']);

    echo "<tr><td colspan='4'></td></tr>"; // Empty row for spacing
    echo "<tr><td colspan='4'></td></tr>"; 
    echo "<tr>";
    echo "<td>Total:</td>";
    echo "<td>€" . $totals['total'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>VRT::</td>";
    echo "<td>€" . $totals['VRT'] . "</td>";
    echo "</tr>";
    echo "<tr><td colspan='2'></td></tr>"; // Empty row for spacing
    echo "<tr><td colspan='2'></td></tr>"; 
    echo "<tr>";
    echo "<td>Updated Total:</td>";
    echo "<td>€" . $totals['remainingTotal'] . "</td>";
    echo "</tr>";
    echo "</table>";

    echo '<form method="post">';
    echo '    <button type="submit" name="checkout" onclick="showAlert()">Checkout</button>';
    echo '</form>';

    

} else {
    echo "<p>Your shopping cart is empty.</p>";
}

?>

<?php

if (isset($_POST['checkout'])) {

    // Connect to the database using PDO
    $dsn = 'mysql:host=localhost;dbname=test;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }

    // Prepare the SQL query
    $sql = "INSERT INTO purchase_history (user_id, product_id, purchase_date, price) VALUES (:user_id, :product_id, NOW(), :price)";
    $stmt = $pdo->prepare($sql);


    // Insert the shopping cart data into the database
    foreach ($_SESSION['cart'] as $item) {
        $user_id = $_SESSION['user_id']; 
        $product_id = $item['CarVin'];
        $price = $item['CarPrice'];
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'price' => $price]);
        unset($_SESSION["cart"]);
       
    }   

    // Close the prepared statement and the database connection

    
    $stmt = null;
    $pdo = null;

    // Display a success message to the user
    echo "Your purchase has been completed!";





}

require "../Public/templates/footer.php";
?>





