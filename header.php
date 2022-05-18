<?php
function ip_visitor_country()
{

    $countrycode = "None";
    if ($a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='))) {
        $countrycode = $a['geoplugin_countryName'];
    }
    return $countrycode;
}

?>
<header>
    <div class="wrapper2">
        <div id="logo">
        </div>
        <div id="current-location"><?php echo ip_visitor_country(); ?></div>
        <div id=location-icon>
        </div>
        <div id="menu">
            <div class="block">
            </div>
            <div class="block">
            </div>
            <div class="block">
            </div>
            <div id="menu-items">
                <ul>
                    <li>
                        <a href="./index.php">Search</a>
                    </li>
                    <li>
                        <a href="./browse.php">Browse</a>
                    </li>
                    <li>
                        <a href="./forum.php">Forum</a>
                    </li>
                    <li>
                        <a href="./contacts.php">Contact</a>
                    </li>
                    <li>
                        <a href="./privacy.php">Privacy</a>
                    </li>
                    <li>
                        <a href="./about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">

    </div>
</header>