<?php
/* $Id: ConnectDB.inc 5708 2012-10-13 03:26:00Z daintree $*/
/* $Version is compared against the value for config.confvalue WHERE confname=VersionNumber in the database
 * this value is saved in the $_SESSION['Versionumber'] when includes/GetConfig.php is run
 * if  VersionNumber is < $Version  then the DB update script is run */

$Version='4.09.1'; //must update manually every time there is a DB change

require_once ($PathPrefix .'includes/MiscFunctions.php');



			$_SESSION['DatabaseName'] = 'dbran';
			include_once ($PathPrefix . 'include/ConnectDB_mysql.inc');


?>
