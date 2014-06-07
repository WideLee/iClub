<?php

// 包含meekrodb库
require_once('meekrodb.php');

header("Content-Type: text/html; charset=UTF-8");

if(defined("SAE_MYSQL_USER"))
{
    DB::$user = SAE_MYSQL_USER;
    DB::$password = SAE_MYSQL_PASS;
    DB::$dbName = SAE_MYSQL_DB;
    DB::$port = SAE_MYSQL_PORT;
    DB::$host = SAE_MYSQL_HOST_M;
}
else           //调用本地数据库
{
    //DB::$host = 'localhost';
    DB::$user = 'root';
    DB::$password = 'xjtaqm';
    DB::$dbName = 'iclub';
    //DB::$user = 'bc85d0d11747bf';
    //DB::$password = 'f04c12a1';
    //DB::$host = 'ap-cdbr-azure-east-a.cloudapp.net';
    DB::$port = 3306;
    // Delay -> sysussiclub
    /* DB::$password = ''; */
    /* DB::$dbName = 'iclub'; */
}

require_once('h2o.php');
$h2o_tpl = new H2o('', array('searchpath' =>
                             dirname(__FILE__) . '/../templates/'));

function render_s($name, $kwargs=array())//定义跳转函数
{
    global $h2o_tpl;
    $tt = clone $h2o_tpl;
    $tt->loadTemplate($name);
    return $tt->render($kwargs);
}

function render_t($name, $kwargs=array())
{
    global $h2o_tpl;
    $h2o_tpl->loadTemplate($name);
    echo $h2o_tpl->render($kwargs);
}

function url_for_home($pagenum)
{
    return "home.php?pagenum=$pagenum";
}

function url_for_active($aid, $pagenum=1)
{
    return "/show_a.php?aid=$aid&pagenum=$pagenum";
}

function url_for_part_a($aid)
{
    return "/s/ajax_part.php?aid=$aid";
}

function url_for_club($uid, $pagenum=1)
{
    return "club.php?uid=$uid&pagenum=$pagenum";
}

function url_for_list_club($pagenum=1)
{
    return "list_club.php?pagenum=$pagenum";
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function url_for_avatar( $email, $s = 50, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

$h2o_tpl->addFilter('url_for_avatar');
$h2o_tpl->addFilter('url_for_active');
$h2o_tpl->addFilter('url_for_part_a');

function finish_redirect($url)
{
    header("Location: $url");
    die();
}

session_start();
$h2o_tpl->set('session', $_SESSION);

?>