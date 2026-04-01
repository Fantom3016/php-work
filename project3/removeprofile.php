<?php
require_once('pagetitle.php');
$page_title = P_REMOVE_PROFILE_PAGE;
?>
<html>
<head>
    <title>Remove a profile</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
          crossorigin="anonymous">
</head>
<body>
<div class="card">
    <div class="card-body">
        <h1>Remove a Profile</h1>
        <?php
        require_once('dbconnection.php');

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error('Error connecting to MySQL server.', E_USER_ERROR);

       if (isset($_POST['delete_profile_submission']) && isset($_POST['id'])):
                    
                    $id = $_POST['id'];
                    
                $query_log = "DELETE FROM exercise_log WHERE exercise_id = $id";

                mysqli_query($dbc, $query_log) or trigger_error(
                    'Error deleting from exercise_log', E_USER_ERROR);

                    $query = "DELETE FROM exercise_user WHERE id = $id";

                    $result = mysqli_query($dbc, $query)
                            or trigger_error(
                                'Error querying database exercise_user', E_USER_ERROR);
                
                    header("Location: logout.php");
                    exit;
                
                elseif (isset($_POST['do_not_delete_profile_submission'])):
                    
                    header("Location: index.php");
                    exit;
                    
                elseif (isset($_GET['id_to_delete'])):
            ?>
            <h3 class="text-danger">Confirm Deletion of the Following
                Post Details:</h3><br/>
            <?php
                $id = $_GET['id_to_delete'];

                $query = "SELECT * FROM exercise_user WHERE id = $id";

                $result = mysqli_query($dbc, $query)
                        or trigger_error(
                    'Error querying database exercise_user', E_USER_ERROR);
                
                if (mysqli_num_rows($result) == 1):

                $row = mysqli_fetch_assoc($result)
            ?>
            <h1><?= $row['first_name'] ?></h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">last_name</th>
                        <td><?= $row['last_name'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">gender</th>
                        <td><?= $row['gender'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">birthdate</th>
                        <td><?= $row['birthdate'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">weight</th>
                        <td><?= $row['weight'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">image</th>
                        <td><?= $row['image_file'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">user_name</th>
                        <td><?= $row['user_name'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">password</th>
                        <td><?= $row['password_hash'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">access_privileges</th>
                        <td><?= $row['access_privileges'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">date create</th>
                        <td><?= $row['date_created'] ?></td>
                    </tr>
                </tbody>
            </table>
            <form method="POST"
                action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button class="btn btn-danger" type="submit"
                            name="delete_profile_submission">
                            Delete profile
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success"
                            type="submit"
                            name="do_not_delete_profile_submission">
                            Don't Delete
                        </button>
                    </div>
                    <input type="hidden" name="id"
                    value="<?= $id ?>">
                </div>
            </form>
            <?php
                else:
            ?>
            <h3>No profile Details</h3>
            <?php
                endif;
                else: // Unintended page link - No profile to remove, go back to post
                header("Location: index.php");
                exit;
                endif;
            ?>
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