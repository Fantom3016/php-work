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
        <title>Card</title>
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

                        $query = "SELECT * FROM full_set WHERE id = $id";

                        $result = mysqli_query($dbc, $query)
                                or trigger_error('Error querying database full_set',
                                E_USER_ERROR);
                        
                        if (mysqli_num_rows($result) == 1):
                            $row = mysqli_fetch_assoc($result);
                            $profile_image_file_path = $row['image_file'];

                            if (empty($profile_image_file_path)):
                                 $profile_image_file_path =  'var/www/html/projects/project3/images/'
                                  . basename($profile_image_file_path);
                            endif;
                ?>
               <h1><?= $row['card_name'] ?></h1>
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
                            <th scope="row">Type</th>
                            <td><?= $row['type'] ?></td>
                        </tr>
                         <tr>
                            <th scope="row">Color</th>
                            <td><?= $row['color'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Mana Cost</th>
                            <td><?= $row['mana_cost'] ?></td>
                        </tr>

                        <tr>
                            <th scope="row">Rarity</th>
                            <td><?= $row['rarity'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Ability</th>
                            <td><?= $row['text'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
               
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