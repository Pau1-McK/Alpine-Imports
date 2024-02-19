
<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".//css/mainHeader.css">
    <title>Document</title>
</head>
<body>



    <header>
        <img class="logo" src="./images/rsz_alpine.png" alt="Company Logo">
        <nav>
            <ul class="nav_links">
            <li><a href="welcome.php">Home</a></li>
                <li><a href="./productsPage.php">Inventory</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact us</a></li>
                <li><a href="./FAQ.php">FAQ</a></li>
            </ul>
        </nav>


       <div class="dropdown">
            <button class="cta"><?php echo "Hello!" ."  ". $_SESSION["user_firstName"]; ?></button>
            <div class="dropdown-content">
            <a href="/Public/profile.php">Profile</a>
            <hr>
            <a href="transationHistory.php">Transaction History</a>
            <hr>
            <a href="logout.php">Log out</a>
             
                
            </div>
            
        </div>

    </header>
