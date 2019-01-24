<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Simple PHP App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #333;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">
                <h1>Simple Updated PHP App</h1>
                <h2>Congratulations</h2>
                <p>Your updated PHP application is now running on a container in Amazon ECS.</p>
                <p>API Get CallThe container is running PHP version
                <?php   echo "test";
                        echo phpversion();
                        $url = "https://jsonplaceholder.typicode.com/todos/1";
                        $data = json_decode(file_get_contents($url), true);
                        echo "<br>";
                        echo $data["userId"];
                        echo "<br>";
                        echo $data["id"];
                        echo "<br/>";
                        echo $data["title"];
                        echo $data["completed"];
                        $myfile = fopen("/var/www/my-vol/date", "r") or die("");
                        echo fread($myfile,filesize("/var/www/my-vol/date"));
                        fclose($myfile);
                        $url = 'https://api.coinmarketcap.com/v1/global/';
                        $data = file_get_contents($url);
                        $price = json_decode($data,true);

                        //var_dump($price);
                        echo $price["total_market_cap_usd"];

                ?>
               <p/>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
