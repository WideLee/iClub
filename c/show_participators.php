<?php

/* cur_page	�û�����ĵ�ǰҳ */
/* size		�ƻ�ÿҳ��ʾ�Ĳ��������� */
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
    $aid = $_GET['aid'] ;
    $student = DB::query("SELECT S.* FROM Participate AS P ".
                     "JOIN Users AS S ON S.uid = P.uid ".
                     "WHERE P.aid = %s ".
				     "LIMIT %d, %d", $aid,
                      $size*($cur_page-1), $size);

    render_t('c/show_part.html', array('s' => $student));
}
?>

