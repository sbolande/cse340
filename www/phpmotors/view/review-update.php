<?
    // check if logged in and user level before preceding
    if (!$_SESSION['loggedin']) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><? if(isset($review['invMake']) && isset($review['invModel'])){ 
		    echo "Update Review for $review[invMake] $review[invModel]";} ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? if(isset($review['invMake']) && isset($review['invModel'])){ 
	            echo "Update Review for $review[invMake] $review[invModel]";} ?></h1>
            <div class="content__data">
                <? if(isset($message)){echo $message;} ?>
                <form class="form update-form" method="post" action="/phpmotors/reviews/" name="updateReview">
                    <ul>
                        <li>
                            <label for="makeModel">Make/Model</label>
                            <input type="text" name="makeModel" id="makeModel" <? if(isset($review['invMake'])) {
                                echo "value='$review[invMake] $review[invModel]'"; 
                            } ?> readonly>
                        </li>
                        <li>
                            <label for="reviewText">Review</label>
                            <textarea rows="2" cols="48" name="reviewText" id="reviewText"><?
                                if(isset($review['reviewText'])){echo $review['reviewText'];}
                            ?></textarea>
                        </li>
                        <li>
                            <label for="reviewDate">Date</label>
                            <input type="text" name="reviewDate" id="reviewDate" <? if(isset($review['reviewDate'])) {
                                echo 'value="' . date("m/d/Y", strtotime($review['reviewDate'])) . '"';
                            } ?> readonly>
                        </li>
                        <li><input class="submit" id="editVehicleSubmit" type="submit" value="Edit Review"></li>
                    </ul>
                    <input type="hidden" name="action" value="updateReview">
                    <input type="hidden" name="reviewId" value="<? if(isset($review['reviewId'])){echo $review['reviewId'];} ?>">
                    <input type="hidden" name="clientId" value="<? if(isset($review['clientId'])){echo $review['clientId'];} ?>">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>