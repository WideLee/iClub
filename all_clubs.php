<?php

/* TODO : 取出全部的社团*/

/* cur_page	用户点击的当前页 */
/* size		计划每页显示的社团数量 */

require_once("include/dbhome.php");


if(isset($_GET['cur_page'])) $cur_page = @$_GET['cur_page'];
else $cur_page = 1;

$size = 10;


render_t('all_clubs.html', array('clubs' => $clubs));
?>