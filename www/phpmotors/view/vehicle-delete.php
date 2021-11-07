<?
    // check if logged in and user level before preceding
    if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><? if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		    echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <div class="content__data">
                <? if(isset($message)){echo $message;} ?>
                <form class="form" method="post" action="/phpmotors/vehicles/" name="deleteVehicle">
                    <ul>
                        <li>
                            <label for="invMake">Make</label>
                            <input type="text" name="invMake" id="invMake" <? if(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";} ?> readonly>
                        </li>
                        <li>
                            <label for="invModel">Model</label>
                            <input type="text" name="invModel" id="invModel" <? if(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";} ?> readonly>
                        </li>
                        <li>
                            <label for="invDescription">Description</label>
                            <textarea rows="2" cols="48" name="invDescription" id="invDescription" readonly><?
                                if(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}
                            ?></textarea>
                        </li>
                        <li>
                            <label for="confirm">Confirm vehicle deletion.</label>
                            <input type="checkbox" name="confirm" id="confirm" onchange="toggleSubmit(this)">
                            <span class="hint"><strong>The delete is permanent!</strong></span>
                        </li>
                        <li><input class="submit" id="delVehicleSubmit" type="submit" value="Delete Vehicle" disabled></li>
                    </ul>
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<? if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script>
            function toggleSubmit(check) {
                let submit = document.forms['deleteVehicle'].elements['delVehicleSubmit'];
                submit.disabled = !check.checked;
            }
        </script>
    </body>
</html>