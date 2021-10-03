<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Register</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Registration</h1>
            <div class="content__data">
                <?
                    if (isset($message)) {
                        echo $message;
                    }
                ?>
                <form class="form" method="post" action="/phpmotors/accounts/index.php" name="registration">
                    <ul>
                        <li>
                            <label for="clientFirstname">First Name</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" required>
                        </li>
                        <li>
                            <label for="clientLastname">Last Name</label>
                            <input type="text" name="clientLastname" id="clientLastname" required>
                        </li>
                        <li>
                            <label for="clientEmail">Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" required>
                        </li>
                        <li>
                            <label for="clientPassword">Password</label>
                            <input type="password" name="clientPassword" id="clientPassword" required>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input id="submit" type="submit" value="Create Account"></li>
                    </ul>
                    <input type="hidden" name="action" value="register">
                </form>
                <p id="alt-form">Already have an account? <a id="alt-form-link" href="/phpmotors/accounts/index.php?action=login" title="Return to login">Login</a></p>
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