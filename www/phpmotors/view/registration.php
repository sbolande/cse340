<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Registration</h1>
            <div class="content__data">
                <? if (isset($message)){
                    echo $message;
                } ?>
                <form class="form" method="post" action="/phpmotors/accounts/index.php" name="registration">
                    <ul>
                        <li>
                            <label for="clientFirstname">First Name</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" placeholder=" "
                            <? if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
                        </li>
                        <li>
                            <label for="clientLastname">Last Name</label>
                            <input type="text" name="clientLastname" id="clientLastname" placeholder=" "
                            <? if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
                        </li>
                        <li>
                            <label for="clientEmail">Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder=" "
                            <? if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                        </li>
                        <li>
                            <label for="clientPassword">Password</label>
                            <input type="password" name="clientPassword" id="clientPassword" 
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                            placeholder=" " required>
                            <span class="hint">At least 8 characters, 1 uppercase, 1 number, and 1 special character<br><br></span>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input id="submit" type="submit" value="Create Account"></li>
                    </ul>
                    <input type="hidden" name="action" value="register">
                </form>
                <p class="alt-form">Already have an account? <a class="alt-form-link" href="/phpmotors/accounts/?action=signin" title="Return to login">Login</a></p>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script>
            function togglePassword() {
                let password = document.forms['registration'].elements['clientPassword'];
                password.setAttribute('type', password.getAttribute('type') === 'password' ? 'text' : 'password');
            };
            // set first input to focused element or active element
            var firstInput = document.forms['registration'].elements[0];
            if (firstInput.setActive) firstInput.setActive();
            else if (firstInput.focus) firstInput.focus();
        </script>
    </body>
</html>