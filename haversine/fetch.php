<?php
$returnArray = array();
mysql_connect("127.0.0.1", "root", "") or die (mysql_error());
echo "Connected to MYSQL ";
mysql_select_db("Resfeber_Labs") or die (mysql_error());
echo "Connected to Data Base";
$sql = "SELECT idTaxi FROM `Resfeber_Labs`.`Taxi` 
    ORDER BY 
    (10*2*r*ASIN(SQRT(POW(SIN(RADIANS((`Resfeber_Labs`.`Taxi`.`Latitude` - lat1)/2)),2) +  
    cos(RADIANS(lat1))*cos(RADIANS(`Resfeber_Labs`.`Taxi`.`Latitude`))*POW(SIN(RADIANS((`Resfeber_Labs`.`Taxi`.`Longitude`- lon1
    )/2)),2))) + 
    3*`Resfeber_Labs`.`Taxi`.`Rating` + 3*`Resfeber_Labs`.`Taxi`.`cNum`) 
    ASC LIMIT 3;"
$query = mysql_query($sql);
while($rs = mysql_fetch_array($query, MYSQL_ASSOC)) {    
  $returnArray[] = $rs;     
}
?>