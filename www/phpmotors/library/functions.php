<?php
    function buildNavList($classifications) {
        // Build a navigation bar using the $classifications array
        $navList = '<ul id="navbar">';
        $navList .= "<li><a class='navbar-item' href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a class='navbar-item' href='/phpmotors/index.php?action=";
            $navList .= urlencode($classification['classificationName']);
            $navList .= "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    function checkEmail($clientEmail) {
        return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    }

    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    function checkFilepath($filepath) {
        $pattern ='/^(.+)(\/|\\)([^\/]+).(png|jpg|jpeg|svg)$/';
        return preg_match($pattern, $filepath);
    }
?>