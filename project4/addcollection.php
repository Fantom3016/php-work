<?php
    require_once('pagetitle.php');
    $page_title = P_ADD_COLLECTION_PAGE;
    session_start();
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        die("Error: User not logged in.");
    }
?>
<!DOCTYPE html>
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
            require_once('dbconnection.php');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to database');

            $message = "";

            if (isset($_POST['add_card'], $_POST['full_set_id'])) {

                $player_id   = $_SESSION['user_id'];
                $full_set_id = $_POST['full_set_id'];

                $query = "SELECT * FROM full_set WHERE id = $full_set_id";

                $result = mysqli_query($dbc, $query);

                if (mysqli_num_rows($result) === 1) {
                
                    $card = mysqli_fetch_assoc($result);
                
                    // Insert card into collection
                    $insert = "INSERT INTO collection (player_id, full_set_id,"
                               . " card_name, card_number, mana_cost, `type`, rarity,"
                               . " color, `text`, image_file) VALUES ($player_id,"
                               . " $full_set_id, '{$card['card_name']}',"
                               . " '{$card['card_number']}', '{$card['mana_cost']}',"
                               . " '{$card['type']}', '{$card['rarity']}',"
                               . " '{$card['color']}', '{$card['text']}',"
                               . " '{$card['image_file']}')";

                    mysqli_query($dbc, $insert)
                        or die('Error inserting into collection');
                
                        //Stopped here
                        $nav_link = 'profile.php?id=' . $player_id;

                        header("Location: $nav_link");
                        exit;
                }
            }
        ?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Add Card to Collection</h3>
                </div>
                <div class="card-body">

                    <?= $message ?>

                    <form method="POST" class="needs-validation" novalidate>

                        <div class="form-group">
                            <label for="full_set_id">Select Card</label>
                            <select name="full_set_id" id="full_set_id"
                                    class="form-control" required>

                                <option value="">-- Choose a Card --</option>

                                <?php
                                $query = "SELECT id, card_name FROM full_set 
                                         ORDER BY card_name";
                                $result = mysqli_query($dbc, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>"
                                         . "{$row['card_name']}</option>";
                                }
                                ?>

                            </select>
                            <div class="invalid-feedback">
                                Please select a card.
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <button class="btn btn-success" 
                                        type="submit" 
                                        name="add_card">
                                        Add to Collection
                                </button>
                            </div>
                        </div>
                    </form>       
                </div>
            </div>
        </div>
        <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.forEach.call(forms, function (form) {
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
    </body>
</html>
