<?php
require_once('../connection/MysqliDb.php');

// create database connection

$localHost = 'localhost';
$datausername  = 'root';
$password  = null;
$databasename = 'afaq2327';
$db = new MysqliDb(array(
    'host' => $localHost,
    'username' => $datausername,
    'password' => $password,
    'db' => $databasename,
    'port' => 3306,
    'prefix' => '',
    'charset' => 'utf8'
));
