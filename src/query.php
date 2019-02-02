<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ECS Microservice Demo Movies App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 5px; background-color: #0EF318;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
       <h5 align="center"> Web Front End running in a container on Amazon ECS</h5>
       <h4 align="right"> Instance ID: <?php echo gethostname(); ?></h4><h4 align="right"> IP: <?php echo $IP = getHostByName(getHostName());?> </h4>
        <p align="right">Container PHP version <?php echo phpversion(); ?>.</p>
          <div class="container">
            <div class="hero-unit">
                    <center> <h1>Movies DB Microservice</h1><center>
                      <input type="button" value="Home" style="float: center;" onclick="location='index.php'" />
                      <input type="button" value="Find Movie" style="float: center;" onclick="location='query.php'" />
                      <input type="button" value="Scale API Service" style="float: center;" onclick="location='hammer.php'" />
                      <input type="button" value="Full Table Scan" style="float: center;" onclick="location='scan.php'"></h1>
                 <center>      
<?php
// It will display the data that it was received from the form called name
         echo "<p></p>";
	 $yearq = ($_GET["year"]); 
   	 $titleq = ($_GET["title"]); 
         echo "Current Search Year is: ";
         echo "<font size = 5>" . $yearq . "</font>";
         if($_GET["year"] === "") echo "Nothing Selected\n";
         //if($_GET["year"] === false) echo "a is false\n";
         if($_GET["year"] === null) echo "Nothing Selected\n";
         //if(isset($_GET["year"])) echo "a is set\n";
         //if(!empty($_GET["year"])) echo "a is not empty";
         echo '<form action="query.php" method="get">';
         echo '<input type="text" name="year" placeholder="enter year" />';
         echo '<input type="submit" name="sub" />';
         echo "<br></br>";
         echo "Current Movie Title is: ";
         echo "<font size = 5>" . $titleq . "</font>";
         if($_GET["title"] === "") echo "Nothing Selected\n";
         if($_GET["title"] === null) echo "Nothing Selected\n";
         echo "<p></p>";
         echo '<form action="query.php" method="get">';
         echo '<input type="text" name="title" placeholder="enter movie title" />';
         echo '<input type="submit" name="sub-title" />';
      
                
         if(isset($_GET["year"])) {
           $url = 'http://api.movies.com:5000/Query?year='; // Base Query API URL
           $url = $url . $yearq; //create API Get URL from base  URL and GET search parameter $_GET from form element
           $json = file_get_contents($url);
           $koyim=  json_decode($json, true);
           echo '<div class="boxed">';
           foreach($koyim['Items'] as $key) {
              echo "<br><h2><u><font size=15>";
              echo $key['title'];
              echo "</font></u></h2>";
              echo "<p> Released: ";
              echo $key['year'];
              echo "<br>"; 
              echo $key['info']['plot'];
              echo "</p><p> Starring: ";
              echo $key['info']['actors'][0];
              echo "</p>";
              $image = $key['info']['image_url'];
              echo '<img src="';
              echo $image;
              echo '">';
              echo "<br>";
            }
          }
          if(isset($_GET["title"])) {
             $url = 'http://api.movies.com:5000/Query-name?title='; // Base Query API URL
             $titleq = urlencode($titleq);
             $url = $url . $titleq; //create API Get URL from base  URL and GET search parameter $_GET from form element
             $json = file_get_contents($url);
             $koyim=  json_decode($json, true);
             echo '<div class="boxed">';
           foreach($koyim['Items'] as $key) {
              echo "<br><h2><u><font size=15>";
              echo $key['title'];
              echo "</font></u></h2>";
              echo "<p> Released: ";
              echo $key['year'];
              echo "<br>"; 
              echo $key['info']['plot'];
              echo "</p><p> Starring: ";
              echo $key['info']['actors'][0];
              echo "</p>";
              $image = $key['info']['image_url'];
              echo '<img src="';
              echo $image;
              echo '">';
              echo "<br>";
            }
          }

?>
</center>
</div> 
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
