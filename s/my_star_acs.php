<?php

/* TODO:  ���ղص�ȫ��� */

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
    $uid = $_SESSION['uid']; // ��ǰ�û���uid
    $acs = DB::query("SELECT A.* FROM Activities AS A ".
                "JOIN Collect AS C ON A.aid=C.aid AND C.uid=%d ".
                "ORDER BY date DESC", $uid);
    render_t('s/my_star_acs.html', array('acs' => $acs));
	
}

?>

