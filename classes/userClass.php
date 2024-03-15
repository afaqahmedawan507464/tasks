<?php
require_once('../connection/connection.php');
require_once('../files/functions/Validation.php');
class User
{
    public $id;
    public $username;
    public $password;
    public $emailaddress;
    public $db;
    public $role_id;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmailaddress($emailaadress)
    {
        $this->emailaddress = $emailaadress;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setConnection($db)
    {
        $this->db = $db;
    }

    public function set($username, $password, $emailaddress, $role_id, $db)
    {
        $this->username = $username;
        $this->password = $password;
        $this->emailaddress = $emailaddress;
        $this->role_id = $role_id;
        // apply validation using validation files
        // 
        if ($this->username === '') {
            return "Username field must be filled.";
        } elseif ($this->password === '') {
            return "Password field must be filled.";
        } elseif ($this->emailaddress === '') {
            return "Email address field must be filled.";
        } elseif ($this->role_id === '') {
            return "Role Not Founded.";
        } else {
            if (!$db->tableExists('users')) {
                return "The 'users' table does not exist.";
            }
            $existingRole = $db->get('roles', null, ['id'], [
                ['id', '=', $this->role_id]
            ]);

            if (empty($existingRole)) {
                return "Role ID does not exist.";
            }
            $existingUser = $db->get('users', null, ['userName', 'emailAddress'], [
                ['userName', '=', $this->username],
                'OR',
                ['emailAddress', '=', $this->emailaddress]
            ]);

            if (!empty($existingUser)) {
                foreach ($existingUser as $row) {
                    if ($row['userName'] === $this->username) {
                        return "Username is already available, please try another username.";
                    } elseif ($row['emailAddress'] === $this->emailaddress) {
                        return "Email address is already available, please try another email address.";
                    }
                }
            }

            $insertData = array(
                'userName' => $this->username,
                'emailAddress' => $this->emailaddress,
                'password' => $this->password,
                'roleId' => $this->role_id,
            );

            $newEntry = $db->insert('users', $insertData);
            if ($newEntry) {
                return "User created successfully.";
            } else {
                return "Failed to create user.";
            }
        }
    }



    public function login($username, $password, $db)
    {
        $this->username = $username;
        $this->password = $password;
        if ($this->username === '') {
            return "Username field must be filled";
        } else if ($this->password === '') {
            return "password field must be filled";
        } else {
        $tableName = 'users';
        $numRows = null;
        $columns = ["id", "userName", "emailAddress", "password"];
        $results = $db->get($tableName, $numRows, $columns);
        foreach ($results as $row) {
            if ($row['userName'] === $this->username) {
                $fetchPassword = $row['password'];

                if (password_verify($this->password, $fetchPassword)) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['userName'];
                    header("location:../files/dashboard.php");
                    exit();
                } else {
                    return "Invalid Password";
                }
            }
        }
        return "Invalid Username";
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmailaddress()
    {
        return $this->emailaddress;
    }
}
