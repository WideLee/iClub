<?php

/* TODO : 取出当前用户关注的全部社团 */

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

	$uid = $_SESSION['uid'];    //<-- 考虑不是学生要怎么办

	$clubs = DB::query("SELECT C.uid, username, contact FROM Clubs as C ".
                   "JOIN Users AS U on C.uid=U.uid ".
                   "JOIN Concern AS P on P.uid_s=%d AND P.uid_c = C.uid",
                   $uid);  //<-- 取出社团列表

	render_t('s/my_star_clubs.html', array('clubs' => $clubs));
	
}
?>