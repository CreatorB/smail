<?php
include "../inc/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pass = $_POST['password'];

    validatePasswordWithCpanel($pass);
}