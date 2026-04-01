<?php
    require_once('authorization.php');
?>
<html>
    <head>
        <title>Add a Post</title>
        <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <h1>Add a Post</h1>
                <nav class="nav">
                    <a class="nav-link" href="index.php">Blog Post</a>
                </nav>
                <hr/>
                <?php
                    $display_add_blog_form = true;

                    if (isset($_POST['add_blog_submission'], $_POST['blog_title'], 
                             $_POST['blog_post']))
                    {
                        require_once('dbconnection.php');

                        $blog_title = $_POST['blog_title'];
                        $blog_date = date("Y/m/d");
                        $blog_post = $_POST['blog_post'];


                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or trigger_error(
                                'Error connecting to MySQL server for' 
                                . DB_NAME, E_USER_ERROR);

                        $query = "INSERT INTO blog (title, date_created, post)"
                                . " VALUES ('$blog_title', '$blog_date', '$blog_post')";

                        mysqli_query($dbc, $query)
                            or trigger_error(
                            'Error querying database blog: Failed to insert blog post',
                            E_USER_ERROR
                        );

                        $display_add_blog_form = false;
                ?>
                <h3 class="text-info">The Following post details were Added:</h3><br/>
                
                <h1><?= $blog_title ?></h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Title</th>
                            <td><?= $blog_title ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date</th>
                            <td><?= $blog_date ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Blog Post</th>
                            <td><?= $blog_post ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr/>
                <p>Would you like to <a href='<?= $_SERVER['PHP_SELF'] ?>'>add another post</a>?</p>
                <?php
                    }
                    if ($display_add_blog_form)
                    {
                ?>
                <form class="needs-validation" novalidate method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="blog_title" 
                                class="col-sm-3 col-form-label-lg">Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" 
                            id="blog_title" 
                            name="blog_title" 
                            placeholder="Title" required>
                            <div class="invalid-feedback">
                                Please provide a valid blog title.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="blog_post"
                        class="col-sm-3 col-form-label-lg">Blog Post</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                    id="blog_post"
                                    name="blog_post"
                                    placeholder="Add blog post"
                                    required>
                            <div class="invalid-feedback">
                                Please provide a blog post.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"
                        name="add_blog_submission">Add post</button>
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
                    } // Display add blog form
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
