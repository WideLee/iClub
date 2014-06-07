<?php

require_once('../include/dbhome.php');

$msg = '';

if(!isset($_SESSION['uid']) ||
   $_SESSION['ut'] != 'c')
{
    $msg =  '只有登录社团才能发起活动！';
    goto failed;
}
if($_POST)
{
    $now = new DateTime();
    DB::insert('Activities',
               array(
                     'title' => $_POST['title'],
                     'attribute' => 0,
                     'categories' => $_POST['cat'],
                     'stamped_number' => $_POST['stamped'],
                     'volunteer_hour' => $_POST['vhour'],
                     'credit' => $_POST['credit'],
                     'date' => $now->format("Y-m-d H:i:s"),
                     'deadline' => $_POST['deadline'],
                     'begin_time' => $_POST['begin'],
                     'end_time' => $_POST['end'],
                     'location' => $_POST['location'],
                     'phone' => $_POST['phone'],
                     'posturl' => $_POST['posturl'],
                     'other_info' => $_POST['info']));
    $aid = DB::insertId();
    DB::insert('Launch',
               array('uid' => $_SESSION['uid'],
                     'aid' => $aid));
    render_t('c/new_activity_success.html');
}
else
{
    render_t('c/new_activity.html');
}
exit();

failed:

render_t('c/new_activity_failed.html', array('msg' => $msg));

?>