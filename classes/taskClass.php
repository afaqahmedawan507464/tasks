<?php
require_once('../connection/connection.php');
class Tasks
{
    public $taskname;
    public $description;
    public $db;
    public $userId;
    public $date;
    public $time;
    public $reminder;
    public function setTasks($taskname, $description, $db, $userId, $date, $time, $reminder)
    {
        $this->taskname =  $taskname;
        $this->description = $description;
        $this->db = $db;
        $this->userId = $userId;
        $this->date = $date;
        $this->time = $time;
        $this->reminder = $reminder;

        if (empty($this->taskname)) {
            return "Task name field is required";
        } elseif (empty($this->description)) {
            return "Task description field is required";
        } elseif (empty($this->date)) {
            return "Task date field is required";
        } elseif (empty($this->time)) {
            return "Task time field is required";
        } elseif (empty($this->reminder)) {
            return "Task reminder field is required";
        } elseif (empty($this->userId)) {
            return "User not found";
        } else {
            $tablename = 'tasks';
            $insertData = array(
                'Name'           => $this->taskname,
                'Description'    => $this->description,
                'Date'           => $this->date,
                'Time'           => $this->time,
                'Reminder'       => $this->reminder,
                'userId'         => $this->userId,
            );
            $newtasks = $db->insert($tablename, $insertData);
            if ($newtasks) {
                return "Success: Task Created";
            } else {
                return "Task not created";
            }
        }
    }
    // 
    public function getTasks($db)
    {
        $tasks = [];
        $tableName = 'tasks';
        $numRows = null;
        $columns = ["id", "Name", "Description", "Date", "Time", "Reminder", "userId"];
        // Define the condition to fetch tasks for a specific user
        // Fetch tasks from the database based on the condition
        $results = $db->get($tableName, $numRows, $columns);
        if ($db->count > 0) {
            foreach ($results as $row) {
                $tasks[] = [
                    'id'          => $row['id'],
                    'Name'        => $row['Name'],
                    'Description' => $row['Description'],
                    'Date'        => $row['Date'],
                    'Time'        => $row['Time'],
                    'Reminder'    => $row['Reminder'],
                    'userId'      => $row['userId'],
                ];
            }
            return $tasks;
        }
    }
}
