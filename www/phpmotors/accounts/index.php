<? // ACCOUNTS CONTROLLER
    // get the phpmotorsConnect() function
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php");
    // get the functions library
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/functions.php");
    // get the main model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/main-model.php");
    // get the accounts model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/accounts-model.php");

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
        case 'login':
            $clientEmail = checkEmail(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

            // check for missing inputs
            if(empty($clientEmail) || empty(checkPassword($clientPassword))) {
                $message = '<p class="errorMsg">Something did not work! Please check your email and password and try logging in again.</p>';
                include '../view/login.php';
                exit;
            }

            break;
        case 'registration':
            include '../view/registration.php';
            break;
        case 'register':
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
            $clientEmail = checkEmail(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

            // check for missing inputs
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty(checkPassword($clientPassword))) {
                $message = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit; 
            }
            // check for already existing email
            // foreach ($emails as $email) {}
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

            // Check and report the result
            if($regOutcome === 1) {
                $message = "<p class='successMsg'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p class='errorMsg'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;
        default:
            include '../view/login.php';
    }
?>