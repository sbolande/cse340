<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Vehicle Management</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Manage Vehicles</h1>
            <div class="content__data">
            <p class="alt-form">Want to add a new car style? <a class="alt-form-link" href="/phpmotors/vehicles/index.php?action=manageClassification" title="Create a new car classification">Add a Classification</a></p>
            <p class="alt-form">Want to add a new model of car? <a class="alt-form-link" href="/phpmotors/vehicles/index.php?action=manageVehicle" title="Create a new model">Add a Vehicle</a></p>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>