<!DOCTYPE html>
<html lang="en">
    <head>
        <title><? echo $vehicle['invModel']; ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?></h1>
            <? if(isset($message)){echo $message;} ?>
            <div class="car details">
                <? if(isset($vehicleDisplay)){
                    echo $vehicleDisplay;
                } ?>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>