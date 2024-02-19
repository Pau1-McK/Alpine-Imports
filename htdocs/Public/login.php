<?php 

        require "./common.php";
        require_once '../src/DBconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $user = $statement->fetch();

    if ($user) {
        session_start();

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_firstName'] = $user['firstname'];
        $_SESSION['user_lastName'] = $user['lastname'];

        if ($user['is_admin']) {
            // if user has admin 

            header('Location: ./index.php');
        } else {
            
            header('Location: ./welcome.php');
        }
        exit();
    } else {
        echo "<div class='dupEmail'></br>Invalid email or password.</div>";
    }
}


require "./templates/login-header.php";
?>
</br>
<div class="login">
    <h1>Log in</h1>

  
  <form action="" method="post">
  
  <label for="email">Email*</label>
  <input type="email" id="email" name="email" required><br>


        <label for="password">Password</label>
        <input type="password" id="password" name="password" required><br>

         <input type="submit" value="Submit" class="btn">
        
</form>
  </div>

  <p>Don't have an account? <a href="./signup.php">Sign up</a></p>
    
</body>
</html>





   
   


