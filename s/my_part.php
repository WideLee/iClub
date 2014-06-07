<?php

/* 取出当前用户参加的全部活动的信息 */
require_once("../include/dbhome.php");

require_once("../include/dbhome.php");

if(!isset($_SESSION['ut']))
{
    echo 'Only login student can do this.';
    return;
}
else if($_SESSION['ut'] == 'c')
{
    echo 'Only login student can do this.';
    return;
}
else
{
    $uid = $_SESSION['uid']; // 当前用户的uid
    $acs = DB::query("SELECT A.* FROM Activities AS A ".
                "JOIN Participate AS C ON A.aid=C.aid AND C.uid=%d ".
                "ORDER BY date DESC", $uid);
    render_t('s/my_part.html', array('acs' => $acs));
}

?>
        