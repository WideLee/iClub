<?php
require_once('../include/dbhome.php');

if($_POST)
{
	$user = DB::queryFirstRow("SELECT * FROM Users WHERE login_id=%s", $_POST['login_id']);
    if(isset($user['uid']))
    {
        $msg = '该用户已经存在！';
        render_t('c/register_failed.html');
    }
    DB::insert('Users',
               array(
                     'username' => $_POST['username'],
                     'password' => $_POST['password'],
                     'login_id' => $_POST['login_id']));
    $uid = DB::insertId();
    DB::insert('Clubs',
               array(
                     'uid' => $uid,
                     'contact' => $_POST['contact']));
    render_t('c/register_success.html');
}
else
{
    render_t('c/register.html');
}

?>
