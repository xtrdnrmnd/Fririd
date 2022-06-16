<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');;
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>browse</title>
    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        #menu-items {
            background-color: #F4C095;
        }

        .wrapper .footer a,
        #menu-items li a {
            color: #071E22;
        }

        #location-icon {
            background-image: url("./images/location-icons/location-icon-dblue.png");
        }

        #logo {
            background-image: url("./images/logos/Logo-dblue.png");
        }
    </style>
</head>

<body id="browse">
    <div class="wrapper">
        <div id="sort">Sort</div>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "countries");
        $res = mysqli_query($conn, "SELECT DISTINCT  alterName, flag_dir, mainInfo FROM country ORDER BY alterName ASC");
        while ($row = mysqli_fetch_object($res)) {
        ?>
            <div class="browse-block">
                <div>
                    <?php echo "<img src=" . $row->flag_dir . " class='img-circle'>"; ?>
                </div>
                <div class="hed-name">
                    <?php echo $row->alterName; ?>
                </div>
                <div class="status">Status:
                    <div style="color:#679289;"> Open</div>
                </div>
                <div id="rate">
                    <?php
                    $from = ip_visitor_country();
                    $to = $row->alterName;
                    $str_output = shell_exec("/Library/Frameworks/Python.framework/Versions/3.8/bin/python3 ./python/DataProcessor.py $from $to");
                    if ($str_output[2] == "") {
                        echo "3,2";
                    } else {
                        echo $str_output[2] . "," . $str_output[4];
                    }
                    ?>
                </div>
                <div class="left-block"> Visa:&nbsp;&nbsp;
                    <?php
                    if ($str_output[8] == 4) {
                        echo "No";
                    } else {
                        echo "Yes";
                    }
                    echo "<br>Covid restrictions:&nbsp;&nbsp; 
                    lifted<br>Safety:&nbsp;";
                    if (intval($str_output[11]) > 6) {
                        echo "Safe for tourists&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    } else {
                        echo "Not safe for tourists";
                    }
                    if ($str_output[14] < 2) {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                    } else if ($str_output[14] > 1 && $str_output[14] < 4) {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -240px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -240px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -240px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -240px;'>";
                    } else if ($str_output[14] > 3 && $str_output[14] < 6) {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                    } else if ($str_output[14] > 5 && $str_output[14] < 8) {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                    } else if ($str_output[14] == "") {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                    } else {
                        echo "<img src='./images/dollar.png' class='money-image' style='left: -250px;'>";
                    }
                    ?>
                </div>
                <div class="main-info-browse">
                    <?php echo $row->mainInfo; ?>
                </div>
            </div>
        <?php
        }
        ?>
</body>

</html>