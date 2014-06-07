<?php

require_once("include/dbhome.php");


function pick_ifex($dest, $src, $what)
{
    if(!empty($src[$what]))
        $dest[$what] = $src[$what];
}

if(!isset($_SESSION['uid']))
{
    finish_redirect("/login.php");
    return;
}
if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if(isset($_SESSION['msg'])) {
        $omsg = $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    else $omsg = '';
    
    if($_SESSION['ut']=='c')
    {
        $me = DB::queryFirstRow("SELECT * FROM Clubs AS C ".
                                "JOIN Users AS U ON U.uid=C.uid ".
                                "WHERE C.uid=%d", $_SESSION['uid']);
        $me['type'] = 'c';
    }
    else
    {
        $me = DB::queryFirstRow("SELECT * FROM Students AS C ".
                                "JOIN Users AS U ON U.uid=C.uid ".
                                "WHERE C.uid=%d", $_SESSION['uid']);
        $me['type'] = 's';
    }
    render_t('setting.html', array('me' => $me, 'msg'=> $omsg));
}
else
{
    $update_user = array();
    if(!empty($_POST['username']))
    {
        $update_user['username'] = $_POST['username'];
    }
    if(!empty($_POST['password']))
    {
        $me = DB::queryFirstRow("SELECT password FROM Users WHERE uid=%s",
                                $_SESSION['uid']);
        if($_POST['oldpassword'] != $me['password'])
        {
            $msg = '旧密码错误';
            goto failed;
        }
        if($_POST['password'] != $_POST['password2'])
        {
            $msg = '密码不匹配';
            goto failed;
        }
        $update_user['password'] = $_POST['password'];
    }
    if($update_user)
    {
        DB::update('Users', $update_user, 'uid=%s', $_SESSION['uid']);
    }

    $update2 = array();
    if($_SESSION['ut'] == 'c')
    {
        $table = 'Clubs';
        $update2['contact'] = $_POST['contact'];
    }
    else
    {
        $table = 'Students';
        $update2['phone'] = $_POST['phone'];
        $update2['email'] = $_POST['email'];
    }
    DB::update($table, $update2, 'uid=%s', $_SESSION['uid']);
    $_SESSION['msg'] = '更新信息成功';
    finish_redirect('/setting.php');
}
return;

failed:
$_SESSION['msg'] = $msg;
finish_redirect('/setting.php');

?>
    