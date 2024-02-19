<?php
session_start();
require "./templates/main-header.php";
require "./sessionData.php";
require "../src/DBconnect.php"; // not adding !

try {
    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


// Check if the form has been submitted
if(isset($_POST["sendForm"])) {
  // Retrieve the form data
  $user_id = $_SESSION["user_id"];
  $description = $_POST["comment"];

  // Insert the data into the database
  $stmt = $pdo->prepare("INSERT INTO `contact-us` (user_id, description) VALUES (:user_id, :description)");

  $stmt->execute([
    "user_id" => $user_id,
    "description" => $description
  ]);
  header("Location: ./contact.php");
  exit;
}
?>

<div class="ContactCenter">
  <h1 class="ContactHeading">Contact us</h1>
  <p>Thank you for your interest in contacting us! We would love to hear from you and are here to answer any questions you may have.</p>
  <br><br>
  <div class="form-style" id="contact-form">
    <form action="" method="post">
      <input type="text" name="firstname" placeholder="<?php echo escape($_SESSION["user_firstName"]) . ' ' . escape($_SESSION["user_lastName"]);?>" readonly>
      <input type="text" name="email" placeholder="<?php echo escape($_SESSION["user_email"]);?>" readonly>
      
      <textarea name="comment">Enter text here...</textarea><br><br>
      <input type="submit" name="sendForm" class="btn-form" value="Submit"> 
    </form><br><br>
  </div>
</div>

<script>
  const form = document.querySelector('#contact-form');

  // Listen for the form's submit event
  form.addEventListener('submit', function() {
    // Display an alert message
    alert('Form submitted!');
  });
</script>



<?php 
require "../Public/templates/footer.php"
?>


