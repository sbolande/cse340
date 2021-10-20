<?php
    function checkEmail($clientEmail) {
        return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    }

    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }
?>