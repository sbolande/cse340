<?php
    // build navbar for all views
    function buildNavList($classifications) {
        // Build a navigation bar using the $classifications array
        $navList = '<ul id="navbar">';
        $navList .= "<li><a class='navbar-item' href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a class='navbar-item' href='/phpmotors/?action=";
            $navList .= urlencode($classification['classificationName']);
            $navList .= "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    // check email
    function checkEmail($clientEmail) {
        return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    }

    // match password to spec
    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    // match image or thumbnail file path to pattern
    function checkFilepath($filepath) {
        $pattern ='/^(.+)(\/|\\)([^\/]+).(png|jpg|jpeg|svg)$/';
        return preg_match($pattern, $filepath);
    }

    // build select list of classifications
    function buildClassificationList($classifications) {
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
            $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
    }

    // get vehicles by classification id
    function getInventoryByClassification($classificationId) {
        $db = phpmotorsConnect(); 
        $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId'; 
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
        $stmt->execute(); 
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $inventory; 
    }
?>