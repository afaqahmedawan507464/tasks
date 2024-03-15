<?php
require_once('../connection/connection.php');
require_once('../classes/taskClass.php');
session_start();
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
} else {
}
?>

<body>
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end align-item-center py-2">
                        <a href="../files/task-create.php" class="btn btn-outline-primary py-2"><i class="fas fa-plus me-2"></i>Add</a>
                    </div>
                </div>
                <?php
                $tasks = "";
                $userId = "";
                if (isset($_SESSION['id'])) {
                    $userId = $_SESSION['id'];
                } else {
                    echo '0';
                }
                $tasksData = new Tasks();
                $allTasks = $tasksData->getTasks($db, $userId);
                if (isset($allTasks)) {
                    $tasks = array_filter($allTasks, function ($task) use ($userId) {
                        return $task['userId'] == $userId;
                    });

                    if (!empty($tasks)) {
                ?>
                        <table class="table table-responsive flex-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col" style="width:5%;">id</th>
                                    <th class="text-center" scope="col" style="width:20%;">Task Name</th>
                                    <th class="text-center" scope="col" style="width:35%;">Description</th>
                                    <th class="text-center" scope="col" style="width:10%;">Date</th>
                                    <th class="text-center" scope="col" style="width:10%;">Time</th>
                                    <th class="text-center" scope="col" style="width:20%;">Reminder</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tasks as $task) : ?>
                                    <tr>
                                        <td class="text-center" scope="row" style="width:5%;">
                                            <?php echo $task['id'] ?>
                                        </td>
                                        <td class="text-center" scope="row" style="width:20%;">
                                            <?php echo $task['Name'] ?>
                                        </td>
                                        <td class="text-center" scope="row" style="width:35%;">
                                            <?php echo $task['Description'] ?>
                                        </td>
                                        <td class="text-center" scope="row" style="width:10%;">
                                            <?php echo date('M d, Y', strtotime($task['Date'])); ?>
                                        </td>
                                        <td class="text-center" scope="row" style="width:10%;">
                                            <?php
                                            $timestamp = strtotime($task['Time']);
                                            $formattedTime = date('h:i A', $timestamp);
                                            echo $formattedTime;
                                            ?>
                                        </td>
                                        <td class="text-center" scope="row" style="width:20%;">
                                            <?php echo $task['Reminder'] == 1 ? "Yes" : "No"; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="text-center text-danger">No tasks found.</p>
                    <?php }
                } else { ?>
                    <p class="text-center text-danger">No tasks found.</p>
                <?php } ?>
                </table>
                <div class="py-2">
                    <a href="../files/logout.php" class="btn btn-outline-primary py-2"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>