<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h1>
        <?php
        $result = shell_exec("/Library/Frameworks/Python.framework/Versions/3.8/bin/python3 /Applications/XAMPP/xamppfiles/htdocs/Fririd/test.py");
        echo number_format((float)$result, 1, '.', '');
        ?>
    </h1>
</body>

</html>