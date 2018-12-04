<!DOCTYPE html>
<html>

<HEAD>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<body>

<?php
  include 'header.inc';
?>
  
<section id="site_heading">
  <div class="container">
    <h1>Find nearest and affordable parking spots</h1>
  </div>
</section>

<section id="searchbar">
  <div class="container">
    <h1>Search parking spots</h1>
    <form action="results.php" name="searchAddress" method="get" onsubmit="return validateSearchForm()" >
      <input type="text" placeholder="Search..." name="searchInput" required>
      <button type="submit" class="search_button">Search</button>
    </form>
    <button type="submit" id="locationButton" onclick="getLocation()">Use my location to search</button>
  </div>
</section>    

<section id="filters">
  <div class="container">
    <div class="box">
      <div class="dropdown">
        <button class="dropbtn">Distance</button>
        <div class="dropdown-content">
          <a href="#">500 m</a>
          <a href="#">750 m</a>
          <a href="#">1 km</a>
        </div>
      </div>
    </div>
    <div class="box">
    <div class="dropdown">
      <!-- Put a slider later(js) -->
      <button class="dropbtn">Price</button>
      <div class="dropdown-content">
        <a href="#">$1- $5</a>
        <a href="#">$5- $10</a>
        <a href="#">> $10</a>
      </div>
    </div>
    </div>
    <div class="box">
      <div class="dropdown">
        <button class="dropbtn">Ratings</button>
        <div class="dropdown-content">
          <a href="#">3 Stars</a>
          <a href="#">4 Star</a>
          <a href="#">5 Star</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  include 'footer.inc';
?>


</body>

</html>
