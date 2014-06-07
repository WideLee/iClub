<?php

require_once("../include/dbhome.php");

$uid = $_POST['uid'];
if($_POST['type'] == 'add')
{
    DB::insert('Concern',
               array('uid_s' => $_SESSION['uid'],
                     'uid_c' => $uid));
    echo '1';
    return;
}
else
{
    DB::delete('Concern', 'uid_s=%d AND uid_c=%s', $_SESSION['uid'],
               $uid);
    echo '1';
}
?>