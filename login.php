<?php
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=comp4ww3','bilaval','passwordbilaval');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result= $pdo->query("SELECT * FROM parkings");

	}catch(PDOException $e){
		echo $e->getMessage();
	}

	foreach ($result as $row) {
			echo $row['name'] . '<br>';
		}
	
?> 