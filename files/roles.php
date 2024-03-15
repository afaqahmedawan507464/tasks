<?php
// included files classes and connection

require_once('../connection/connection.php');
require_once('../classes/rolesClass.php');

// create new roles

$rolename = 'admin';
$newRoles = new Roles();

// call the insert function

$roles = $newRoles->setRoles($rolename, $db);
echo $roles;
echo  '<br>';
// 
$rolename2 = 'superadmin';
$newRoles2 = new Roles();

// call the insert function

$roles2 = $newRoles->setRoles($rolename2, $db);
echo $roles2;
echo  '<br>';
// 
$rolename3 = 'hr';
$newRoles3 = new Roles();

// call the insert function

$roles3 = $newRoles->setRoles($rolename3, $db);
echo $roles3;
echo  '<br>';
