<? // REVIEWS MODEL
    // INSERT REVIEW
    function addReview($reviewText, $invId, $clientId) {
        $db = phpmotorsConnect();
        $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // GET REVIEWS BY VEHICLE
    function getVehicleReviews($invId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT reviewText, reviewDate, clientFirstname, clientLastname FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviews;
    }

    // GET REVIEWS BY CLIENT
    function getClientReviews($clientId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT reviewId, reviewText, reviewDate, invMake, invModel FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE clientId = :clientId ORDER BY reviewDate DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviews;
    }

    // GET REVIEW BY ID
    function getReview($reviewId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT reviewId, reviewText, reviewDate, clientId, invMake, invModel FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $review;
    }

    // UPDATE REVIEW
    function updateReview($reviewId, $reviewText, $reviewDate) {
        $db = phpmotorsConnect();
        $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // DELETE REVIEW
    function deleteReview($reviewId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
?>