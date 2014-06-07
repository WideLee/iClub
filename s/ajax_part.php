<?php
require_once("../include/dbhome.php");

$aid = $_POST['aid'];

if($_POST['type'] == 'add')
{
    DB::insert('Participate',
               array('uid' => $_SESSION['uid'],
                     'aid' => $aid));
    echo '1';
    return;
}
else
{
    DB::delete('Participate', 'uid=%d AND aid=%d', $_SESSION['uid'],
               $_POST['aid']);
    echo '1';
}

?>