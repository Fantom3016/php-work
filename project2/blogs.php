<html>
    <head>
        <title>Blog Posts</title>
        <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
            integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
            crossorigin="anonymous">
    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <nav class="nav">
                    <a class="nav-link" href="index.php">Blog Posts</a>
                </nav>
                <?php
                    if (isset($_GET['id'])):

                        require_once('dbconnection.php');
                        
                        $id = $_GET['id'];

                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or trigger_error(
                            'Error connecting to MySQL server for ' . DB_NAME, 
                            E_USER_ERROR);

                        $query = "SELECT * FROM blog WHERE id = $id";

                        $result = mysqli_query($dbc, $query)
                                or trigger_error('Error querying database blog',
                                E_USER_ERROR);
                        
                        if (mysqli_num_rows($result) == 1):

                            $row = mysqli_fetch_assoc($result)
                ?>
                <h1><?= $row['title'] ?></h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Post</th>
                            <td><?= $row['post'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date</th>
                            <td><?= $row['date_created'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
                <p>You can edit any of the details of this posts, feel free to <a
                    href='editpost.php?id_to_edit=<?=$row['id']?>'> edit it</a></p>
                <?php
                    else:
                ?>
                <h3>No blog Details</h3>
                <?php
                    endif;
                    else:
                    ?>
                <h3>Nooooo blog Details</h3>
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