<?
    if (!$_SESSION['loggedin']) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - My Account</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1><? echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
            <div class="content__data">
                <table id="userDataTable">
                    <tr>
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
                    </tr>
                    <!-- <tr>
                        <th>User Level</th>
                        <td><? echo $_SESSION['clientData']['clientLevel']; ?></td>
                    </tr> -->
                </table>
                <? if ($_SESSION['clientData']['clientLevel'] > 1){ ?>
                    <p class="alt-form"><a class="alt-form-link" href="/phpmotors/vehicles/" title="Vehicle and car classification management">Manage Vehicles</a></p>
                <? } ?>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>