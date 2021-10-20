<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Add Classification</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Add a New Classification</h1>
            <div class="content__data">
                <?
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <form class="form" method="post" action="/phpmotors/vehicles/index.php" name="addClassification">
                    <ul>
                        <li>
                            <label for="classificationName">Classification Name</label>
                            <input type="text" name="classificationName" id="classificationName"
                            maxlength="30" placeholder=" " required>
                        </li>
                        <li><input id="submit" type="submit" value="Submit"></li>
                    </ul>
                    <input type="hidden" name="action" value="addClassification">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>