<?php
/* �ҵ�ȫ����Ա */
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
  $uid = $_SESSION['uid']; //��ǰ�û���uid
  $student = DB::query("SELECT S.* FROM Belong_to AS B ".
                     "JOIN Users AS S ON S.uid = B.uid_s ".
                     "WHERE B.uid_c = %s ".
				     "LIMIT %d, %d", $uid,
                      $size*($cur_page-1), $size);

  render_t('c/my_member.html', array('ss' => $student));
}
?>

