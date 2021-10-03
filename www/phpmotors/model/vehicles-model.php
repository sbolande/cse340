<? // VEHICLES MODEL

    // CREATE NEW CLASSIFICATION
    function addClassification($classificationName) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement
        $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    
    // CREATE NEW INVENTORY VEHICLE ITEM
    function addVehicle(
        $invMake, 
        $invModel, 
        $invDescription, 
        $invImage, 
        $invThumbnail, 
        $invPrice, 
        $invStock, 
        $invColor, 
        $classificationId
    ) {
        return 0;
    }
?>