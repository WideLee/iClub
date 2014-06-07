<?php

/* TODO : 取出社团的信息 */
//点击主页上社团一览的社团时响应的php
require_once("include/dbhome.php");

$club = DB::queryFirstRow("SELECT * FROM Clubs AS C ".
                          "JOIN Users AS U ON U.uid=C.uid ".
                          "WHERE C.uid=%d", $_GET['uid']);

$acs = DB::query("SELECT A.* FROM Launch AS L ".
                 "JOIN Activities AS A ON L.aid = A.aid ".
                 "WHERE L.uid = %s ".
				 "ORDER BY date DESC ", $_GET['uid']);

if(isset($_SESSION['ut']) && $_SESSION['ut'] == 's')
{
    $stared = DB::queryFirstRow("SELECT uid_s FROM Concern ".
                                "WHERE uid_s=%s AND uid_c=%s",
                                $_SESSION['uid'], $_GET['uid']);
   $cstared = DB::queryFirstRow("SELECT uid_s FROM Belong_to ".
                                "WHERE uid_s=%s AND uid_c=%s",
                                $_SESSION['uid'], $_GET['uid']);
}
else
{
    $stared = null;
	$cstared = null;
}

render_t('show_c.html', array('acs' => $acs,
                              'acs_number' => count($acs),
                              'started' => $stared,
                              'club' => $club,
							  'cstared' => $cstared));

?>