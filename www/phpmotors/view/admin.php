<?
    if (!$_SESSION['loggedin']) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Account | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
            <div class="content__data">
                <p class="loggedinMsg">You are currently logged in.</p>
                <? if(isset($_SESSION['message'])){echo $_SESSION['message'];} ?>
                <p class="alt-form"><a class="alt-form-link" href="/phpmotors/accounts/?action=update" title="Edit account info or change password">Update Account Info</a></p>
                <!-- <table id="userDataTable">
                    <tbody> -->
                        <!-- <tr>
                            <th>First Name</th>
                            <td><? echo $_SESSION['clientData']['clientFirstname']; ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><? echo $_SESSION['clientData']['clientLastname']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><? echo $_SESSION['clientData']['clientEmail']; ?></td>
                        </tr> -->
                        <!-- <tr>
                            <th>User Level</th>
                            <td><? echo $_SESSION['clientData']['clientLevel']; ?></td>
                        </tr> -->
                    <!-- </tbody> -->
                <!-- </table> -->
                <? if(isset($reviewsDisplay) && count($reviews)) { ?>
                <hr>
                <h2>My Reviews</h2>
                <table id="clientReviews">
                    <thead>
                        <tr>
                            <th>Make/Model</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Modify</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? echo $reviewsDisplay; ?>
                    </tbody>
                </table>
                <? } ?>
                <? if($_SESSION['clientData']['clientLevel'] > 1){ ?>
                    <hr>
                    <h2>Vehicles Management</h2>
                    <p class="alt-form">Add classifications, add vehicles, or update vehicles: <a class="alt-form-link" href="/phpmotors/vehicles/" title="Vehicle and car classification management">Manage Vehicles</a></p>
                <? } ?>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>