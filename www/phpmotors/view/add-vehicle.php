<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Add Vehicle</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Add a New Vehicle</h1>
            <div class="content__data">
                <?
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <form class="form" method="post" action="/phpmotors/vehicles/index.php" name="addVehicle">
                    <ul>
                        <li>
                            <label for="invMake">Make</label>
                            <input type="text" name="invMake" id="invMake" placeholder=" " required>
                        </li>
                        <li>
                            <label for="invModel">Model</label>
                            <input type="text" name="invModel" id="invModel" placeholder=" " required>
                        </li>
                        <li>
                            <label for="classificationId">Classification</label><br>
                            <? echo $classificationDropdown; ?>
                        </li>
                        <li>
                            <label for="invDescription">Description</label>
                            <textarea rows="2" cols="48" name="invDescription" id="invDescription" placeholder=" "></textarea>
                        </li>
                        <li>
                            <label for="invImage">Image Path</label>
                            <input type="text" name="invImage" id="invImage" placeholder=" " required value="/images/no-image.png">
                            <span class="hint">Must be a valid filepath.</span>
                        </li>
                        <li>
                            <label for="invThumbnail">Thumbnail Path</label>
                            <input type="text" name="invThumbnail" id="invThumbnail" placeholder=" " required value="/images/no-image.png">
                            <span class="hint">Must be a valid filepath.</span>
                        </li>
                        <li>
                            <label for="invPrice">Price</label><br>
                            $ <input type="number" min="0.01" step="0.01" name="invPrice"
                            id="invPrice" class="dollar" placeholder=" " required value="0.01">
                        </li>
                        <li>
                            <label for="invStock">Number in Stock</label>
                            <input type="number" min="1" max="50" name="invStock" id="invStock" placeholder=" " required value="1">
                        </li>
                        <li>
                            <label for="invColor">Color</label>
                            <input type="text" name="invColor" id="invColor" list="colorList" placeholder=" " required>
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
                        <li><input id="submit" type="submit" value="Submit"></li>
                    </ul>
                    <input type="hidden" name="action" value="addVehicle">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>