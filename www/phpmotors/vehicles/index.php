<? // VEHICLES CONTROLLER
    // get the phpmotorsConnect() function
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php");
    // get the main model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/main-model.php");
    // get the vehicles model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/vehicles-model.php");

    // get classifications array
    $classifications = getClassifications();
    // Build a navigation bar using the $classifications array
    $navList = '<ul id="navbar">';
    $navList .= "<li><a class='navbar-item' href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a class='navbar-item' href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
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
            $classificationName = filter_input(INPUT_POST, 'classificationName');

            // check for missing input
            if(empty($classificationName)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }
            // check for already existing classification
            foreach ($classifications as $classification) {
                if ($classificationName == $classification['classificationName']) {
                    $message = "<p>The $classificationName classification already exists!</p>";
                    include '../view/add-classification.php';
                    exit;
                }
            }

            $addClassOutcome = addClassification($classificationName);

            // Check and report the result
            if($addClassOutcome === 1) {
                header('Location: /phpmotors/vehicles/index.php');
                exit;
            } else {
                $message = "<p>Sorry, but adding the classification failed. Please try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            
            break;
        case 'addVehicle':
            break;
        default:
            include '../view/vehicle-management.php';
    }
?>