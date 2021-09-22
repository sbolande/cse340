<?php
    require($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php");
    phpmotorsConnect();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - DB Connection</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/modules/header.php"); ?>
        <div id="content">
            <h1>DB Connection Test</h1>
            <p class="content__data">Your connection was successful!</p>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/modules/footer.php"); ?>
    </body>
</html>