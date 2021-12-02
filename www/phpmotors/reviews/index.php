<? // REVIEWS CONTROLLER
    session_start();
    
    // get the phpmotorsConnect() function
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/connections.php");
    // get the functions library
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/library/functions.php");
    // get the main model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/main-model.php");
    // get the reviews model
    require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmotors/model/reviews-model.php");

    // get classifications array
    $classifications = getClassifications();
    // Build a navigation bar using the $classifications array
    $navList = buildNavList($classifications);
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }
    switch ($action) {
        case 'review':
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
            $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT));

            if (empty($reviewText)) {
                $message = '<p class="errorMsg">Reviews cannot be empty.</p>';
            } else if (empty($invId) || empty($clientId)) {
                $message = '<p class="errorMsg">Sorry, reviewing failed. Please make sure you are logged in and try again.</p>';
            } else {
                $result = addReview($reviewText, $invId, $clientId);
                if ($result < 1) {
                    $message = '<p class="errorMsg">Sorry, reviewing failed. Please make sure you are logged in and try again.</p>';
                }
            }
                
            // Store message to session
            $_SESSION['message'] = $message;
            // Redirect to vehicle details
            header("location: /phpmotors/vehicles/?action=details&invId=$invId");
            break;
        case 'edit':
            $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
            $review = getReview($reviewId);

            $_SESSION['message'] = "";
            if (!count($review)) {
                $_SESSION['message'] = '<p class="errorMsg">The review could not be found.</p>';
                header('location: /phpmotors/accounts/');
                exit;
            } else if ($_SESSION['clientData']['clientId'] !== $review['clientId']) {
                $_SESSION['message'] = '<p class="errorMsg">That review belongs to another user, please try again.</p>';
                header('location: /phpmotors/accounts/');
                exit;
            }

            include '../view/review-update.php';
            exit;
            break;
        case 'updateReview':
            $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT));
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT));

            if (empty($reviewText)) {
                $message = '<p class="errorMsg">Reviews cannot be empty.</p>';
            } else if (empty($reviewId) || $_SESSION['clientData']['clientId'] !== $clientId) {
                $message = '<p class="errorMsg">Sorry, updating the review failed. Please make sure you are logged in and try again.</p>';
            } else {
                $today = new DateTime("NOW", new DateTimeZone('America/Boise'));
                $result = updateReview($reviewId, $reviewText, $today->format('Y-m-d H:i:s'));
                if ($result < 1) {
                    $message = '<p class="errorMsg">Sorry, updating the review failed. Please make sure you are logged in and try again.</p>';
                } else {
                    $message = '<p class="successMsg">Review successfully updated.</p>';
                }
            }

            // Store message to session
            $_SESSION['message'] = $message;
            // Redirect to client admin page
            header("location: /phpmotors/accounts/");
            break;
        case 'remove':
            $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
            $review = getReview($reviewId);

            $_SESSION['message'] = "";
            if (!count($review)) {
                $_SESSION['message'] = '<p class="errorMsg">The review could not be found.</p>';
                header('location: /phpmotors/accounts/');
                exit;
            } else if ($_SESSION['clientData']['clientId'] !== $review['clientId']) {
                $_SESSION['message'] = '<p class="errorMsg">That review belongs to another user, please try again.</p>';
                header('location: /phpmotors/accounts/');
                exit;
            }

            include '../view/review-delete.php';
            exit;
            break;
        case 'deleteReview':
            $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT));

            if (empty($reviewId) || $_SESSION['clientData']['clientId'] !== $clientId) {
                $message = '<p class="errorMsg">Sorry, deleting the review failed. Please make sure you are logged in and try again.</p>';
            } else {
                $result = deleteReview($reviewId);
                if ($result < 1) {
                    $message = '<p class="errorMsg">Sorry, deleting the review failed. Please make sure you are logged in and try again.</p>';
                } else {
                    $message = '<p class="successMsg">Review successfully deleted.</p>';
                }
            }

            // Store message to session
            $_SESSION['message'] = $message;
            // Redirect to client admin page
            header("location: /phpmotors/accounts/");
            break;
        default:
            if ($_SESSION['loggedin']) {
                header("location: /phpmotors/accounts/");
                exit;
            } else {
                header("location: /phpmotors/");
                exit;
            }
            break;
    }
?>