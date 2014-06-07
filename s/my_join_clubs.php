<?php

/* TODO : 取出当前用户参加的全部社团 */

/* cur_page	用户点击的当前页 */
/* size		计划每页显示的活动数量 */
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

	$uid = $_SESSION['uid'];    

	$clubs = DB::query("SELECT C.uid, username, contact FROM Clubs as C ".
                   "JOIN Users AS U on C.uid=U.uid ".
                   "JOIN Belong_to AS P on P.uid_s=%d AND P.uid_c = C.uid",
                   $uid);  //<-- 取出社团列表

	render_t('s/my_join_clubs.html', array('clubs' => $clubs));
}
?>