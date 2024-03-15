<?php
require_once('../connection/connection.php');
session_start();
$newTasks = isset($_GET['newTasks']) ? $_GET['newTasks'] : null;
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
    if (isset($newTasks)) {
        echo '<div class="alert alert-info alert-dismissible fade show px-4 d-flex justify-content-center flex-column" role="alert">';
        echo "<strong>Message:</strong> " . $newTasks;
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
            <div class="card-header">
                <div class="row">
                    <div class="col-12 d-flex justify-content-start align-item-center py-2">
                        <a href="../files/dashboard.php" class="btn btn-outline-primary"><i class="fas fa-angle-left me-2"></i>Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <h2 class="text-start">task creation forms</h2>
                <form method="post" class="row" enctype="multipart/form-data" action="../files/task-creator-page.php">
                    <div class="col-12 py-2 px-2">
                        <div class="row px-2 py-2">
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Task Name:</label>
                                    <input type="text" class="form-control" placeholder="Ex, taskname" name="taskname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Date:</label>
                                    <input type="date" class="form-control" placeholder="Ex, taskname" name="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Reminder:</label>
                                    <select name="taskReminder" id="taskReminder" class="form-control">
                                        <option value="">Select Reminder</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-none">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Reminder:</label>
                                    <input type="text" class="form-control" placeholder="Ex, taskname" name="userId" value="<?php
                                                                                                                            if (isset($_SESSION['id'])) {
                                                                                                                                echo $_SESSION['id'];
                                                                                                                            } else {
                                                                                                                                echo '0';
                                                                                                                            }
                                                                                                                            ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column justify-content-center align-items-start py-2">
                                    <label class="py-1" for="">Description:</label>
                                    <textarea name="taskDescription" id="taskDescription" class="form-control" cols="30" rows="5" placeholder="Ex, task description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="btn_tasks" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>