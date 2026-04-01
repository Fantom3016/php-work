<html>
        <head>
        <title>Badlibs</title>
        </head>
        <body>
        <?php
            $output_form = false;

            if (isset($_POST['submit']))
            {
                $noun = $_POST['noun'];
                $verb = $_POST['verb'];
                $adverb = $_POST['adverb'];
                $adjective = $_POST['adjective'];
                $story = "I really hate $verb! I always feel $adjective after and it $adverb makes my $noun unhappy!";

                //Validation
                if (empty($noun) && empty($verb) && empty($adverb) && empty($adjective))
                {
                    echo '<p class="text-danger">You forgot to enter anything</P>';
                    $output_form = true;
                }
                else if (empty($noun) && !empty($verb) && !empty($adverb) && !empty($adjective))
                {
                echo '<p class="text-danger">You forgot to enter a noun </P>';
                $output_form = true;
                }
                else if (!empty($noun) && empty($verb) && !empty($adverb) && !empty($adjective))
                {
                echo '<p class="text-danger">You forgot to enter a verb </P>';
                $output_form = true;
                }
                else if (!empty($noun) && !empty($verb) && empty($adverb) && !empty($adjective))
                {
                echo '<p class="text-danger">You forgot to enter an adverb </P>';
                $output_form = true;
                }
                else if (!empty($noun) && !empty($verb) && !empty($adverb) && empty($adjective))
                {
                echo '<p class="text-danger">You forgot to enter an adjective </P>';
                $output_form = true;
                }
                else if (!empty($noun) && !empty($verb) && !empty($adverb) && !empty($adjective))

                {

                    $dbc = mysqli_connect('localhost', 'student', 'student', 'badlibs')
                        or trigger_error('Error connecting to MySQL server.', E_USER_ERROR);
                    // I can not figure out why it's not adding the data into the table
                    // tried a butch of different things, even tried debugging with AI and it didnt work
                    $query = "INSERT INTO badlibs (noun, verb, adverb, adjective, story)"
                         . "VALUES ('$noun', '$verb', '$adverb', '$adjective', '$story')";

                    $insert_result = mysqli_query($dbc, $query)
                    or trigger_error('Error query database.', E_USER_WARNING);

                    if (!$insert_result)
                    {
                    echo("Query Error description: " . mysqli_error($dbc));
                    }

                    $select_query = "SELECT story FROM badlibs";
                    $result = mysqli_query($dbc, $select_query);

                    if (!$result)
                    {
                    echo("Select Query Error: " . mysqli_error($dbc));
                    }


                    mysqli_close($dbc);

                }
            }
            else 
            {
                $output_form = true;
                $noun = "";
                $verb = "";
                $adverb = "";
                $adjective = "";
            }
           ?>       
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <label for="noun">Noun</label>
                <br/>
                <input class="form-control" id="noun" name="noun"
                    value="<?= $noun ?>" placeholder="Enter plural noun">
            </div>
            <br/>
            <div class="form-group">
                <label for="verb">Verb</label>
                <br/>
                <input class="form-control" id="verb" name="verb"
                value="<?= $verb ?>" placeholder="Enter a verb">
            </div>
            <br/>
            <div class="form-group">
                <label for="adverb">Adverb</label>
                <br/>
                <input class="form-control" id="adverb" name="adverb"
                value="<?= $adverb ?>" placeholder="Enter an adverb">
            </div>
            <br/>
            <div class="form-group">
                <label for="adjective">Adjective</label>
                <br/>
                <input class="form-control" id="adjective" name="adjective"
                value="<?= $adjective ?>" placeholder="Enter an adjective">
            </div>
            <br/>
            <button type="submit" class="btn btn-primary" name="submit">Create Badlib</button>
        </form> 
        <hr/>
        <?php

            // testing to make sure the form work
            
            if (isset($result)) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                echo "<p>" . ($row['story']) . "</p>";
                }
            }
        ?>
    </body>
</html>