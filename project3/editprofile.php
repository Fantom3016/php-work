<?php
    require_once('pagetitle.php');
    $page_title = P_EDIT_PROFILE_PAGE;
    session_start();
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        die("Error: User not logged in."); 
}
?>
<html>
    <head>
        <title><?= $page_title ?></title>
        <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    </head>
    <body>
        <?php
            require_once('navmenu.php');
        ?>
        <div class="card">
                <h1>Edit Your Profile</h1>
                <?php
                    require_once('dbconnection.php');
                    require_once('profileimagefileutil.php');

                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error(
                    'Error connecting to MySQL server for ' . DB_NAME,
                    E_USER_ERROR
                    ); 

                    if (isset($_GET['id_to_edit'])) {
                        $id_to_edit = $_GET['id_to_edit'];
                    
                        $query = "SELECT * FROM exercise_user WHERE id = $id_to_edit";
                        $result = mysqli_query($dbc, $query)
                            or trigger_error('Error querying database exercise_user', E_USER_ERROR);


                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_assoc($result);
                            
                            $user_name = $row['user_name'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $gender = $row['gender'];
                            $birthdate = $row['birthdate'];
                            $weight = $row['weight'];
                            $profile_image_file_path = $row['image_file'];

                             if (empty($profile_image_file_path)):
                                 $profile_image_file_path =  'var/www/html/projects/project3/images/'
                                  . basename($profile_image_file_path);
                            endif;
                        }
                    } elseif (isset($_POST['edit_profile_submission'], $_POST['user_name'],
                            $_POST['first_name'], $_POST['last_name'], $_POST['gender'], 
                            $_POST['birthdate'], $_POST['weight'])) {

                            $user_name = $_POST['user_name'];
                            $first_name = $_POST['first_name'];
                            $last_name = $_POST['last_name'];
                            $gender = $_POST['gender'];
                            $birthdate = $_POST['birthdate'];
                            $weight = $_POST['weight'];
                            $id_to_update = $_POST['id_to_update'];

                            $profile_image_file_path = addProfileImageFileReturnPathLocation();
                            $salted_hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            $query = "UPDATE exercise_user SET user_name = '$user_name',"
                                . "first_name = '$first_name',"
                                . "last_name = '$last_name',"
                                . "gender = '$gender',"
                                . "birthdate = '$birthdate',"
                                . "weight = '$weight',"
                                . "image_file = '$profile_image_file_path'"
                                . "WHERE id = '$id_to_update'";

                            mysqli_query($dbc, $query)
                                or trigger_error(
                                'Error querying database exercise_user: Failed to update exercise_user listing',
                                E_USER_ERROR
                                );

                                if (empty($profile_image_file_path))
                                {
                                    $profile_image_file_path = P_UPLOAD_PATH . P_DEFAULT_PROFILE_FILE_NAME;
                                }
                            $display_edit_profile_form = false;

                        //Stopped here
                        $nav_link = 'profile.php?id=' . $id_to_update;

                        header("Location: $nav_link");
                        exit;
                    }
                    
                ?>
                <form enctype="multipart/form-data" class="needs-validation" novalidate
                    method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="user_name"
                        class="col-sm-3 col-form-label-lg">User Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_name"
                                   name="user_name" value="<?= $user_name ?>"
                                   placeholder="User Name" required>
                            <div class="invalid-feedback">
                                Please provide a valid User Name.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name"
                        class="col-sm-3 col-form-label-lg">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="first_name"
                                   name="first_name" value="<?= $first_name ?>"
                                   placeholder="First Name" required>
                            <div class="invalid-feedback">
                                Please provide a valid First Name.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name"
                        class="col-sm-3 col-form-label-lg">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="last_name"
                                   name="last_name" value="<?= $last_name ?>"
                                   placeholder="Last Name" required>
                            <div class="invalid-feedback">
                                Please provide a valid Last Name.
                            </div>
                        </div>
                    </div>
                   <div class="form-group row">
                        <label for="gender" class="col-sm-3 col-form-label-lg">Gender</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="gender"
                                name="gender" value="<?= $gender ?>" required>
                                <option value="" disabled selected>Gender</option>
                                <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Non-binary" <?= $gender == 'Non-binary' ? 'selected' : '' ?>>Non-binary</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select Gender.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birthdate"
                        class="col-sm-3 col-form-label-lg">Birthdate</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="birthdate"
                                   name="birthdate" value="<?= $birthdate ?>"
                                   placeholder="Birthdate" required>
                            <div class="invalid-feedback">
                                Please provide a valid Birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="weight"
                        class="col-sm-3 col-form-label-lg">Weight</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="weight"
                                   name="weight" value="<?= $weight ?>"
                                   placeholder="Weight" required>
                            <div class="invalid-feedback">
                                Please provide a valid Weight.
                            </div>
                        </div>
                    </div>
                     <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label-lg">Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                        <div class="form-group form-check">
                        </div>
                        <div class="invalid-feedback">Please provide a valid password.</div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_image_file"
                               class="col-sm-3 col-form-label-lg">Profile Image File</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control-file"
                                   id="profile_image_file" name="profile_image_file">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"
                            name="edit_profile_submission">Update profile
                    </button>
                    <input type="hidden" name="id_to_update"
                            value="<?= $id_to_edit ?>">
                </form> 
                <script>
                    // JavaScript for disabling form submissions if there are invalid fields
                    (function () {
                        'use strict';
                        window.addEventListener('load', function () {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function (form) {
                                form.addEventListener('submit', function (event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>
            </div>
        </div> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous">    
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous">
        </script>
    </body>
</html>