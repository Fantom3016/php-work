<?php
    require_once('pagetitle.php');
    $page_title = P_ADD_EXERCISE_PAGE;
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
        ?>
        <div class="card">
            <div class="card-body">
                <h1>Log an Exercise</h1>
                <hr/>
                <?php
                    // Initialization
                    $display_add_exercise_form = true;
                    $exercise_type = "";
                    $date = "";
                    $time_in_minutes = "";
                    $heartrate = "";
                    $calories = 0;
    
                    if (isset($_POST['add_exercise_submission'], 
                            $_POST['exercise_type'], $_POST['date'], 
                        $_POST['time_in_minutes'], $_POST['heartrate']))
                    {
                        require_once('dbconnection.php');

                        $exercise_type = $_POST['exercise_type'];
                        $date = $_POST['date'];
                        $time_in_minutes = $_POST['time_in_minutes'];
                        $heartrate = $_POST['heartrate'];
                    
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                                or trigger_error(
                                    'Error connecting to MySQL server for' . DB_NAME,
                                E_USER_ERROR
                                );

                        $user_id = $_SESSION['user_id'];

                        $query = "SELECT first_name, last_name, gender, birthdate,
                                weight FROM exercise_user WHERE id = '$user_id'";

                        $result_user = mysqli_query($dbc, $query)
                            or trigger_error(
                                'Error querying exercise_user', E_USER_ERROR);

                        $user = mysqli_fetch_assoc($result_user);

                        $gender = ($user['gender']);
                        $weight = ($user['weight']);
                        $birthdate = $user['birthdate'];
                        //use chat w3school to figure out how to determine the difference
                        $birthdate_dt = new DateTime($birthdate);
                        $today = new DateTime();
                        $age = $today->diff($birthdate_dt)->y;

                        $HR = $heartrate;
                        $W  = $weight;
                        $A  = $age;
                        $T  = $time_in_minutes;

                        if ($gender == "Male") {
                            $calories = ((-55.0969 + (0.6309 * $HR) + (0.090174 * $W)
                             + (0.2017 * $A)) / 4.184) * $T;
                        }
                        else if ($gender == "Female") {
                            $calories = ((-20.4022 + (0.4472 * $HR) - (0.057288 * $W)
                             + (0.074 * $A)) / 4.184) * $T;
                        }
                        else { // Non Binary
                            $calories = ((-37.7495 + (0.5391 * $HR) + (0.01644 * $W)
                             + (0.1379 * $A)) / 4.184) * $T;
                        }
                    
                        $query2 = "INSERT INTO exercise_log (exercise_id, date,"
                                . "exercise_type, time_in_minutes, heartrate, calories) "
                                . "VALUES ('$user_id','$date', '$exercise_type', "
                                . " '$time_in_minutes', '$heartrate', '$calories')";
                                
                        mysqli_query($dbc, $query2)
                        or trigger_error(
                            'Error querying database exercise_log:
                             Failed to insert exercise log',
                            E_USER_ERROR
                        );
                        
                        $display_add_exercise_form = false;
                ?>
                <h3 class="text-info">The Following Details were Added:</h3><br/>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Date logged</th>
                                    <td><?= $date ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Exercise Type</th>
                                    <td><?= $exercise_type ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Minutes Workedout</th>
                                    <td><?= $time_in_minutes ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Heart Rate</th>
                                    <td><?= $heartrate ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Calories Burned</th>
                                    <td><?= $calories ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr/>
                <p>Would you like to <a href='<?= $_SERVER['PHP_SELF']; ?>'> 
                    log another exercise</a>?</p>
                <?php
                    }
                    if ($display_add_exercise_form)
                    {
                ?>
                <form enctype="multipart/form-data" class="needs-validation" novalidate
                    method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="exercise_type" 
                               class="col-sm-3 col-form-label-lg">Exercise Type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" id="exercise_type"
                                name="exercise_type" 
                                value="<?= $exercise_type ?>" required>
                                <option value="" disabled selected>Exercise Type</option>
                                <option value="Running" 
                                <?= $exercise_type == 'Running' ? 'selected' : '' ?>
                                >Running</option>
                                <option value="Walking" 
                                <?= $exercise_type == 'Walking' ? 'selected' : '' ?>
                                >Walking</option>
                                <option value="Swimming" 
                                <?= $exercise_type == 'Swimming' ? 'selected' : '' ?>
                                >Swimming</option>
                                <option value="Weightlifting" 
                                <?= $exercise_type == 'Weightlifting' ? 'selected' : '' ?>
                                >Weightlifting</option>
                                <option value="Yoga" 
                                <?= $exercise_type == 'Yoga' ? 'selected' : '' ?>
                                >Yoga</option>
                                <option value="Sport" 
                                <?= $exercise_type == 'Sport' ? 'selected' : '' ?>
                                >Sport</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select an Exercise Type.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date"
                        class="col-sm-3 col-form-label-lg">Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="date"
                                   name="date" value="<?= $date ?>"
                                   placeholder="Date" required>
                            <div class="invalid-feedback">
                                Please provide a valid Exercise date.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="time_in_minutes"
                        class="col-sm-3 col-form-label-lg">Exercise Time</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="time_in_minutes"
                                   name="time_in_minutes" value="<?= $time_in_minutes ?>"
                                   placeholder="Exercise time (in minutes)" required>
                            <div class="invalid-feedback">
                                Please provide a valid Exercise time.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="heartrate"
                        class="col-sm-3 col-form-label-lg">Heart Rate</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="heartrate"
                                   name="heartrate" value="<?= $heartrate ?>"
                                   placeholder="Heart Rate" required>
                            <div class="invalid-feedback">
                                Please provide a valid Heart Rate.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"
                    name="add_exercise_submission">LOG EXERCISE</button>
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