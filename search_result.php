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
        <div id="search-r-rate">6,8</div>
        <div style="position:absolute; width: 500px; height: auto;
font-family: 'Inter';
font-style: normal;
font-weight: 800;
font-size: 30px;
line-height: 230%;
/* or 77px */

color: #FFFFFF; left: 90px; top: 400px;">
            Average salary: 502.19 <br>CostOfLiving index: 32.63 <br>Big earthquakes: 0 <br>Crime index: 59.5800 <br>
        </div>
        <div class="country-data">
            <div style="margin-top: -60px;margin-left: 30px; width: 500px;">
                Status: Open <br> Visa: No visa required <br> Covid restrictions: - <br><br><br><br> Safety: safe for tourists <br><br>
            </div>
            <div>
                <img src="./images/dollar.png" style="width:60px;margin-top:290px; margin-left:-415px;">
                <img src="./images/dollar.png" style="width:60px;margin-top:0px;">
            </div>
        </div>
        <div class='info'>Destination Belarus, officially the Republic of Belarus, a Nations Online country profile of the former Soviet republic. The landlocked country in Eastern Europe borders Russia to the northeast, Ukraine to the south, Poland to the west, and Lithuania and Latvia to the northwest.
            <br><br>All eligible travelers should be up to date with their COVID-19 vaccines. Please see CDC’s COVID-19 Vaccines for Specific Groups of People for more information.
        </div>
    </div>
</body>

</html>