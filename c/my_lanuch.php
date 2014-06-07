<?php

/* TODO : 取出当前社团发布的全部活动的信息 */
/* uid      clubs的uid */
/* cur_page	用户点击的当前页 */
/* size		计划每页显示的活动数量 */

require_once("../include/dbhome.php");
$cur_page = @$_GET['cur_page'];
if($cur_page <=0) $cur_page = 1;
$size = 10;

if(!isset($_SESSION['ut']))
{
    echo 'Only login Club can do this.';
    return;
}
else if($_SESSION['ut'] == 's')
{
    echo 'Only login Club can do this.';
    return;
}
else
{
    $uid = $_SESSION['uid']; // 当前用户的uid
    $acs = DB::query("SELECT A.* FROM Launch AS L ".
                     "JOIN Activities AS A ON L.aid = A.aid ".
                     "WHERE L.uid = %s ".
				     "ORDER BY date DESC " .
				     "LIMIT %d, %d", $uid,
                      $size*($cur_page-1), $size); // <------------- 取出当前用户发布的全部活动的信息
    render_t('c/my_lanuch.html', array('acs' => $acs));
}

?>
        