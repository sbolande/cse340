<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Login</title>
        <link rel="stylesheet" type="text/css" href="http://lvh.me/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Login</h1>
            <div class="content__data">
                <form class="form" method="POST" action="javascript:void(0);" name="login">
                    <ul>
                        <li>
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" required>
                        </li>
                        <li>
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" required>
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required>
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input id="submit" type="submit" value="Create Account"></li>
                    </ul>
                </form>
                <p id="alt-form">Already have an account? <a id="alt-form-link" href="/phpmotors/accounts/index.php?action=login" title="Return to login">Login</a></p>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
        <script>
            function togglePassword() {
                let password = document.forms['login'].elements['password'];
                password.setAttribute('type', password.getAttribute('type') === 'password' ? 'text' : 'password');
            };
            // set first input to focused element or active element
            var firstInput = document.forms['login'].elements[0];
            if (firstInput.setActive) firstInput.setActive();
            else if (firstInput.focus) firstInput.focus();
        </script>
    </body>
</html>