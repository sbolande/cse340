<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Login</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Login</h1>
            <div class="content__data">
                <?
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <form class="form" method="post" action="javascript:void(0);" name="login">
                    <ul>
                        <li>
                            <label for="clientEmail">Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder=" "
                            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                        </li>
                        <li>
                            <label for="clientPassword">Password</label>
                            <input type="password" name="clientPassword" id="clientPassword" placeholder=" " required>
                            <span class="hint">At least 8 characters, 1 uppercase, 1 number, and 1 special character<br><br></span>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input id="submit" type="submit" value="Login"></li>
                    </ul>
                    <input type="hidden" name="action" value="login">
                </form>
                <p class="alt-form">No account? <a class="alt-form-link" href="/phpmotors/accounts/index.php?action=registration" title="Register for an account">Sign Up</a></p>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script>
            function togglePassword() {
                let password = document.forms['login'].elements['clientPassword'];
                password.setAttribute('type', password.getAttribute('type') === 'password' ? 'text' : 'password');
            };
            // set first input to focused element or active element
            var firstInput = document.forms['login'].elements[0];
            if (firstInput.setActive) firstInput.setActive();
            else if (firstInput.focus) firstInput.focus();
        </script>
    </body>
</html>