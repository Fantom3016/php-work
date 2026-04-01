<?php
    require_once('authorization.php');
?>
<html>
    <head>
        <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
        <title>Edit a Post</title>
    </head>
    <body>
        <div class="card">
                <h1>Edit a Post</h1>
                <nav class="nav">
                    <a class="nav-link" href="index.php">Blog post</a>
                </nav>
                <hr/>
                <?php
                    require_once('dbconnection.php');

                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error(
                    'Error connecting to MySQL server for ' . DB_NAME,
                    E_USER_ERROR
                    );

                    if (isset($_GET['id_to_edit'])) {
                        $id_to_edit = $_GET['id_to_edit'];
                    
                        $query = "SELECT * FROM blog WHERE id = $id_to_edit";
                    
                        $result = mysqli_query($dbc, $query)
                        or trigger_error('Error querying database blog', E_USER_ERROR);


                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_assoc($result);

                            $blog_title = $row['title'];
                            $blog_date = $row['date_created'];
                            $blog_post = $row['post'];
                        }
                    } elseif (isset($_POST['edit_blog_submission'], $_POST['blog_title'],
                             $_POST['blog_post'])) {

                            $blog_title = $_POST['blog_title'];
                            $blog_date = date("Y/m/d");
                            $blog_post = $_POST['blog_post'];
                            $id_to_update = $_POST['id_to_update'];

                            $query = "UPDATE blog SET title = '$blog_title', date_created = '$blog_date', "
                                . "post = '$blog_post' "
                                . "WHERE id = $id_to_update";

                            mysqli_query($dbc, $query)
                                or trigger_error(
                                'Error querying database blog: Failed to update blog listing',
                                E_USER_ERROR
                        );
                        $nav_link = 'blogs.php?id=' . $id_to_update;

                        header("Location: $nav_link");
                        exit;
                    } else // Unintended page link - No blog to edit, link back to index
                    {
                        header("Location: index.php");
                        exit;
                    }
                ?>
                <form class="needs-validation" novalidate method="POST"
                       action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="blog_title"
                                class="col-sm-3 col-form-label-lg">Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                    id="blog_title" name="blog_title"
                                    value='<?= $blog_title ?>'
                                    placeholder="Title" required>
                            <div class="invalid-feedback">
                                Please provide a blog title.
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
                                    value='<?= $blog_post ?>'
                                    placeholder="Blog_post"
                                    required>
                            <div class="invalid-feedback">
                                Please provide a blog post.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"
                            name="edit_blog_submission">Update Post
                    </button>
                    <input type="hidden" name="id_to_update"
                            value="<?= $id_to_edit ?>">
                </form> 
                <script>
                    // JavaScript for disabling form submissions if there are invalid fields
                    (function () {
                        'use strict';
                        window.addEventListener('load', function () {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function (form) {
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