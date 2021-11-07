<?
    // check if logged in and user level before preceding
    if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
        exit;
    }
    // Build a classification <select> dropdown using the $classifications array
    $classificationDropdown = "<select name='classificationId' id='classificationId' required>";
    $classificationDropdown .= '<option value="" ';
    if (!isset($classificationId) && !isset($invInfo['classificationId'])) {
        $classificationDropdown .= 'selected ';
    }
    $classificationDropdown .= 'data-default>-- Select classification --</option>';
    foreach ($classifications as $classification) {
        $classificationDropdown .= "<option value='$classification[classificationId]'";
        if (isset($classificationId)) {
            if ($classification['classificationId'] === $classificationId) {
                $classificationDropdown .= " selected";
            }
        } elseif (isset($invInfo['classificationId'])) {
            if ($classification['classificationId'] === $invInfo['classificationId']) {
                $classificationDropdown .= " selected";
            }
        }
        $classificationDropdown .= ">$classification[classificationName]</option>";
    }
    $classificationDropdown .= '</select>';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><? if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; } ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
	            echo "Modify$invMake $invModel"; }?></h1>
            <div class="content__data">
                <? if(isset($message)){echo $message;} ?>
                <form class="form" method="post" action="/phpmotors/vehicles/" name="addVehicle">
                    <ul>
                        <li>
                            <label for="invMake">Make</label>
                            <input type="text" name="invMake" id="invMake" placeholder=" "
                            <? if(isset($invMake)){echo "value='$invMake'";}elseif(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";} ?> required>
                        </li>
                        <li>
                            <label for="invModel">Model</label>
                            <input type="text" name="invModel" id="invModel" placeholder=" "
                            <? if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";} ?> required>
                        </li>
                        <li>
                            <label for="classificationId">Classification</label><br>
                            <? echo $classificationDropdown; ?>
                        </li>
                        <li>
                            <label for="invDescription">Description</label>
                            <textarea rows="2" cols="48" name="invDescription" id="invDescription" placeholder=" "><?
                                if(isset($invDescription)){echo $invDescription;}elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}
                            ?></textarea>
                        </li>
                        <li>
                            <label for="invImage">Image Path</label>
                            <input type="text" name="invImage" id="invImage" placeholder=" "
                            <? if(isset($invImage)){echo "value='$invImage'";}elseif(isset($invInfo['invImage'])){echo "value='$invInfo[invImage]'";} ?>
                            pattern="^(.+)(\/|\\)([^\/]+).(png|jpg|jpeg|svg)$" required>
                            <span class="hint">Must be a valid filepath.</span>
                        </li>
                        <li>
                            <label for="invThumbnail">Thumbnail Path</label>
                            <input type="text" name="invThumbnail" id="invThumbnail" placeholder=" "
                            <? if(isset($invThumbnail)){echo "value='$invThumbnail'";}elseif(isset($invInfo['invThumbnail'])){echo "value='$invInfo[invThumbnail]'";} ?>
                            pattern="^(.+)(\/|\\)([^\/]+).(png|jpg|jpeg|svg)$" required>
                            <span class="hint">Must be a valid filepath.</span>
                        </li>
                        <li>
                            <label for="invPrice">Price</label><br>
                            $ <input type="number" min="0.01" step="0.01" name="invPrice" id="invPrice" class="dollar" placeholder="0.00"
                            <? if(isset($invPrice)){echo "value='$invPrice'";}elseif(isset($invInfo['invPrice'])){echo "value='$invInfo[invPrice]'";} ?> required>
                        </li>
                        <li>
                            <label for="invStock">Number in Stock</label>
                            <input type="number" min="1" max="50" name="invStock" id="invStock" placeholder=" "
                            <? if(isset($invStock)){echo "value='$invStock'";}elseif(isset($invInfo['invStock'])){echo "value='$invInfo[invStock]'";} ?> required>
                        </li>
                        <li>
                            <label for="invColor">Color</label>
                            <input type="text" name="invColor" id="invColor" list="colorList" placeholder=" "
                            <? if(isset($invColor)){echo "value='$invColor'";}elseif(isset($invInfo['invColor'])){echo "value='$invInfo[invColor]'";} ?> required>
                            <datalist id="colorList">
                                <option value="Black">
                                <option value="White">
                                <option value="Grey">
                                <option value="Silver">
                                <option value="Brown">
                                <option value="Red">
                                <option value="Orange">
                                <option value="Yellow">
                                <option value="Green">
                                <option value="Blue">
                                <option value="Purple">
                            </datalist>
                        </li>
                        <li><input class="submit" type="submit" value="Update Vehicle"></li>
                    </ul>
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<? if(isset($invInfo['invId'])){echo $invInfo['invId'];}elseif(isset($invId)){echo $invId;} ?>">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>