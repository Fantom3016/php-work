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
                    if (isset($_GET['id'])):

                        require_once('dbconnection.php');
                        
                        $id = $_GET['id'];

                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or trigger_error(
                            'Error connecting to MySQL server for ' . DB_NAME, 
                            E_USER_ERROR);

                        $query = "SELECT * FROM player WHERE id = $id";

                        $result = mysqli_query($dbc, $query)
                                or trigger_error('Error querying database player',
                                E_USER_ERROR);
                        
                       
                        if (mysqli_num_rows($result) == 1):
                            $row = mysqli_fetch_assoc($result);
                            $profile_image_file_path = $row['image_file'];

                            if (empty($profile_image_file_path)):
                                 $profile_image_file_path =  'var/www/html/projects/project3/images/'
                                  . basename($profile_image_file_path);
                            endif;
                ?>
               <h1><?= $row['first_name'] ?> <?= $row['last_name'] ?></h1>
               <div class="row">
                    <div class="col-2">
                        <img src="images/<?= basename($profile_image_file_path) ?>" 
                             class="img-thumbnail"
                             style="max-height: 200px;" alt="profile image">
                    </div>
                    <div class="col">
               <?php
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error(
                            'Error connecting to MySQL server for DB_NAME.',
                             E_USER_ERROR);

                    $query2 = "SELECT id, card_name, card_number FROM collection
                                WHERE player_id = $id ORDER BY id";


                    $results = mysqli_query($dbc, $query2)
                    or trigger_error('Error querying database profile', E_USER_ERROR);

                    if ($_SESSION['user_id'] != $row['id']) {
                        ?>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cards</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($cards = mysqli_fetch_assoc($results)) 
                                    {
                                        echo "<tr><td><a class='nav-link'"
                                             . "href='card.php?id=" 
                                             . $cards['card_number'] . "'>"
                                             . $cards['card_name'] . "</a></td></tr>";
                                    }
                                    echo "<h2>Sorry you don't have access to change "
                                         . "other players collections.</h2>";
                                ?>
                         </tbody>
                        </table>
                        <?php
                    }
                    elseif ($_SESSION['user_id'] == $row['id']) {

                        if (!isset($_SESSION['card_name'])):

                            if (mysqli_num_rows($results) > 0):

                                $query3 = "SELECT COUNT(DISTINCT card_name)
                                        AS collection_count FROM collection
                                        WHERE player_id = $id"; 

                                $results2 = mysqli_query($dbc, $query3)
                                         or trigger_error(
                                            'Error querying collection data', E_USER_ERROR); 

                                $collection_data = mysqli_fetch_assoc($results2); 
                                $collection_count = $collection_data['collection_count']; 

                                $query4 = "SELECT COUNT(DISTINCT card_name) 
                                            AS full_set_count FROM full_set"; 

                                $results3 = mysqli_query($dbc, $query4)
                                         or trigger_error(
                                            'Error querying full set data', E_USER_ERROR); 

                                $full_set_data = mysqli_fetch_assoc($results3); 
                                $full_set_count = $full_set_data['full_set_count']; 

                                if ($full_set_count > 0) { 
                                     $percentage = ($collection_count / $full_set_count) * 100; 
                                } else { 
                                    $percentage = 0; 
                                }

                                echo "<h2>You own $collection_count of "
                                     . "$full_set_count cards in total, which is "
                                     . round($percentage, 2) . "% of the full set.</h2>";
                    ?> 
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Cards in your collection</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($cards = mysqli_fetch_assoc($results)) 
                            {
                                 echo "<tr><td><a class='nav-link' href='card.php?id=" 
                                     . $cards['card_number'] . "'>" 
                                     . $cards['card_name'] . "</a></td>"
                                     . "<td><a class='nav-link'"
                                     . "href='removecard.php?id_to_delete=" 
                                     . $cards['id'] . "'>"
                                     . "<i class='fas fa-trash-alt'></i></a></td></tr>";
                            }
                        ?>

                    </tbody>
                </table>
                    <?php
                        else:
                    ?>
                <h3>No cards found in your collection</h3>
                    <?php
                        endif;
                    ?>
                <?php
                    endif;
                ?>
                <form action="editprofile.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_to_edit" value="<?= $row['id'] ?>">
                        <button type="submit" 
                                class="btn btn-primary">Edit Your Profile</button>
                </form> 
                <form action="removeprofile.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_to_delete" value="<?= $row['id'] ?>">
                    <button type="submit" 
                            class="btn btn-danger">Delete Your Profile</button>
                </form>
                <form action="addcollection.php" method="get" style="display: inline;">
                    <button type="submit" class="btn btn-primary">Add Card</button>
                </form> 
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