<?php

// included classes and connection files

require_once('../classes/userClass.php');
require('../classes/taskClass.php');
require_once('../connection/MysqliDb.php');
require_once('../files/functions/Validation.php');

// connect to database  server
$localHost = 'localhost';
$datausername  = 'root';
$password  = null;
$databasename = 'afaq2327';
$db = new MysqliDb(array(
    'host' => $localHost,
    'username' => $datausername,
    'password' => $password,
    'db' => $databasename,
    'port' => 3306,
    'prefix' => '',
    'charset' => 'utf8'
));
$newUsers = isset($_GET['newUsers']) ? $_GET['newUsers'] : null;
$message = isset($_GET['message']) ? $_GET['message'] : null;


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
    <?php
    if (isset($newUsers)) {
        echo '<div class="alert alert-info alert-dismissible fade show px-4 d-flex justify-content-center flex-column" role="alert">';
        echo "<strong>Message:</strong> " . $newUsers;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if (isset($message)) {
        echo '<div class="alert alert-info alert-dismissible fade show px-4 d-flex justify-content-center flex-column" role="alert">';
        echo "<strong>Message:</strong> " . $message;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else {
    }
    ?>
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">

                <h2 class="text-start">Login Form</h2>
                <form method="post" class="row" enctype="multipart/form-data" action="../files/user-login.php">
                    <div class="col-12 py-2 px-2">
                        <div class="row px-2 py-2">
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Username:</label>
                                    <input type="text" class="form-control" placeholder="Ex, username" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Password:</label>
                                    <input type="password" class="form-control" placeholder="Ex, password" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="btn_login" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Login</button>
                    </div>
                </form>
                <div class="py-2">
                    <a href="../files/user-registration.php" class="text-decoration-none text-black ">Not Account Click Here And Register</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>