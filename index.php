<?php

/* ���ݣ�δ��¼����ҳ,��ʱ�併����ʾ���л����ԭ��ͼ.pdf�ĵ�6ҳ */

require_once("include/dbhome.php");

$acs = DB::query("SELECT * FROM Activities",
                "ORDER BY date DESC");


$clubs = DB::query("SELECT C.uid, username, contact FROM Clubs as C ".
                   "JOIN Users as U on C.uid=U.uid ");

if(isset($_SESSION['uid']) && ($_SESSION['ut'] == 's'))
{
    $tot = DB::queryFirstRow("SELECT sum(stamped_number) as sn, sum(volunteer_hour) as vh, sum(credit) as cr, count(P.uid) as total FROM Activities as A JOIN Participate as P ON A.aid=P.aid WHERE P.uid=%d", $_SESSION['uid']);
}
else
{
    $tot = array();
}

render_t('home.html', array('acs' => $acs, 'clubs' => $clubs, 'tot'=>$tot));

?>

