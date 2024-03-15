<?php
require_once('../connection/connection.php');
require_once('../files/functions/Validation.php');
require_once('../classes/taskClass.php');

$message = '';

if (isset($_POST['btn_tasks'])) {
    $taskname = $_POST['taskname'] ?? '';
    // $time = $_POST['time'] ?? '';
    $time = date('Y-m-d H:i:s');
    $date = $_POST['date'] ?? '';
    $reminder = $_POST['taskReminder'] ?? '';
    $userId = $_POST['userId'] ?? '';
    $description = $_POST['taskDescription'] ?? '';


    $validator = new Validation();
    $taskNameValidation = $validator->name('taskname')->value($taskname)->required();
    $timeValidation = $validator->name('time')->value($time)->required();
    $dateValidation = $validator->name('date')->value($date)->required();
    $reminderValidation = $validator->name('taskReminder')->value($reminder)->required()->pattern('int');
    $userIdValidation = $validator->name('userId')->value($userId)->required()->pattern('int');
    $descriptionValidation = $validator->name('taskDescription')->value($description)->required();


    if (!$validator->isSuccess()) {
        $errors = $validator->getErrors();
        foreach ($errors as $error) {
            $message .= "<p>Error: $error</p>";
        }
        header("location:../files/task-create.php?message=" . urlencode($message));
        exit();
    } else {

        $tasks = new Tasks();
        $newTasks = $tasks->setTasks($taskname, $description, $db, $userId, $date, $time, $reminder);
        header("location:../files/task-create.php?newTasks=" . urlencode($newTasks));
        exit();
    }
}
