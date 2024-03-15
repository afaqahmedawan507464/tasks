<?php
require('../classes/userClass.php');
require_once('../connection/connection.php');
require_once('../files/functions/Validation.php');

// task  operations perform

// $tasks = new Tasks();
// $taskname = 'demo tasks name';
// $description = 'this is a demo task description';
// $userId = $message;

// call the task creater functions

// $newTasks = $tasks->setTasks($taskname, $description, $db, $userId);
if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $validator = new Validation();


    $usernameValidation = $validator->name('username')->value($username)->pattern('alphanum')->required();
    $emailValidation = $validator->name('password')->value($password)->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->min(8)->max(14)->required();

    if (!$validator->isSuccess()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            $message .= "<p>Error: $error</p><br>";
        }
        header("location:../files/index.php?message=" . urlencode($message));
    } else {
        $login = new User();
        $message = $login->login($username, $password, $db);
        header("location:../files/index.php");
        exit();
    }
}
