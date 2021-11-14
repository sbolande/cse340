<?
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html>
    <head>
        <title>Image Management | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Image Management</h1>
            <div class="content__data">
                <p>Welcome to Image Management, please select on of the options below.</p>
                <h2>Add New Vehicle Message</h2>
                <? if(isset($message)){echo $message;} ?>
                <form class="form" method="post" action="/phpmotors/uploads/" enctype="multipart/form-data" name="addImage">
                    <ul>
                        <li>
                            <label for="invItem">Vehicle</label>
                            <?php echo $prodSelect; ?>
                        </li>
                        <li>
                            <fieldset>
                                <legend>Is this the main image for the vehicle?</legend><br>
                                <div class="radio-input">
                                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                                    <label for="priYes" class="pImage">Yes</label>
                                </div>
                                <div class="radio-input">
                                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                                    <label for="priNo" class="pImage">No</label>
                                </div>
                            </fieldset>
                        </li>
                        <li>
                            <label for="file1">Upload Image</label>
                            <input type="file" name="file1" id="file1" placeholder=" ">
                        </li>
                        <li><input class="submit" type="submit" value="Upload"></li>
                    </ul>
                    <input type="hidden" name="action" value="upload">
                </form>
                <hr>
                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, don't forget to delete the thumbnail (and vice versa) too!</p>
                <? if(isset($imageDisplay)){echo $imageDisplay;} ?>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>
<? unset($_SESSION['message']); ?>