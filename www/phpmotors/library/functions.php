<?php
    // build navbar for all views
    function buildNavList($classifications) {
        // Build a navigation bar using the $classifications array
        $navList = '<ul id="navbar">';
        $navList .= "<li><a class='navbar-item' href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a class='navbar-item' href='/phpmotors/vehicles/?action=classification&classificationName=";
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

    // build VIEW/CLASSIFICATION.PHP body content
    function buildVehiclesDisplay($vehicles) {
        $dv = '<ul class="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
            $dv .= "<a href='/phpmotors/vehicles/?action=details&invId=$vehicle[invId]' title='$vehicle[invModel] Details'>";
            $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
            $dv .= '</a>';
            $dv .= '<hr>';
            $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
            $dv .= '<span>$' . number_format($vehicle['invPrice'], 2) . '</span>';
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    // build VIEW/VEHICLE-DETAILS.PHP body content
    function buildVehicleDetailDisplay($vehicle) {
        $dv = '<div class="car__image__container">';
        $dv .= "<img class='car__image' src='$vehicle[invImage]' alt='$vehicle[invMake] $vehicle[invModel]'>";
        $dv .= '</div>';
        $dv .= '<div class="car__info__container">';
        $dv .= "<strong class='car__name'>$vehicle[invMake] $vehicle[invModel]</strong>";
        $dv .= "<p>$vehicle[invColor] - $vehicle[classificationName]</p>";
        $dv .= '<p>$' . number_format($vehicle['invPrice'], 2) . '</p>';
        $dv .= "<p>$vehicle[invStock] currently in stock</p>";
        $dv .= '</div>';
        $dv .= '<div class="car__description">';
        $dv .= "<p>$vehicle[invDescription]</p>";
        $dv .= '</div>';

        return $dv;
    }
?>