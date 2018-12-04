<?php
	require_once 'database_config.php';

	//we have to make sure username is already in database otherwise ask to go to register page

	//redirecting to page: header('Location: search.php');

	if (isset($_POST['loginButton'])) {
		//Retrieve the field values from our registration form.
    	$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    	$pass = !empty($_POST['psw']) ? trim($_POST['psw']) : null;

    	//Get account info for entered user
    	$qry = "SELECT id, email, password FROM users where email = :email";
    	$stmt = $pdo->prepare($qry);

    	//Bind values
    	$stmt->bindValue(':email', $email);
		$stmt->execute();

		//Get the row(user) from database
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		//if user is not in database, redirect to registeration page later
		if ($user === false) {
			$url_signIn = 'login.php';
        	$url_signUp = 'register.php';
        	die('<p>User not found <a href="' . $url_signIn . '">' . $url_signIn . '</a>'
        	. '<p><a href="' . $url_signUp . '">' . $url_signUp . '</a>');
			}else {
			//if user is in database

			//checking if passowrds match
			$validPassword = password_verify($pass, $user['password']);
				//if passowrd is valid
				if ($validPassword) {
					//Provide the user with a login session.
            		$_SESSION['user_id'] = $user['id'];
            		$_SESSION['logged_in'] = time();
            
            		//Redirect to search.php
            		header('Location: search.php');
            		exit;
				}else {
					$url_signIn = 'login.php';
        			$url_signUp = 'register.php';
        			die('<p>Password did not match <a href="' . $url_signIn . '">' . $url_signIn . '</a>'
        			. '<p><a href="' . $url_signUp . '">' . $url_signUp . '</a>');
					}
			
				}		
	}

?>

<!DOCTYPE html>
<html>

<HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<body>

<?php
  include 'header.inc';
?>
  
<section id="site_heading">
  <div class="register_container">
  <h1>Find nearest and affordable parking spots</h1>
  <hr>
  <form  name="login_form" method="post" onsubmit="return validateForm()">
    <div class="container">
      <h1 style="color: black;">Log In</h1>
      <p>Please log in.</p>
      <hr>

      <p><b>Email</b></p>
      <input type="email" placeholder="Enter Email" name="email" required>

      <p><b>Password</b></p>
      <input type="password" placeholder="Enter Password" name="psw" required>

    </div>

    <button type="submit" name="loginButton" class="registerbtn">Register</button>
  </form>
  </div>
</section>



<?php
  include 'footer.inc';
?>


</body>

</html>