<?PHP
require_once("ResfeberLabs.php");

$website = new ResfeberLabs();

//Provide your site name here
$website->SetWebsiteName('theporter.in');
//Provide Path to file to Store errors generated
$website->SetErrLogFilePath('./include/err_log.txt');
//Provide your database login details here:
//hostname, user name, password, database name and table name
$website->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'vivek',
                      /*database name*/'resfeberlabs');
$website->SetRandomKey('qSRcVS6DrTzrPvr');
?>
