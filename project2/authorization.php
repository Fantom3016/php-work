<html>
    <head>
    </head>
    <body>
        <?php
        $username = 'Blogger';
        $password = 'blogger1234';
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
            || $_SERVER['PHP_AUTH_USER'] !== $username
            || $_SERVER['PHP_AUTH_PW'] !== $password) {
            
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Movies I Like"');
            $invalid_response = "<h2>Movies I Like</h2><h4>You must enter a "
            . "valid username and password to access this page.</h4>";
            exit($invalid_response);
        }
        ?>
    </body>
</html>
