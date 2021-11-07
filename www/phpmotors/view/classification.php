<!DOCTYPE html>
<html lang="en">
    <head>
        <title><? echo $classificationName; ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? echo $classificationName; ?> Vehicles</h1>
            <? if(isset($message)){echo $message;} ?>
            <div class="content__data">
                <? if(isset($vehicleDisplay)){
                    echo $vehicleDisplay;
                } ?>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>