 <?php
    require_once('../connection/connection.php');
    class Roles
    {
        public $roles;
        public $id;
        public function setRoles($roles, $db)
        {
            $this->roles = $roles;
            if ($this->roles == '') {
                return "Role Name  is required";
            } else {
                $insertdata = array(
                    'Name' => $this->roles,
                );
                $newRoles = $db->insert('roles', $insertdata);
                if ($newRoles) {
                    return "success: Roles is created";
                } else {
                    return "error: Roles is not created";
                }
            }
        }

        public function getRoles($db)
        {
            $roleIds = [];
            $tableName = 'roles';
            $numRows = null;
            $columns = ["id", "Name"];
            $results = $db->get($tableName, $numRows, $columns);
            if ($db->count > 0) {
                foreach ($results as $row) {
                    $roleIds[] =
                        ['id' => $row['id'], 'Name' => $row['Name']];
                }
                return $roleIds;
            }
        }
    }
