<header>
    <div id="header-top">
        <img src="http://lvh.me/phpmotors/images/site/logo.png" id="logo" alt="PHP Motors">
        <a id="account" href="/phpmotors/accounts/index.php" title="View Account, Login, or Sign Up">
            My Account<? if(isset($cookieFirstname)){
                echo "<span>Welcome $cookieFirstname</span>";
            } ?>
        </a>
    </div>
    <? echo $navList; ?>
</header>