<?php
    require_once('pagetitle.php');
    $page_title = P_ADD_PROFILE_PAGE;
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Make a Profile</title>
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
            <div class="card-body">
                <?php
                    // Initialization 
                    $display_add_profile_form = true;
                    $user_name = "";
                    $first_name = "";
                    $last_name = "";
                    $password = "";

                    if (isset($_POST['add_profile_submission'],$_POST['user_name'],
                              $_POST['first_name'], $_POST['last_name'],
                             $_POST['password']))
                    {
                        require_once('dbconnection.php');
                        require_once('profileimagefileutil.php');

                        $user_name = $_POST['user_name'];
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $password = $_POST['password'];


                        /*
                        Here is where we will deal with the file by calling 
                        validateProfileImageFile(). This function will validate that
                        the profile image file is not greater than 128 characters, is 
                        the right image type (jpg/png/gif), and not greater than 512KB.
                        This function will return an empty string ('') if the file 
                        validates successfully, otherwise, the string will contain
                        error text to be output to the web page before redisplaying
                        the form.
                        */
                        $file_error_message = validateProfileImageFile();
                        if (empty($file_error_message)) { 
                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                                    or trigger_error(
                                        'Error connecting to MySQL server for' . DB_NAME,
                                    E_USER_ERROR
                                    );

                            $profile_image_file_path = addProfileImageFileReturnPathLocation();

                            if (empty($profile_image_file_path)) {
                                $profile_image_file_path = 'images/'
                                 . P_DEFAULT_PROFILE_FILE_NAME; // Default image
                                }
                            $salted_hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            $query = "INSERT INTO player (user_name, first_name, "
                                    . "last_name, password_hash, image_file) "
                                    . "VALUES ('$user_name', '$first_name', '$last_name',"
                                    . "'$salted_hashed_password',"
                                    . "'$profile_image_file_path')";

                           $result = mysqli_query($dbc, $query)
                            or trigger_error(
                                'Error querying database exercise_user:
                                 Failed to insert exercise user',
                                E_USER_ERROR
                            );

                            if (empty($profile_image_file_path))
                            {
                                $profile_image_file_path = 'var/www/html/projects/project4/images/'
                                 . P_DEFAULT_PROFILE_FILE_NAME;
                            }
                            if (!empty($profile_image_file_path) && 
                                       $profile_image_file_path !== 'images/'
                                 . P_DEFAULT_PROFILE_FILE_NAME) {
                                    $profile_image_file_path = 'images/'
                                 . basename($profile_image_file_path); 
                            }   

                            $display_add_profile_form = false;
                ?>
                <h3 class="text-info">Your profile Is Finished</h3><br/>
                <h1><?= $user_name ?></h1>
                <div class="row">
                    <div class="col-2">
                        <img src="images/<?= basename($profile_image_file_path) ?>" 
                             class="img-thumbnail"
                             style="max-height: 200px;" alt="profile image">
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">User Name</th>
                                    <td><?= $user_name ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">First Name</th>
                                    <td><?= $first_name ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name</th>
                                    <td><?= $last_name ?></td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr/>
                <form action="login.php" method="get">
                    <button class="btn btn-primary" type="submit">Go to Login</button>
                </form>
                <?php
                if (isset($_SESSION['user_access_privileges'])
                                && $_SESSION['user_access_privileges'] == 'admin') {
                ?>
                <form action="index.php" method="get">
                    <button class="btn btn-primary" type="submit">Go to home</button>
                </form>
                <?php
                }
                ?>
                <?php
                        }
                        else
                        {
                            // echo error message
                            echo "<h5><p class='text-danger'>" . $file_error_message
                             . "</p></h5>";
                        }
                    }
                    if ($display_add_profile_form)
                    {
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
                        <label for="password" 
                               class="col-sm-2 col-form-label-lg">Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password"
                                   name="password" 
                                   placeholder="Enter a password" required>
                            <div class="form-group form-check"></div>
                            <div class="invalid-feedback">
                                 Please provide a valid password.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_image_file"
                               class="col-sm-3 col-form-label-lg">Profile Image</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control-file"
                                   id="profile_image_file" name="profile_image_file">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"
                            name="add_profile_submission">Add Profile</button>
                </form>
                <script>
                    // JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                            window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
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
                <?php
                    } // Display add exercise form
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    </body>
</html>