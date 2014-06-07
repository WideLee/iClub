<?php
require_once('include/dbhome.php');

$msg = '';

if($_POST)
{
    $user = DB::queryFirstRow("SELECT * FROM Users WHERE login_id=%s AND password=%s", $_POST['login_id'], $_POST['password']);
    if(!isset($user['uid']))
    {
        $msg = '没有该用户或错误的密码.';
        goto failed;
    }
    else
    {
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['username'] = $user['username'];
        $ret = DB::queryFirstRow("SELECT * FROM Students " . 
                                 "WHERE uid=%s", $user['uid']);
        if(isset($ret['uid']))
        {
            $_SESSION['ut'] = 's';
            header("Location: /index.php");
            return;
        }
        $ret = DB::queryFirstRow("SELECT * FROM Clubs " . 
                                 "WHERE uid=%s", $user['uid']);
        if(isset($ret['uid']))
        {
            $_SESSION['ut'] = 'c';
            header("Location: /index.php");
            return;
        }
        $_SESSION['ut'] = 'n';
        return;
    }
}
else
{
    render_t('login.html');
    return;
}

failed:
render_t('login_failed.html', array('msg' => $msg));

?>
