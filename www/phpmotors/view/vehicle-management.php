<?
    // check if logged in and user level before preceding
    if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Vehicle Management | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Manage Vehicles</h1>
            <div class="content__data">
                <p class="alt-form">Want to add a new car style? <a class="alt-form-link" href="/phpmotors/vehicles/index.php?action=manageClassification" title="Create a new car classification">Add a Classification</a></p>
                <p class="alt-form">Want to add a new model of car? <a class="alt-form-link" href="/phpmotors/vehicles/index.php?action=manageVehicle" title="Create a new model">Add a Vehicle</a></p>
                <? if(isset($message)){
                    echo $message;
                }
                if(isset($classificationList)){
                    echo '<h2>Vehicles By Classification</h2>';
                    echo '<p>Choose a classification to see available vehicles.</p>';
                    echo $classificationList;
                } ?>
                <noscript><p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p></noscript>
                <table id="inventoryDisplay"></table>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script src="/phpmotors/js/inventory.js"></script>
    </body>
</html>