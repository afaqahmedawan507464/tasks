<?php

// internal files included

require('../classes/userClass.php');
require('../classes/rolesClass.php');
require_once('../connection/connection.php');
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

<body>
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <h2 class="text-start">Registration Form</h2>
                <form action="../files/registration-user.php" method="post" class="row" enctype="multipart/form-data">
                    <div class="col-12 py-2 px-2">
                        <div class="row px-2 py-2">
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Username:</label>
                                    <input type="text" class="form-control" placeholder="Ex, username" name="username">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Emailaddress:</label>
                                    <input type="text" class="form-control" placeholder="Ex, abc@gmail.com" name="emailaddress">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Password:</label>
                                    <input type="password" class="form-control" placeholder="Ex, password" name="password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2 flex-wrap ">
                                    <label class="py-1" for="">Roles:</label>
                                    <?php
                                    $roles = "";
                                    $roles = new Roles();
                                    $roleIds = $roles->getRoles($db);
                                    ?>
                                    <div class="d-flex justify-content-center align-items-start py-2 flex-wrap">
                                        <?php foreach ($roleIds as $role) : ?>
                                            <div class="d-flex justify-content-center align-items-center py-2 px-2">
                                                <?php if ($role !== null && isset($role['id']) && isset($role['Name'])) : ?>
                                                    <label class="mx-2" for="role_<?php echo $role['id']; ?>" class="checktoggle"><?php echo $role['Name']; ?></label>
                                                    <input type="checkbox" class="check" name="roles[]" value="<?php echo $role['id']; ?>">
                                                <?php else : ?>

                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="btn_registration" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Register</button>
                    </div>
                </form>
                <div class="py-2">
                    <a href="../files/index.php" class="text-decoration-none text-black ">Already Account Click Here And Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>