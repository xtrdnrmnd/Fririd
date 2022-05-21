<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>result</title>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        .wrapper .footer a {
            color: #F4C095;
        }

        .block {
            background: #F4C095;
        }

        #menu-items {
            background-color: #071E22;
        }
    </style>
</head>

<body id="searchResult">
    <div class="wrapper">

        <?php

        //Initializing the session
        session_start();


        //DB 
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'countries';

        $_SESSION['toName'] = $_POST['toName'];

        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        //Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $table = 'country';

        // Check the id thing to get required data

        $result = $db->query("SELECT flag_dir, alterName FROM $table WHERE countryName = '" . $_SESSION['toName'] . "'") or die($db->error);
        while ($data = $result->fetch_assoc()) {
            echo "<img src={$data['flag_dir']} class='img-circle'>";
            echo "<div class='search-r-name'>{$data['alterName']}</div>";
        }
        ?>
        <div id="search-r-rate">9,3</div>
        <div class="country-data"></div>
        <div class='info'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vitae tortor condimentum lacinia quis vel.</div>
    </div>
</body>

</html>