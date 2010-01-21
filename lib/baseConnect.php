<?php
$link = false;
function connect()
{
    global $link;

    $host = "localhost";
    $user = "www";
    $base = "intellect";
    $pass = "lokos";

    $link = mysql_connect($host, $user, $pass)
          or die ("Could not connect to MySQL");

    mysql_select_db ($base, $link) or die ("Could not select database");

    unset ($host);
    unset ($user);
    unset ($base);
    unset ($pass);

         $query = "SET NAMES 'utf8'";
         $result = mysql_query ($query) or die (mysql_error($link));
         $query = "SET collation_connection = 'utf8_general_ci'";
         $result = mysql_query ($query) or die (mysql_error($link));


}
?>