<?php
  //DB관련
  //github에 내 비번 남기기 싫어서 비번저장하는php따로 만듦
  //open MYSQL server
  include("../../../outside-webroot/phpsqlajax_dbinfo.php");
  require("lib/db.php");
  $connection = db_init($config["host"], $config["db_user"], $config["db_pass"], $config["db_name"]);
  unset($config);
  //조회
  $query = 'SELECT * FROM markers WHERE 1';
  $result = mysqli_query($connection, $query);
  if(!$result){
    die('Invalid query : '.mysql_error());
  }
  // //출력
  // while ($row = mysqli_fetch_assoc($result)) {
  //     echo $row['id'].$row['name'];
  //     echo "<br />";
  // }
  // //exit;


  //xml관련 - 포인터같음 - link같이 연결되는 구조인듯
  //start XML file, create parent node
  //$doc = domxml_new_doc("1.0"); : domxml_new_doc가 없음
  $dom = new DOMDocument("1.0");
  $node = $dom->createElement("markers");
  $parnode = $dom->appendChild($node);

  //header은 어디로 방향 돌린다는 뜻을 포함하는듯?
  //xml코드를 outputting할 것이라는 뜻인가 봄
  header("Content-type: text/xml");

  // row로 반복! 각각에 xml node 추가
  while($row = mysqli_fetch_assoc($result)){
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['id']);
    $newnode->setAttribute("name",$row['name']);
    $newnode->setAttribute("address",$row['address']);
    $newnode->setAttribute("lat",$row['lat']);
    $newnode->setAttribute("lng",$row['lng']);
    $newnode->setAttribute("type",$row['type']);
  }

  //$xmlfile = $doc->dump_mem();
  echo $dom->saveXML();
?>
