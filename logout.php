<?php
session_start();
unset($_SESSION["account_id"]);
unset($_SESSION["account_name"]);
unset($_SESSION["account_email"]);
unset($_SESSION["account_wa"]);
unset($_SESSION["account_role"]);
unset($_SESSION["account_confirmed"]);

session_unset();
session_destroy();
header("location: src/signin");