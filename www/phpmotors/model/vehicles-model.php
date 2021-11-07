<? // VEHICLES MODEL

    /******************** CLIENT FUNCS ********************/
    // FETCH VEHICLES BY CLASS NAME
    function getVehiclesByClassification($classificationName) {
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    }

    // BUILD VEHICLES.PHP BODY CONTENT
    function buildVehiclesDisplay($vehicles) {
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
            $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
            $dv .= '<hr>';
            $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
            $dv .= "<span>$$vehicle[invPrice]</span>";
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    /******************** ADMIN FUNCS ********************/
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
    function addVehicle($invMake,
        $invModel,
        $invDescription,
        $invImage,
        $invThumbnail,
        $invPrice,
        $invStock,
        $invColor,
        $classificationId
    ) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    // GET VEHICLE INFO BY ID
    function getInvItemInfo($invId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    // UPDATE VEHICLE
    function updateVehicle($invMake,
        $invModel,
        $invDescription,
        $invImage,
        $invThumbnail,
        $invPrice,
        $invStock,
        $invColor,
        $classificationId,
        $invId
    ) {
        $db = phpmotorsConnect();
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // DELETE VEHICLE
    function deleteVehicle($invId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
?>