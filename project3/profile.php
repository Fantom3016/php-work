<?php
require_once('pagetitle.php');
$page_title = P_DETAILS_PAGE;
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("Error: User not logged in.");
}
?>
<html>
    <head>
        <title>Profile </title>
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
                    if (isset($_GET['id'])):

                        require_once('dbconnection.php');
                        
                        $id = $_GET['id'];

                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or trigger_error(
                            'Error connecting to MySQL server for ' . DB_NAME, 
                            E_USER_ERROR);

                        $query = "SELECT * FROM exercise_user WHERE id = $id";

                        $result = mysqli_query($dbc, $query)
                                or trigger_error('Error querying database exercise_user',
                                E_USER_ERROR);
                        
                        if (mysqli_num_rows($result) == 1):
                            $row = mysqli_fetch_assoc($result);
                            $profile_image_file_path = $row['image_file'];

                            if (empty($profile_image_file_path)):
                                 $profile_image_file_path =  'var/www/html/projects/project3/images/'
                                  . basename($profile_image_file_path);
                            endif;
                ?>
               <h1><?= $row['user_name'] ?></h1>
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
                            <th scope="row">First Name</th>
                            <td><?= $row['first_name'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name</th>
                            <td><?= $row['last_name'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Gender</th>
                            <td><?= $row['gender'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Birthdate</th>
                            <td><?= $row['birthdate'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Weight</th>
                            <td><?= $row['weight'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date</th>
                            <td><?= $row['date_created'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
               <?php
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error(
                            'Error connecting to MySQL server for DB_NAME.',
                             E_USER_ERROR);

                    $query2 = " SELECT id, exercise_type FROM exercise_log
                                WHERE exercise_id = $id ORDER BY id ";

                    $results = mysqli_query($dbc, $query2)
                    or trigger_error('Error querying database profile', E_USER_ERROR);

                    if ($_SESSION['user_id'] == $row['id']) {

                        if (!isset($_SESSION['exercise_type'])):

                            if (mysqli_num_rows($results) > 0):
                    ?>
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">logs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($log = mysqli_fetch_assoc($results))
                            {
		                    echo "<tr><td><a class='nav-link' href='exercises.php?id="
                                . $log['id'] . "'>" . $log['exercise_type'] . "</a></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
                    <?php
                        else:
                    ?>
                <h3>No logs found</h3>
                    <?php
                        endif;
                    ?>
                <?php
                    endif;
                ?>
                        <p>You can  
                        <a href='editprofile.php?id_to_edit=<?=$row['id']?>'
                            >edit your profile</a> or
                        <a href='removeprofile.php?id_to_delete=<?= $row['id'] ?>'
                            >delete your profile</a>
                    </p>
                    <?php
                    }
                    ?>
                <?php
                    else:
                ?>
                <h3>No profile Details</h3>
                <?php
                    endif;
                    else:
                    ?>
                <h3>Nooooo profile Details</h3>
                <?php
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