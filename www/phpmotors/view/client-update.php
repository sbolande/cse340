<?
    // check if logged in and user level before preceding
    if (!$_SESSION['loggedin']) {
        header('Location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update My Account | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Update Account</h1>
            <div class="content__data">
                <h2>Update Account Information</h2>
                <? if (isset($accountMessage)){
                    echo $accountMessage;
                } ?>
                <form class="form" method="post" action="/phpmotors/accounts/" name="updateAccount">
                    <ul>
                        <li>
                            <label for="clientFirstname">First Name</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" placeholder=" "
                            <? if(isset($clientFirstname)){
                                echo "value='$clientFirstname'";
                            }elseif(isset($_SESSION['clientData']['clientFirstname'])){
                                echo 'value="' . $_SESSION['clientData']['clientFirstname'] . '"';
                            } ?> required>
                        </li>
                        <li>
                            <label for="clientLastname">Last Name</label>
                            <input type="text" name="clientLastname" id="clientLastname" placeholder=" "
                            <? if(isset($clientLastname)){
                                echo "value='$clientLastname'";
                            }elseif(isset($_SESSION['clientData']['clientLastname'])){
                                echo 'value="' . $_SESSION['clientData']['clientLastname'] . '"';
                            } ?> required>
                        </li>
                        <li>
                            <label for="clientEmail">Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder=" "
                            <? if(isset($clientEmail)){
                                echo "value='$clientEmail'";
                            }elseif(isset($_SESSION['clientData']['clientEmail'])){
                                echo 'value="' . $_SESSION['clientData']['clientEmail'] . '"';
                            } ?> required>
                        </li>
                        <li><input class="submit" type="submit" value="Update Account"></li>
                    </ul>
                    <input type="hidden" name="clientId" <? if(isset($_SESSION['clientData']['clientId'])){
                        echo 'value="' . $_SESSION['clientData']['clientId'] . '"';
                    } ?>>
                    <input type="hidden" name="action" value="updateAccount">
                </form>
                <hr>
                <h2>Change Password</h2>
                <? if (isset($passwordMessage)){
                    echo $passwordMessage;
                } ?>
                <form class="form" method="post" action="/phpmotors/accounts/" name="changePassword">
                    <p class="hint">Submitting will change your current password! You will no longer be able to login using your old password!</p>
                    <ul>
                        <li>
                            <label for="clientPassword">Password</label>
                            <input type="password" name="clientPassword" id="clientPassword" 
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                            placeholder=" " required>
                            <span class="hint">At least 8 characters, 1 uppercase, 1 number, and 1 special character<br><br></span>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input class="submit" type="submit" value="Change Password"></li>
                    </ul>
                    <input type="hidden" name="clientId" <? if(isset($_SESSION['clientData']['clientId'])){
                        echo 'value="' . $_SESSION['clientData']['clientId'] . '"';
                    } ?>>
                    <input type="hidden" name="action" value="changePassword">
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script>
            function togglePassword() {
                let password = document.forms['changePassword'].elements['clientPassword'];
                password.setAttribute('type', password.getAttribute('type') === 'password' ? 'text' : 'password');
            };
            // set first input to focused element or active element
            var firstInput = document.forms['changePassword'].elements[0];
            if (firstInput.setActive) firstInput.setActive();
            else if (firstInput.focus) firstInput.focus();
        </script>
    </body>
</html>