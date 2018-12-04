<?php
require_once 'database_config.php';

if(isset($_POST['submitButton'])){
    
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $pass = !empty($_POST['psw']) ? trim($_POST['psw']) : null;

    //Hashing the password
    $hash= password_hash($pass, PASSWORD_BCRYPT);
    
    //Check if username already exists.
    
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided email to our statement.
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided eamil already exists - display error and ask to go to login or registeration page
    if($row['num'] > 0){
        $url_signIn = 'login.php';
        $url_signUp = 'register.php';
        die('<p>Email already exists, create a new account or login: <a href="' . $url_signIn . '">' . $url_signIn . '</a>'
        . '<p><a href="' . $url_signUp . '">' . $url_signUp . '</a>');
    }
    
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (email, password) VALUES (:email, :pass)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass', $hash);
 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //Go to login page
        header('Location: login.php');
    }
    
}

?>


<!DOCTYPE html>
<html>

<!-- Head tag, contains encoding and title -->
<HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<body>

<!-- Including the header file -->
<?php
  include 'header.inc';
?>

<!-- Section tag, Contains the main content of this page i.e the registeration form -->
<section id="site_heading">
  <div class="register_container">
  <h1>Find nearest and affordable parking spots</h1>
  <hr>
  <!-- Form -->
  <form  name="register_form" method="post" onsubmit="return validateForm()">
    <div class="container">
      <h1 style="color: black;">Register</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <p><b>Email</b></p>
      <input type="email" placeholder="Enter Email" name="email" required>

      <p><b>Password</b></p>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <p><b>Repeat Password</b></p>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      <hr>

      <input type="radio" name="terms" id="termsncond"><p style="display: inline">I agree to the <a href="#">Terms & Privacy</a>.</p>
    </div>

    <button type="submit" name="submitButton" class="registerbtn">Register</button>

    <div class="container signin">
      <p><a href="submission.php">Submit</a> your own parking spot</p>
    </div>
  </form>
  </div>
</section>


<!-- Include footer file -->
<?php
  include 'footer.inc';
?>


</body>

</html>
