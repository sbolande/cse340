<? // ACCOUNTS CONTROLLER
    session_start();

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
    $navList = buildNavList($classifications);
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action) {
        case 'signin':
            include '../view/login.php';
            break;
        case 'login':
            $clientEmail = checkEmail(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

            // check for missing inputs
            if(empty($clientEmail) || empty(checkPassword($clientPassword))) {
                $message = '<p class="errorMsg">Something did not work! Please check your email and password and try logging in again.</p>';
                include '../view/login.php';
                exit;
            }
            // query client data
            $clientData = getClient($clientEmail);
            // verify password
            if(!password_verify($clientPassword, $clientData['clientPassword'])) {
                $message = '<p class="errorMsg">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }

            // validation complete, log in user
            $_SESSION['loggedin'] = TRUE;
            // remove password
            array_pop($clientData);
            // store session vars
            $_SESSION['clientData'] = $clientData;
            // send them to the admin view
            include '../view/admin.php';

            // remove the message session var in case a new user has successfully logged in
            unset($_SESSION['message']);
            exit;
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
            // check for existing email
            if (checkExistingEmail($clientEmail)) {
                $message = '<p class="errorMsg">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome === 1) {
                $_SESSION['message'] = "<p class='successMsg'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p class='errorMsg'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;
        case 'update':
            include '../view/client-update.php';
            exit;
            break;
        case 'updateAccount':
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
            $clientEmail = checkEmail(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING));

            // check for missing inputs
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)) {
                $accountMessage = '<p class="errorMsg">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit; 
            }
            // check for existing email
            if ($clientEmail !== $_SESSION['clientData']['clientEmail'] && checkExistingEmail($clientEmail)) {
                $accountMessage = "<p class='errorMsg'>The new email address '$clientEmail' already exists. Please use a different email.</p>";
                // reset client email for stickyness
                $clientEmail = $_SESSION['clientData']['clientEmail'];
                include '../view/client-update.php';
                exit;
            }

            $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

            // Check and report the result
            if($updateOutcome === 1) {
                $_SESSION['message'] = "<p class='successMsg'>Thanks for updating $clientFirstname.</p>";
                // query client data
                $clientData = getClientById($clientId);
                // remove password
                array_pop($clientData);
                // store session vars
                $_SESSION['clientData'] = $clientData;
                header('Location: /phpmotors/accounts/');
                exit;
            } else {
                $accountMessage = "<p class='errorMsg'>Sorry but the update failed. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }
            break;
        case 'changePassword':
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING));

            // check for missing inputs
            if(empty(checkPassword($clientPassword)) || empty($clientId)) {
                $passwordMessage = '<p class="errorMsg">Something went wrong! Check that the password matches the requested format.</p>';
                include '../view/client-update.php';
                exit; 
            }
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            $updateOutcome = changeClientPassword($hashedPassword, $clientId);
            
            // Check and report the result
            if($updateOutcome === 1) {
                $_SESSION['message'] = "<p class='successMsg'>Thanks for changing your password.</p>";
                header('Location: /phpmotors/accounts/');
                exit;
            } else {
                $passwordMessage = "<p class='errorMsg'>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the password change failed. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }
            break;
        case 'logout':
            unset($_SESSION['clientData']);
            unset($_SESSION['loggedin']);
            unset($_SESSION['message']);
            session_destroy();
            header('Location: /phpmotors/');
            exit;
            break;
        default:
            include '../view/admin.php';
    }
?>