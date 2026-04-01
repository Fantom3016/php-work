<?php
require_once('pagetitle.php');
$page_title = P_REMOVE_COLLECTION_PAGE;
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("Error: User not logged in.");
}
?>
<html>
<head>
    <title>Remove a card</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
          crossorigin="anonymous">
</head>
<body>
<div class="card">
    <div class="card-body">
        <h1>Remove a card</h1>
        <?php
        require_once('dbconnection.php');

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error('Error connecting to MySQL server.', E_USER_ERROR);

        if (isset($_POST['delete_card_submission']) && isset($_POST['id'])):
            $id = $_POST['id'];

            $query = "DELETE FROM collection WHERE id = $id";
            $result = mysqli_query($dbc, $query)
                or trigger_error('Error querying database collection', E_USER_ERROR);

            header("Location: index.php");
            exit;

        elseif (isset($_POST['do_not_delete_card_submission'])):
            header("Location: index.php");
            exit;

        elseif (isset($_GET['id_to_delete'])):
            ?>
            <h3 class="text-danger">Confirm Deletion of the Following
                card Details:</h3><br/>
            <?php
            $id = $_GET['id_to_delete'];

            // Ensure the query is executed and valid
            $query = "SELECT * FROM collection WHERE id = $id";
            $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database collection', E_USER_ERROR);

            if ($result && mysqli_num_rows($result) == 1):  // Check for valid result
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $profile_image_file_path = $row['image_file'];

                    if (empty($profile_image_file_path)) {
                        $profile_image_file_path = 'var/www/html/projects/project3/images/'
                            . basename($profile_image_file_path);
                    }

                    // Display the card details
                    ?>
                    <h1><?= htmlspecialchars($row['card_name']) ?></h1>
                    <div class="row">
                        <div class="col-2">
                            <img src="images/<?= htmlspecialchars(basename($profile_image_file_path)) ?>" 
                                 class="img-thumbnail"
                                 style="max-height: 200px;" alt="profile image">
                        </div>
                        <div class="col">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th scope="row">Type</th>
                                    <td><?= htmlspecialchars($row['type']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Color</th>
                                    <td><?= htmlspecialchars($row['color']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Mana Cost</th>
                                    <td><?= htmlspecialchars($row['mana_cost']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Rarity</th>
                                    <td><?= htmlspecialchars($row['rarity']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ability</th>
                                    <td><?= htmlspecialchars($row['text']) ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <button class="btn btn-danger" type="submit" name="delete_card_submission">
                                            Delete card
                                        </button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-success" type="submit" name="do_not_delete_card_submission">
                                            Don't Delete
                                        </button>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                </div>
                            </form>
                    </div>
                    <?php
                } else {
                    echo '<h3>No card details found</h3>';
                }
            else:
                echo '<h3>Card not found in the database.</h3>';
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
