<?php
    require_once('pagetitle.php');
    $page_title = P_FULLSET_PAGE;
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

                    $query = "SELECT id, card_name, image_file FROM full_set ORDER BY card_number";

                    $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database full_set', E_USER_ERROR);
                    
                   
                        if (isset($_SESSION['user_name'])):

                        if (mysqli_num_rows($result) > 0):
                ?>
                <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Cards in set</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $imagePath = 'images/' . basename($row['image_file']);
                            
                                echo "<tr>";
                                echo "<td class='align-middle'>
                                        <img src='{$imagePath}' 
                                             class='img-thumbnail mr-2' 
                                             style='max-height: 80px;'>
                                        <a href='card.php?id={$row['id']}'>
                                            {$row['card_name']}
                                        </a>
                                          </td>";
                                echo "</tr>";
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
                <h3>Please log in or create an account to view profiles and log</h3>
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
