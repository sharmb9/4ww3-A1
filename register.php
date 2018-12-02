<?php
require_once 'database_config.php';

if(isset($_POST['submitButton'])){
    
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $pass = !empty($_POST['psw']) ? trim($_POST['psw']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (email, password) VALUES (:email, :pass)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass', $pass);
 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
    }
    
}

?>

<!DOCTYPE html>
<html>

<HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="javascript.js"></script>
</HEAD>

<body>

<?php
  include 'header.inc';
?>
  
<section id="site_heading">
  <div class="register_container">
  <h1>Find nearest and affordable parking spots</h1>
  <hr>
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
      <p><a href="submission.html">Submit</a> your own parking spot</p>
    </div>
  </form>
  </div>
</section>



<?php
  include 'footer.inc';
?>


</body>

</html>
