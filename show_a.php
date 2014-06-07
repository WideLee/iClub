<?php

//���ݣ��鿴ĳ����Ľ��ܣ���ԭ��ͼ.pdf�ĵ�7ҳ
//响应主页上点击活动时显示活动信息
require_once("include/dbhome.php");

$aid = $_GET['aid'];
$activity = DB::queryFirstRow("SELECT * FROM Activities ".
                              "WHERE aid = %d",$aid);
$data = array('a' => $activity);
if(isset($_SESSION['uid']))
{
    $uid = $_SESSION['uid'];
    if($_SESSION['ut'] == 's')
    {
        $status = DB::queryFirstRow("SELECT (SELECT uid FROM Participate AS P WHERE P.uid=%d AND P.aid=%d) AS is_part, ".
                                    "       (SELECT uid FROM Collect AS C WHERE C.uid=%d AND C.aid=%d) AS is_coll", $uid, $aid, $uid, $aid);
        if(!$status) $status=array('no' => 1);
    }
    else
    {
        $status = DB::queryFirstRow("SELECT uid as admin FROM Launch AS P WHERE P.uid=%d AND P.aid=%d", $uid, $aid);
    }
    $data['s'] = $status;
}

$sponer = DB::query("SELECT U.uid, U.username, C.contact FROM Launch AS L ".
                    "JOIN Clubs AS C ON L.uid=C.uid ".
                    "JOIN Users AS U ON U.uid=C.uid ".
                    "WHERE L.aid=%d", $aid);
$data['sponer'] = $sponer;

render_t('show_a.html', $data);

?>

