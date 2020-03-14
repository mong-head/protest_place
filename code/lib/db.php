<?php
function db_init($host,$db_u,$db_pw,$db_name){
  // mysqli : php의 sql api

  //서버 접속
  $conn = mysqli_connect($host, $db_u, $db_pw);
  if (!$conn) {
    die('Not connected : ' . mysql_error());
  }

  //DB선택
  $db_select = mysqli_select_db($conn, $db_name);
  if(!$db_select){
    die("can\'t use db : ".mysql_error());
  }
  return $conn;
}
?>
