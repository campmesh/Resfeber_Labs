<?php
$fp = fopen('file4.json', 'w+');
fwrite($fp, json_encode($returnArray));
fclose($fp);
?>