<?php

require_once('../include/dbhome.php');

if($_POST)
{
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
    render_t('success.html', array('msg' => '注册成功！'));
}
else
{
    render_t('c/register.html');
}

?>
