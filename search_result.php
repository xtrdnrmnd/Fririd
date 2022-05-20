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
        //DB 
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'countries';

        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        //Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $table = 'country';

        // Check the id thing to get required data

        $result = $db->query("SELECT flag_dir FROM $table WHERE id=1") or die($db->error);
        while ($data = $result->fetch_assoc()) {
            echo "<img src={$data['flag_dir']} class='img-circle'>";
        }
        ?>
    </div>
</body>

</html>