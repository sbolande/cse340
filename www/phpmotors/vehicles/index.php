<? // VEHICLES CONTROLLER
    session_start();

    // get the phpmotorsConnect() function
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php");
    // get the functions library
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/functions.php");
    // get the main model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/main-model.php");
    // get the vehicles model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/vehicles-model.php");

    // get classifications array
    $classifications = getClassifications();
    // Build a navigation bar using the $classifications array
    $navList = buildNavList($classifications);
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action) {
        case 'manageClassification':
            include '../view/add-classification.php';
            break;
        case 'manageVehicle':
            include '../view/add-vehicle.php';
            break;
        case 'addClassification':
            $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

            // check for missing input
            if (empty($classificationName)) {
                $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }
            // check for already existing classification
            foreach ($classifications as $classification) {
                if ($classificationName == $classification['classificationName']) {
                    $message = "<p class='errorMsg'>The $classificationName classification already exists!</p>";
                    include '../view/add-classification.php';
                    exit;
                }
            }
            // check input length
            if (mb_strlen($classificationName) > 30) {
                $message = '<p class="errorMsg">Classification name must not exceed 30 characters.</p>';
                include '../view/add-classification.php';
                exit;
            }

            $addClassOutcome = addClassification($classificationName);

            // Check and report the result
            if ($addClassOutcome === 1) {
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='errorMsg'>Sorry, but adding the classification failed. Please try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            
            break;
        case 'addVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            // check for missing input
            if (empty($invMake) || empty($invModel) || empty($invDescription) ||
                empty($invImage) || empty($invThumbnail) || empty($invPrice) ||
                empty($invStock) || empty($invColor) || empty($classificationId)) {
                $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
                include '../view/add-vehicle.php';
                exit;
            }

            // check other input formalities
            if (empty(checkFilepath($invImage)) || empty(checkFilepath($invThumbnail))) {
                $message = '<p class="errorMsg">Please check that image & thumbnail file/URL paths are correct.</p>';
                include '../view/add-vehicle.php';
                exit;
            }

            // Send the data to the model
            $addVehicleOutcome = addVehicle($invMake, $invModel, $invDescription,
                $invImage, $invThumbnail, $invPrice,
                $invStock, $invColor, $classificationId);

            // Check and report the result
            if ($addVehicleOutcome === 1) {
                $message = "<p class='successMsg'>$invMake successfully added!</p>";
                include '../view/add-vehicle.php';
                exit;
            } else {
                $message = "<p class='errorMsg'>Sorry, but adding the vehicle failed. Please try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;
        case 'getInventoryItems':
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $inventoryArray = getInventoryByClassification($classificationId);
            echo json_encode($inventoryArray);
            break;
        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = '<p class="errorMsg">Sorry, no vehicle information could be found.</p>';
            }
            include '../view/vehicle-update.php';
            exit;
            break;
        case 'updateVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
            $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

            if (empty($invMake) || empty($invModel) || empty($invDescription) ||
                empty($invImage) || empty($invThumbnail) || empty($invPrice) ||
                empty($invStock) || empty($invColor) || empty($classificationId)) {
                $message = '<p class="errorMsg">Please complete all information for the updated item! Double check the classification of the item.</p>';
                include '../view/vehicle-update.php';
                exit;
            }
            $updateResult = updateVehicle($invMake, $invModel, $invDescription,
                $invImage, $invThumbnail, $invPrice, $invStock,
                $invColor, $classificationId, $invId);
            if ($updateResult) {
                $message = "<p class='successMsg'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='errorMsg'>Error: The vehicle was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
            break;
        case 'del':
            $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT));
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo) < 1) {
                $message = '<p class="errorMsg">Sorry, no vehicle information could be found.</p>';
            }
            include '../view/vehicle-delete.php';
            exit;
            break;
        case 'deleteVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='successMsg'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='errorMsg'>Error: $invMake $invModel was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('Location: /phpmotors/vehicles/');
                exit;
            }
            break;
        default:
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-management.php';
            break;
    }
?>