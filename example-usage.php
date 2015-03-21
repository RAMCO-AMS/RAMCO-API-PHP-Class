<?php
  /**
  * API Written by Jason Normandin and Mark Lesswing
  * Class Design  Dave Conroy
  * dconroy@marealtor.com March 2015
  * API Doc URL : https://api.ramcoams.com/api/v2/ramco_api_v2_doc.pdf
  */
  
require_once 'config.php';
require_once 'RamcoAPI.php';
$api_config = array("key" => API_KEY,
                    "url" => API_URL,
		    "cert" => PEM_FILE,
                    "timezone_offset" => '+4 Hours'); //Eastern is GMT-4, this cancels out the time difference
       
//create our class       
$RamcoAPI = new RamcoAPI($api_config);
//5 Sample Uses

// 1) Get Entity Types
$RamcoAPI->clearVars();
$RamcoAPI->setOperation("GetEntityTypes");
$json = $RamcoAPI->sendMessage();
echo $json;


/*
// 2) Get Entity Metadata
$RamcoAPI->clearVars();
$RamcoAPI->setoperation("GetEntityMetadata");
$RamcoAPI->setEntity("Contact");
$json = $RamcoAPI->sendMessage();
echo $json;
*/

/*
// 3) Get Option Set
$RamcoAPI->clearVars();
$RamcoAPI->setOperation("GetOptionSet");
$RamcoAPI->setEntity("Contact");
$RamcoAPI->setAttributes("cobalt_PreferredPhone");
$json = $RamcoAPI->sendMessage();
echo $json;
*/

/*
// 4) Query Contacts Who's Last Name begins with 'Th' and was last modified between the first quarter of 2015
$RamcoAPI->clearVars();
$RamcoAPI->setOperation("GetEntities");
$RamcoAPI->setEntity("Contact");
$RamcoAPI->setAttributes("ContactId,FirstName,LastName,cobalt_NRDSID,cobalt_contact_cobalt_membership/statuscode");
$RamcoAPI->setMaxResults("30");
$RamcoAPI->setFilter("LastName<sb>#Th# and (ModifiedOn<ge>2014-12-31 and ModifiedOn<le>2015-04-01)"); //last name , string begins with 'Th'
$json = $RamcoAPI->sendMessage();
echo $json;
*/

/*
// 5) Query Contacts Modified in Last 5 Minutes
$RamcoAPI->clearVars();
$server_time= new DateTime('NOW'); //GMT
$modified = $server_time->modify('-5 minutes');  // Get Records Modified in Past 5 minutes
$modified = $modified->modify($RamcoAPI->getTimezoneOffset());  //Cancel out Timezone Offset
$RamcoAPI->setOperation("GetEntities");
$RamcoAPI->setEntity("Contact");
$RamcoAPI->setAttributes("FirstName,LastName,modifiedon");
$RamcoAPI->setMaxResults("30");
$RamcoAPI->setFilter("ModifiedOn<ge>".$modified->format(DateTime::RFC3339));
$json = $RamcoAPI->sendMessage();
echo $json;
*/



// Output a message at the end of the file
echo "End of file git mac.<br />";
?>
