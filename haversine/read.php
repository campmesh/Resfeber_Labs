<?php
$string = file_get_contents("file1.json");
$jsonRS = json_decode ($string,true);
foreach ($jsonRS as $rs) {
  echo stripslashes($rs["user_id"])." ";
  echo stripslashes($rs["latitude"])." ";
  echo stripslashes($rs["longitude"])."<br>";
}
?>