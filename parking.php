<!DOCTYPE html>
<html>

<HEAD>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parking</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<body>

<?php
  include 'header.inc';
?>

<section id="site_heading">
  <div id="lotA"></div>
</section>

<section id="lot_name">
  <div class="container">
    <h1>Parking Lot A</h1>
    <h3>Ratings: 3.5/5</h3>
  </div>
</section>    

<section id="info_reviews">
  <div class="container">
    <div class="box">
      <ul>
        <li class="info">McMaster University Downtown Centre, lot A,, Hamilton, ON L8N 1E9</li>
        <li class="info">Phone Number: xxx-xxx-xxxx</li>
        <li class="info">Hours: 5am- 2 am</li>
      </ul>
    </div>
  </div>
  <hr>
  <h1>Ratings and Reviews</h1>
  <div>
    <div class="review_table">
      <div class="review">
        <p>Dave: 3/5</p>
        <p>Difficult to find parking.</p>
      </div>
    </div>
    <div class="review_table">
      <div class="review">
        <p> Jon: 2.5/5</p>
        <p>Expensive parking with limited spots</p>
      </div>
    </div>
    <div class="review_table">
      <div class="review">
        <p> Smith: 4/5</p>
        <p>Decent spot.</p>
      </div>
    </div>        
  </div>
</section>

<?php
  include 'footer.inc';
?>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLXjpg2rRuwWlD2ovKO8WLB4Ape9p6FQs&callback=initMap1">
</script>

</body>

</html>