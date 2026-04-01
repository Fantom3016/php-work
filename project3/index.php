<?php
    require_once('pagetitle.php');
$page_title = P_INDEX_PAGE;
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $page_title ?></title>
       <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
            integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
            crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
            integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
            crossorigin="anonymous">
    </head>
    <body>
        <?php
            require_once('navmenu.php');
        ?>
        <div class="card">
            <div class="card-body">
                <?php
                    require_once('dbconnection.php');

                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error(
                        'Error connecting to MySQL server for DB_NAME.',
                         E_USER_ERROR);

                    $query = "SELECT id, user_name FROM exercise_user ORDER BY user_name";

                    $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database profile', E_USER_ERROR);
                    
                    if (isset($_SESSION['user_name'])):

                        if (mysqli_num_rows($result) > 0):
                ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Profiles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_SESSION['user_access_privileges'])
                                && $_SESSION['user_access_privileges'] == 'admin') {

                                while($row = mysqli_fetch_assoc($result))
                                {
		                        echo "<tr><td><a class='nav-link' href='profile.php?id="
		                             . $row['id'] . "'>" . $row['user_name'] ."</a></td>"
		                             . "<td><a class='nav-link'"
                                     . "href='removeprofile.php?id_to_delete="
		                             . $row['id'] ."'>"
                                     . "<i class='fas fa-trash-alt'></i></a></td></tr>";
                                }
                            }
                            else
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
		                        echo "<tr><td><a class='nav-link' href='profile.php?id="
		                             . $row['id'] . "'>" . $row['user_name']
                                     ."</a></td></tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                    <?php
                        else:
                    ?>
                <h3>No profiles found</h3>
                    <?php
                        endif;
                    ?>
                <?php
                    elseif (!isset($_SESSION['user_name'])):?>
                <h3>Please log in or create an account to view profiles and log exercises</h3>
                <?php
                    endif;
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
