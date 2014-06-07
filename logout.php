<?php

require_once('include/dbhome.php');


session_destroy();

$url = "/login.php";

header("Location: $url");
?>