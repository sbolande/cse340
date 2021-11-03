<header>
    <div id="header-top">
        <img src="http://lvh.me/phpmotors/images/site/logo.png" id="logo" alt="PHP Motors">
        <span id="account">
            <? if(!$_SESSION['loggedin'] || !isset($_SESSION['clientData'])){ ?>
                <a href="/phpmotors/accounts/?action=signin" title="Login or Sign Up">My Account</a>
            <? } else { ?>
                <a href="/phpmotors/accounts/" title="View Account">Welcome <? echo $_SESSION['clientData']['clientFirstname']; ?></a> - <a href="/phpmotors/accounts/?action=logout" title="Logout">Logout</a>
            <? } ?>
        </span>
    </div>
    <? echo $navList; ?>
</header>