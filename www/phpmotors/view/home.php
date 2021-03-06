<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/header.php"); ?>
        <div id="content">
            <h1>Welcome to PHP Motors!</h1>
            <div class="car home-page">
                <div class="car__image__container">
                    <img class="car__image" src="./images/vehicles/delorean.jpg" alt="DMC Delorean">
                    <div class="car__features">
                        <strong class="car__name">DMC Delorean</strong>
                        <p>3 Cup holders</p>
                        <p>Superman doors</p>
                        <p>Fuzzy dice!</p>
                    </div>
                    <button id="own-today">Own Today</button>    
                </div>
                <div class="car__reviews__container">
                    <h2>DMC Delorean Reviews</h2>
                    <ul class="car__reviews">
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>
                <div class="car__upgrades__container">
                    <h2>Delorean Upgrades</h2>
                    <div class="car__upgrades">
                        <div class="upgrade">
                            <span><img src="./images/upgrades/flux-cap.png" alt="Flux Capacitor"></span>
                            <a href="" title="Flux Capacitor">Flux Capacitor</a>
                        </div>
                        <div class="upgrade">
                            <span><img src="./images/upgrades/flame.jpg" alt="Flame Decals"></span>
                            <a href="" title="Flame Decals">Flame Decals</a>
                        </div>
                        <div class="upgrade">
                            <span><img src="./images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers"></span>
                            <a href="" title="Bumper Stickers">Bumper Stickers</a>
                        </div>
                        <div class="upgrade">
                            <span><img src="./images/upgrades/hub-cap.jpg" alt="Hub Caps"></span>
                            <a href="" title="Hub Caps">Hub Caps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/modules/footer.php"); ?>
    </body>
</html>