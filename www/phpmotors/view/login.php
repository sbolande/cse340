<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Motors - Login</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Login</h1>
            <div class="content__data">
                <form class="login" method="POST" action="" name="login">
                    <ul>
                        <li>
                            <label for="email">Email</label>
                            <input type="email" name="email" required>
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                            <span id="showPass" class="hint" onclick="togglePassword()">Show Password</span>
                        </li>
                        <li><input id="submit" type="submit" value="Login"></li>
                    </ul>
                </form>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
    <script type="text/javascript">
        function togglePassword() {
            let password = document.forms['login'].elements['password'];
            password.setAttribute('type', password.getAttribute('type') === 'password' ? 'text' : 'password');
        };
        // set first input to focused element or active element
        var firstInput = document.forms['login'].elements[0];
        if (firstInput.setActive) firstInput.setActive();
        else if (firstInput.focus) firstInput.focus();
    </script>
</html>