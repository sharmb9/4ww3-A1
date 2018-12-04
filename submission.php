<?php
  require_once 'database_config.php';

  if(isset($_POST['submitButton'])){
    
    //Retrieve the field values from our submission form.
    //Makes sure input is not null and gets reid of uneccessary spacing
    $name = !empty($_POST['location']) ? trim($_POST['location']) : null;
    $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
 
    //Separating long and lat from input
    $lat_long= !empty($_POST['location']) ? explode(',', $_POST['coordinates']) : null;

    $lat= $lat_long[1];
    $long= $lat_long[0];
    
    //Check if username already exists.
    
    $sql = "SELECT COUNT(name) AS num FROM parkings WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided email to our statement.
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided eamil already exists - display error and ask to go to login or registeration page
    if($row['num'] > 0){
        echo "Parking spot already exists!";
    }else {
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO parkings (name, latitude, longitude, description) VALUES (:name, :latitude, :longitude, :description)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':latitude', $lat);
    $stmt->bindValue(':longitude', $long);
    $stmt->bindValue(':description', $description);
 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();

    //var_dump($_FILES);

  //Error checking
   if (!isset($_FILES['pic']['error']) ||
    ($_FILES['pic']['error'] != UPLOAD_ERR_OK)) {
    echo 'Error uploading file.';
    return;
   }

   //Making sure users uploades file with correct extension and no harmfull content is uploaded
   $finfo = new finfo(FILEINFO_MIME_TYPE);
   if ($finfo->file($_FILES['pic']['tmp_name']) === "image/jpeg") {
    $fileextension = "jpg";
   } else {
    echo 'Uploaded file was not a valid image.';
    return;
   }

   //ecrypting the file
   $filehash = sha1_file($_FILES['pic']['tmp_name']);
   $filename = $filehash . "." . $fileextension;

   //Uploading the image to aws bucket

   //Inlcuding the S3 bucket and S3.php library
   $awsAccessKey = "awskey";
   $awsSecretKey = "awssecret";
   $bucketName = "4ww3imagebucket";

   require_once ("S3.php");

   $s3 = new S3($awsAccessKey, $awsSecretKey);

   //upload file to AWS
   $ok = $s3->putObjectFile($_FILES['pic']['tmp_name'],
    $bucketName,
    $filename,
    S3::ACL_PUBLIC_READ);

    
    //If the signup process is successful.
    if($result && $ok){
        //If everything works fine
        $url = 'https://s3.amazonaws.com/' . $bucketName . '/' . $filename;
        echo 'Thank you for registering the parking spot <p>File upload successful: <a href="' . $url . '">' . $url ;
    }else {
    echo 'Error uploading file.';
  }      
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
<form method="POST"   enctype="multipart/form-data" name="register_form2" onsubmit="return validateForm2()">
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

  <button type="submit" class="registerbtn" name="submitButton">Submit</button>

</form>
</div>
</section>
     
<!-- Include the footer file -->
<?php
  include 'footer.inc';
?>

</body>

</html>
