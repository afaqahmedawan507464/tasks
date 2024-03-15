<?php
require('../classes/userClass.php');
require('../classes/rolesClass.php');
require_once('../connection/connection.php');
require_once('../files/functions/Validation.php');
if (isset($_POST['btn_registration'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // convert normal password to hashed password
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $emailaddress = $_POST['emailaddress'];
    $roles = $_POST['roles'];
    // convert roles id from string to array
    $rolesArray = json_encode($roles);
    $validator = new Validation();
    $usernameValidation = $validator->name('username')->value($username)->pattern('alphanum')->required();
    $emailValidation = $validator->name('emailaddress')->value($emailaddress)->required();
    $passwordValidation = $validator
        ->name('password')
        ->value($hashPassword)
        ->required();
    $rolesValidation = $validator->name('roles')->value($roles)->required();
    if (!$validator->isSuccess()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            $message .= "<p>Error: $error</p> \n";
        }
        header("location:../files/user-registration.php?message=" . urlencode($message));
    } else {
        // create new users
        $registration = new User();
        $newUsers = $registration->set($username, $hashPassword, $emailaddress, $rolesArray, $db);
        // return message
        header("location:../files/user-registration.php?newUsers=" . urlencode($newUsers));
        exit();
    }
}
