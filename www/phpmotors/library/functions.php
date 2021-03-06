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
            $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
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
    function buildVehicleDetailDisplay($vehicle, $thumbnails, $reviews) {
        // MAIN IMAGE
        $dv = '<div class="car__image__container">';
        $dv .= "<img class='car__image' src='$vehicle[imgPath]' alt='$vehicle[invMake] $vehicle[invModel]'>";
        $dv .= '</div>';
        // HEADER
        $dv .= '<div class="car__info__container">';
        $dv .= "<strong class='car__name'>$vehicle[invMake] $vehicle[invModel]</strong>";
        $dv .= "<p>$vehicle[invColor] - $vehicle[classificationName]</p>";
        $dv .= '<p>$' . number_format($vehicle['invPrice'], 2) . '</p>';
        $dv .= "<p>$vehicle[invStock] currently in stock</p>";
        $dv .= '</div>';
        // DESCRIPTION
        $dv .= '<div class="car__description">';
        $dv .= "<p>$vehicle[invDescription]</p>";
        $dv .= '</div>';
        // REVIEWS
        $dv .= '<div class="car__reviews__container">';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] Reviews</h2>";
        if (isset($_SESSION['message'])) {
            $dv .= $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if ($_SESSION['loggedin']) {
            // NEW REVIEW FORM
            $dv .= '<form class="form" method="post" action="/phpmotors/reviews/" name="review">';
            $dv .= '<ul><li>';
            $dv .= '<label for="reviewText">Leave a Review</label>';
            $dv .= '<textarea rows="2" cols="48" name="reviewText" id="reviewText" placeholder=" " required></textarea>';
            $dv .= '</li><li>';
            $dv .= '<input class="submit" type="submit" value="Submit">';
            $dv .= '</li></ul>';
            $dv .= '<input type="hidden" name="action" value="review">';
            $dv .= '<input type="hidden" name="clientId" value="' . $_SESSION['clientData']['clientId'] . '">';
            $dv .= "<input type='hidden' name='invId' value='$vehicle[invId]'>";
            $dv .= '</form>';
        } else {
            $dv .= '<p><a href="/phpmotors/accounts/?action=signin">Login</a> to leave a review.</p>';
        }
        $dv .= '<ul class="car__reviews">';
        if ($reviews) {
            foreach ($reviews as $review) {
                $date = date("m/d/Y", strtotime($review['reviewDate']));

                $dv .= '<li class="review">';
                $dv .= '<strong class="clientName">' . substr($review['clientFirstname'], 0, 1) . ". $review[clientLastname]</strong>";
                $dv .= " ($date)";
                $dv .= "<div class='reviewText'>$review[reviewText]</div>";
                $dv .= '</li>';
            }
        }
        $dv .= '</ul>';
        $dv .= '</div>';
        // THUMBNAILS
        if (!count($thumbnails)) {
            return $dv;
        }
        $dv .= '<div class="car__thumbnail__container">';
        $dv .= '<h2 class="car__thumbnail__container--header">Additional Images</h2>';
        foreach ($thumbnails as $tn) {
            $dv .= "<img class='car__thumbnail' src='$tn[imgPath]' alt='$vehicle[invMake] $vehicle[invModel] secondary thumbnail'>";
        }
        $dv .= '</div>';

        return $dv;
    }

    /* * ********************************
    *  Functions for working with images
    * ********************************* */
    // Adds "-tn" designation to file name
    function makeThumbnailName($image) {
        $i = strrpos($image, '.');
        $image_name = substr($image, 0, $i);
        $ext = substr($image, $i);
        $image = $image_name . '-tn' . $ext;
        return $image;
    }

    // Build images display for image management view
    function buildImageDisplay($imageArray) {
        $id = '<ul id="image-display">';
        foreach ($imageArray as $image) {
            $id .= '<li>';
            $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
            $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete this image'>Delete $image[imgName]</a></p>";
            $id .= '</li>';
        }
        $id .= '</ul>';
        return $id;
    }

    // Build the vehicles select list
    function buildVehiclesSelect($vehicles) {
        $prodList = '<select name="invId" id="invId">';
        $prodList .= "<option value='' data-default>-- Choose a Vehicle --</option>";
        foreach ($vehicles as $vehicle) {
            $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
        }
        $prodList .= '</select>';
        return $prodList;
    }

    // Handles the file upload process and returns the path
    // The file path is stored into the database
    function uploadFile($name) {
        // Gets the paths, full and local directory
        global $image_dir, $image_dir_path;
        if (isset($_FILES[$name])) {
            // Gets the actual file name
            $filename = $_FILES[$name]['name'];
            if (empty($filename)) {
                return;
            }
            // Get the file from the temp folder on the server
            $source = $_FILES[$name]['tmp_name'];
            // Sets the new path - images folder in this directory
            $target = $image_dir_path . '/' . $filename;
            // Moves the file to the target folder
            move_uploaded_file($source, $target);
            // Send file for further processing
            processImage($image_dir_path, $filename);
            // Sets the path for the image for Database storage
            $filepath = $image_dir . '/' . $filename;
            // Returns the path where the file is stored
            return $filepath;
        }
    }

    // Processes images by getting paths and 
    // creating smaller versions of the image
    function processImage($dir, $filename) {
        // Set up the variables
        $dir = $dir . '/';
    
        // Set up the image path
        $image_path = $dir . $filename;
    
        // Set up the thumbnail image path
        $image_path_tn = $dir.makeThumbnailName($filename);
    
        // Create a thumbnail image that's a maximum of 200 pixels square
        resizeImage($image_path, $image_path_tn, 200, 200);
    
        // Resize original to a maximum of 500 pixels square
        resizeImage($image_path, $image_path, 500, 500);
    }

    // Checks and Resizes image
    function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];
    
        // Set up the function names
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;
            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;
            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;
            default:
                return;
        } // ends the swith
    
        // Get the old image and its height and width
        $old_image = $image_from_file($old_image_path);
        $old_width = imagesx($old_image);
        $old_height = imagesy($old_image);
    
        // Calculate height and width ratios
        $width_ratio = $old_width / $max_width;
        $height_ratio = $old_height / $max_height;
    
        // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {
            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);
        
            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);
        
            // Set transparency according to image type
            if ($image_type == IMAGETYPE_GIF) {
                $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagecolortransparent($new_image, $alpha);
            }
        
            if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }
        
            // Copy old image to new image - this resizes the image
            $new_x = 0;
            $new_y = 0;
            $old_x = 0;
            $old_y = 0;
            imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
        
            // Write the new image to a new file
            $image_to_file($new_image, $new_image_path);
            // Free any memory associated with the new image
            imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
    } // ends resizeImage function

    /********** REVIEW FUNCTIONS **********/
    function buildClientReviewsDisplay($clientReviews) {
        $dr = "";
        foreach($clientReviews as $review) {
            $date = date("m/d/Y", strtotime($review['reviewDate']));

            $dr .= "<tr><td>$review[invMake] $review[invModel]</td>";
            $dr .= "<td>$review[reviewText]</td>";
            $dr .= "<td>$date</td>";
            $dr .= "<td class='reviewLink'><a href='/phpmotors/reviews/?action=edit&reviewId=$review[reviewId]' title='Click to modify'>Edit</a></td>";
            $dr .= "<td class='reviewLink'><a href='/phpmotors/reviews/?action=remove&reviewId=$review[reviewId]' title='Click to delete'>Delete</a></td>";
        }
        return $dr;
    }
?>