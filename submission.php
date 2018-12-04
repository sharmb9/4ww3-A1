<?php
  require_once 'database_config.php';

  if(isset($_POST['registerbtn'])){
    
    //Retrieve the field values from our submission form.
    //Makes sure input is not null and gets reid of uneccessary spacing
    $location = !empty($_POST['location']) ? trim($_POST['location']) : null;
    $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
    // get lat and long separatley$coordinates = !empty($_POST['coordinates']) ? trim($_POST['coordinates']) : null; 
    
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
        die('<p>Create a new account or login: <a href="' . $url_signIn . '">' . $url_signIn . '</a>'
        . '<p><a href="' . $url_signUp . '">' . $url_signUp . '</a>');
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
  <title>Submit a parking spot</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<!-- Include the header file -->
<?php
  include 'header.inc';
?>

<section id="site_heading">
<div class="register_container">
<h1>Find nearest and affordable parking spots</h1>
<hr>
<form method="POST" action="submit_file.php" enctype="multipart/form-data" name="register_form2" onsubmit="return validateForm2()">
  <div class="container">
    <h1 style="color: black;">Submit a location</h1>
    <p>Please fill in this form to submit a parking location.</p>
    <hr>

    <p><b>Name of location</b></p>
    <input type="text" placeholder="Enter Location" name="location" required>

    <p><b>Description</b></p>
    <input type="text" placeholder="Enter Description" name="description" required>

    <p><b>Coordinates</b></p>
    <input type="text" placeholder="Coordinates" name="coordinates" id="coord" required>
    <hr>

    <button type="submit" id="locationButton" onclick="getLocationSubmission()">Use my location to update coordinates</button>

    <p><b>Upload an image of the location</b></p>
    <input type="file" name="pic" accept="image/*" required>
  </div>

  <button type="submit" class="registerbtn">Submit</button>

</form>
</div>
</section>
     
<!-- Include the footer file -->
<?php
  include 'footer.inc';
?>

</body>

</html>
