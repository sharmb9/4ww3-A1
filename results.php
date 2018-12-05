<!DOCTYPE html>
<html>

<HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Results</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jscript_1.js"></script>
</HEAD>

<body>

    <?php
      include 'header.inc';
    ?>
   

    <div class="vertical-menu">
        <a href="#" class="active">Results</a>
        <a href="parking.php" target="_balnk">Result 1</a>
        <p class="spot_name">McMaster University Parking Lot C</p>
        <p>Price: $6/hr</p>
        <p>200 m</p>
        <a href="parking.php" target="_blank">Result 2</a>
        <p class="spot_name">McMaster University Parking Lot G</p>
        <p>Price: $4/hr</p>
        <p>300 m</p>
        <a href="parking.php" target="_blank">Result 3</a>
        <p class="spot_name">McMaster University Parking Lot A</p>
        <p>Price: $6/hr</p>
        <p>250 m</p>
    </div>


    <div id="result_map">
    </div>



  <footer class="footer">
    <p>Copyright &copy; Bilaval Sharma 2018</p>
  </footer>


 
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=API_Key&callback=initMap">
  </script>

</body>

</html>
