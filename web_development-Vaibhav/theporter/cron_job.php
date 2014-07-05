<?php
#require_once("./include/website_config.php");
require_once("/var/www/theporter/include/website_config.php");
	if(!$website->DBLogin())
	{
		$website->log_error("File : cron_job.php : DB LOGIN FAILED");
		exit;
	}
	$query='SELECT DISTINCT(`msisdn`)FROM `driver`';
	$result = mysql_query($query,$website->connection); 
	if(!$result || mysql_num_rows($result) <= 0)
	{
		$website->log_error("File : cron_job.php : MSISDN QUERY READ FAILED From 'driver' table");
		exit;
	}
	else
	{
		while($row=mysql_fetch_assoc($result))
		{
			$url = 'https://tracemate.airtel.in/locateme/index.php?acc=Resfeber&device='.$row['msisdn'].'&userid=Resfeber&password=R123e456';
			$current = file_get_contents($url);
			if($current==NULL)
			{
				$website->log_error("File : cron_job.php : AIRTEL returned No Result :".$row['msisdn']);
				exit;
			}
			$data = substr($current,strpos($current,'<'),strrpos($current,'>')+1);
			$xml = simplexml_load_string($data);
			$location_info = array();
			foreach($xml->result->device->children() as $child) 
			{
				$location_info[$child->getName()] = $child; 
			}
			
			$qry='INSERT INTO `vehicle_location` (`msisdn`, `date_time`, `latitude`, `longitude`, `poi`, `road`, `sublocality`, `locality`, `city_town`, `district`, `state`, `date_time_log`) VALUES ('.$location_info['msisdn'].', "'.$location_info['datetime'].'", '.$location_info['latitude'].', '.$location_info['longitude'].', "'.$location_info['poi'].'", "'.$location_info['road'].'", "'.$location_info['sublocality'].'", "'.$location_info['locality'].'", "'.$location_info['city-town'].'", "'.$location_info['district'].'", "'.$location_info['state'].'", CURRENT_TIMESTAMP)';

			$result1 = mysql_query($qry,$website->connection);
			if(!$result1)
			{
				$website->log_error("File : cron_job.php : MSISDN INSERT QUERY FAILED INTO 'vehicle_details' table");
				exit;
			}
		}//while
		
	}//else
?>
