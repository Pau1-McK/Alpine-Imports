<?php 
session_start();
require "./templates/main-header.php";

try {
    require "./common.php";
    require_once '../src/DBconnect.php';

    $sql = "SELECT * FROM products LIMIT 3"; // You can adjust the limit as per your requirement
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

} catch (PDOException $error) {
     
    echo $sql . "<br>" . $error->getMessage();
}


?>
<div class="welcome-main">

    <div class="welcomeLanding">

        <h1 class="ContactHeading">Import High-Quality Cars from Japan</h1>   </br>
        <p>At Alpine Imports, we make it easy and affordable to import cars from Japan. Our selection includes a wide variety of makes and models, all of which are inspected and approved by our team of experts.</p>
        </br>
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

                        
                     
                    </td>
                </tr>
            </table>
        <?php endforeach;
        
        ?>
          
    </form>


        </br></br>
        <a href="productsPage.php" class="product-button">Shop Now</a>

    </div>


    <br><br>
<hr>


<br><br>
<h1 class="center-text">About Us</h1>
    <div class="aboutuss">
        
        <p>At Japan Cars, we're passionate about helping people import high-quality and reliable cars from Japan. Our team has years of experience in the industry and we work hard to provide a smooth and hassle-free importation process for our clients.</p>
        <p>We believe in providing transparent and honest communication throughout the process, and we're committed to ensuring that our clients are satisfied with the vehicles they import.</p>
        <br>
        <a href="about.php" class="product-button">Learn More</a>
    </div>



    </div> <br><br>



<?php 
require "../Public/templates/footer.php";
?>