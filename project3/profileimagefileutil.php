<?php
    require_once 'profileconstants.php';

    function validateProfileImageFile()
    { 
        $error_message = "";

        // Check for $_FILES being set and no errors.
        if (isset($_FILES) && $_FILES['profile_image_file']['error'] == UPLOAD_ERR_OK)
        {
            // Check for uploaded file < Max file size AND an acceptable image type
            if ($_FILES['profile_image_file']['size'] > P_MAX_FILE_SIZE)
            {
                $error_message = "The profile file image must be less than "
                                . P_MAX_FILE_SIZE . " Bytes";
            }
            $image_type = $_FILES['profile_image_file']['type'];

            if ($image_type != 'image/jpg' && $image_type != 'image/jpeg'
                && $image_type != 'image/pjpeg' && $image_type != 'image/png'
                && $image_type != 'image/gif')
            {
                if (empty($error_message))
                {
                    $error_message = "The image must be of type jpg, png, or gif.";
                }
                else 
                {
                    $error_message .= ", and be an image of type jpg, png, or gif.";
        
                }
            }
        }
        elseif (isset($_FILES)
                && $_FILES['profile_image_file']['error'] != UPLOAD_ERR_NO_FILE
                && $_FILES['profile_image_file']['error'] != UPLOAD_ERR_OK)
        {
            $error_message = "Error uploading profile image file.";
        }

        return $error_message;

    }

    function addProfileImageFileReturnPathLocation()
    {
        $profile_image_file = "";

        // Check for $_FILES being set and no errors.
        if (isset($_FILES) && $_FILES['profile_image_file']['error'] == UPLOAD_ERR_OK) {
            $profile_image_file = 
                P_UPLOAD_PATH . $_FILES['profile_image_file']['name'];

            if (!move_uploaded_file($_FILES['profile_image_file']['tmp_name'],
                                    $profile_image_file))
            {
                $profile_image_file = "";
            }
        }
        
        return $profile_image_file;
    }
?>