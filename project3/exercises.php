<?php
    require_once('pagetitle.php');
    $page_title = P_EXERCISES_PAGE;
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
            <div class="card-body">
                <?php
                    if (isset($_GET['id'])):

                        require_once('dbconnection.php');
                        
                        $id = $_GET['id'];

                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or trigger_error(
                            'Error connecting to MySQL server for ' . DB_NAME, 
                            E_USER_ERROR);

                        $query = "SELECT * FROM exercise_log WHERE id = $id";

                        $result = mysqli_query($dbc, $query)
                                or trigger_error('Error querying database exercise_log',
                                E_USER_ERROR);
                        
                        if (mysqli_num_rows($result) == 1):

                            $row = mysqli_fetch_assoc($result)
                ?>
               <h1><?= $row['date'] ?></h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                        <th scope="row">Exercise Type</th>
                        <td><?= $row['exercise_type'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Timed Workedout</th>
                        <td><?= $row['time_in_minutes'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Heartrate</th>
                        <td><?= $row['heartrate'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Calories Burned</th>
                        <td><?= $row['calories'] ?></td>
                    </tr>
                    </tbody> 
                </table>
                <hr/>
                    <p>You can  
                        <a href='editexercise.php?id_to_edit=<?= $row['id'] ?>'>edit your log</a>
                        or
                        <a href='removeexercise.php?id_to_delete=<?= $row['id'] ?>'>delete your log</a>
                    </p>
                <?php
                    else:
                ?>
                <h3>No log Details</h3>
                <?php
                    endif;
                    else:
                    ?>
                <h3>Nooooo log Details</h3>
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