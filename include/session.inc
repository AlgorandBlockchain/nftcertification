<?php
/* $Id: session.inc 5590 2012-08-08 09:09:46Z daintree $*/

if (!isset($PathPrefix)) {
	$PathPrefix='';
}


if (!file_exists($PathPrefix . 'config.php')){
	$rootpath = dirname(htmlspecialchars($_SERVER['PHP_SELF'],ENT_QUOTES,'UTF-8'));
	if ($rootpath == '/' OR $rootpath == "\\") {
		$rootpath = '';
	}

}
include($PathPrefix . 'config.php');

if (isset($SessionSavePath)){
	session_save_path($SessionSavePath);
}

ini_set('session.gc_maxlifetime',$SessionLifeTime);

if( !ini_get('safe_mode') ){
	set_time_limit($MaximumExecutionTime);
	ini_set('max_execution_time',$MaximumExecutionTime);
}

include('globalx.php');
include('DateFunctions.inc');

// Uncomment to turn off attempts counter
//$_SESSION['AttemptsCounter'] = 0;

if (!isset($_SESSION['AttemptsCounter'])){
	$_SESSION['AttemptsCounter'] = 0;
}

/* iterate through all elements of the $_POST array and DB_escape_string them
to limit possibility for SQL injection attacks and cross scripting attacks
*/

if (isset($_SESSION['DatabaseName'])){
	foreach ($_POST as $key => $value) {
		if (gettype($value) != 'array') {
			if(get_magic_quotes_gpc()) {
				$_POST['name'] = stripslashes($_POST['name']);
			}
			$_POST[$key] = DB_escape_string($value);
		} else {
			foreach ($value as $key1 => $value1) {
				if(get_magic_quotes_gpc()) {
					$value[$key1] = stripslashes($value[$key1]);
				}
				$value[$key1] = DB_escape_string($value1);
			}
		}
	}

	/* iterate through all elements of the $_GET array and DB_escape_string them
	to limit possibility for SQL injection attacks and cross scripting attacks
	*/
	foreach ($_GET as $key => $value) {
		if (gettype($value) != 'array') {

		}
	}
} else { //set SESSION['FormID'] before the a user has even logged in
	$_SESSION['FormID'] = sha1(uniqid(mt_rand(), true));
}

include($PathPrefix . 'includes/LanguageSetup.php');


if (!isset($AllowAnyone)){ /* only do security checks if AllowAnyone is not true */

	include $PathPrefix . 'includes/UserLogin.php';	/* Login checking and setup */

	if (isset($_POST['UserNameEntryField']) AND isset($_POST['Password'])) {
		$rc = userLogin($_POST['UserNameEntryField'], $_POST['Password'], $db);
	} elseif (empty($_SESSION['DatabaseName'])) {
		$rc = UL_SHOWLOGIN;
	} else {
		$rc = UL_OK;
	}

	/*  Need to set the theme to make login screen nice */
	$theme = (isset($_SESSION['Theme'])) ? $_SESSION['Theme'] : 'gel';
	switch ($rc) {
	case  UL_OK;

		break;

	case UL_SHOWLOGIN:

		exit;

	case UL_BLOCKED:
		die(include($PathPrefix . 'includes/FailedLogin.php'));

	case  UL_CONFIGERR:
		$title = _('Account Error Report');

		echo '<br /><br /><br />';
		prnMsg(_('Your user role does not have any access defined for webERP. There is an error in the security setup for this user account'),'error');

			exit;

	case  UL_NOTVALID:
		$demo_text = '<font size="3" color="red"><b>' .  _('incorrect password') . '</b></font><br /><b>' . _('The user/password combination') . '<br />' . _('is not a valid user of the system') . '</b>';
		die(include($PathPrefix . 'includes/Login.php'));

	case  UL_MAINTENANCE:
		$demo_text = '<font size="3" color="red"><b>' .  _('system maintenance') . '</b></font><br /><b>' . _('webERP is not available right now') . '<br />' . _('during maintenance of the system') . '</b>';
		die(include($PathPrefix . 'includes/Login.php'));

	}
} /* only do security checks if AllowAnyone is not true */



/*User is logged in so get configuration parameters  - save in session*/
include($PathPrefix . 'includes/GetConfig.php');

/*The page security variable is now retrieved from the database in GetConfig.php and stored in the $SESSION['PageSecurityArray'] array
 * the key for the array is the script name - the script name is retrieved from the basename ($_SERVER['SCRIPT_NAME'])
 */
if (!isset($PageSecurity)){
//only hardcoded in the UpgradeDatabase script - so old versions that don't have the scripts.pagesecurity field do not choke
  $PageSecurity = $_SESSION['PageSecurityArray'][basename($_SERVER['SCRIPT_NAME'])];
}

/*If the Code $Version - held in ConnectDB.inc is > than the Database VersionNumber held in config table then do upgrades */
if (strcmp($Version,$_SESSION['VersionNumber'])>0 AND (basename($_SERVER['SCRIPT_NAME'])!='UpgradeDatabase.php')) {
  header('Location: UpgradeDatabase.php');
}

if(isset($_SESSION['DB_Maintenance'])){
  if ($_SESSION['DB_Maintenance']!=0)  {
    if (DateDiff(Date($_SESSION['DefaultDateFormat']),
        ConvertSQLDate($_SESSION['DB_Maintenance_LastRun'])
        ,'d')  >=   $_SESSION['DB_Maintenance']){

      /*Do the DB maintenance routing for the DB_type selected */
      DB_Maintenance($db);
      //purge the audit trail if necessary
      if (isset($_SESSION['MonthsAuditTrail'])){
         $sql = "DELETE FROM audittrail
            WHERE  transactiondate <= '" . Date('Y-m-d', mktime(0,0,0, Date('m')-$_SESSION['MonthsAuditTrail'])) . "'";
        $ErrMsg = _('There was a problem deleting expired audit-trail history');
        $result = DB_query($sql,$db);
      }
      $_SESSION['DB_Maintenance_LastRun'] = Date('Y-m-d');
    }
  }
}

/*Check to see if currency rates need to be updated */
if (isset($_SESSION['UpdateCurrencyRatesDaily'])){
  if ($_SESSION['UpdateCurrencyRatesDaily']!=0)  {
    if (DateDiff(Date($_SESSION['DefaultDateFormat']),
        ConvertSQLDate($_SESSION['UpdateCurrencyRatesDaily'])
        ,'d')> 0){

      $CurrencyRates = GetECBCurrencyRates(); // gets rates from ECB see includes/MiscFunctions.php
      /*Loop around the defined currencies and get the rate from ECB */
      if ($CurrencyRates!=false) {
        $CurrenciesResult = DB_query("SELECT currabrev FROM currencies",$db);
        while ($CurrencyRow = DB_fetch_row($CurrenciesResult)){
          if ($CurrencyRow[0]!=$_SESSION['CompanyRecord']['currencydefault']){

            $UpdateCurrRateResult = DB_query("UPDATE currencies SET
              rate='" . GetCurrencyRate($CurrencyRow[0],$CurrencyRates) . "'
              WHERE currabrev='" . $CurrencyRow[0] . "'",$db);
          }
        }
        $_SESSION['UpdateCurrencyRatesDaily'] = Date('Y-m-d');



        $UpdateConfigResult = DB_query("UPDATE config SET confvalue = '" . Date('Y-m-d') . "' WHERE confname='UpdateCurrencyRatesDaily'",$db);
      }
    }
  }
}


If (isset($_POST['Theme']) AND ($_SESSION['UsersRealName'] == $_POST['RealName'])) {
  $_SESSION['Theme'] = $_POST['Theme'];
  $theme = $_POST['Theme'];
} elseif (!isset($_SESSION['Theme'])) {
  $theme = $_SESSION['DefaultTheme'];
  $_SESSION['Theme'] = $_SESSION['DefaultTheme'];

} else {
  $theme = $_SESSION['Theme'];
}

/* Set the logo if not yet set.
 * will be done only once per session and each time
 * we are not in session (i.e. before login)
 */
if (empty($_SESSION['LogoFile'])) {
  /* find a logo in companies/$CompanyDir
   * (nice side effect of function:
   * variables are local, so we will never
   * cause name clashes)
   */

  function findLogoFile($CompanyDir, $PathPrefix) {
    $dir = $PathPrefix.'companies/' . $CompanyDir . '/';
    $DirHandle = dir($dir);
    while ($DirEntry = $DirHandle->read() ){
      if ($DirEntry != '.' AND $DirEntry !='..'){
        $InCompanyDir[] = $DirEntry; //make an array of all files under company directory
      }
    } //loop through list of files in the company directory
    if ($InCompanyDir !== FALSE) {
      foreach($InCompanyDir as $logofilename) {
        if (strncasecmp($logofilename,'logo.png',8) === 0 AND
          is_readable($dir . $logofilename) AND
          is_file($dir . $logofilename)) {
          $logo = $logofilename;
          break;
        }
      }
      if (!isset($logo)) {
        foreach($InCompanyDir as $logofilename) {
          if (strncasecmp($logofilename,'logo.jpg',8) === 0 AND
            is_readable($dir . $logofilename) AND
            is_file($dir . $logofilename)) {
            $logo = $logofilename;
            break;
          }
        }
      }
      if (empty($logo)) {
        return null;
      } else {
        return 'companies/' .$CompanyDir .'/'. $logo;
      }
    } //end listing of files under company directory is not empty
  }

  /* Find a logo in companies/<company of this session> */
  if (!empty($_SESSION['DatabaseName'])) {
    $_SESSION['LogoFile'] = findLogoFile($_SESSION['DatabaseName'], $PathPrefix);
  }
}

if ($_SESSION['HTTPS_Only']==1){
  if ($_SERVER['HTTPS']!='on'){
    prnMsg(_('webERP is configured to allow only secure socket connections. Pages must be called with https://') . ' .....','error');
    exit;
  }
}



// Now check that the user as logged in has access to the page being called. The $PageSecurity
// value must be set in the script before header.inc is included. $SecurityGroups is an array of
// arrays defining access for each group of users. These definitions can be modified by a system admin under setup


if (!is_array($_SESSION['AllowedPageSecurityTokens']) AND !isset($AllowAnyone)) {
  $title = _('Account Error Report');
  include($PathPrefix . 'includes/header.inc');
  echo '<br /><br /><br />';
  prnMsg(_('Security settings have not been defined for your user account. Please advise your system administrator. It could also be that there is a session problem with your PHP web server'),'error');
  include($PathPrefix . 'includes/footer.inc');
  exit;
}

if (!isset($AllowAnyone)){
  if ((!in_array($PageSecurity, $_SESSION['AllowedPageSecurityTokens']) OR !isset($PageSecurity))) {
    $title = _('Security Permissions Problem');
    include($PathPrefix . 'includes/header.inc');
    echo '<tr>
      <td class="menu_group_items">
        <table width="100%" class="table_index">
          <tr><td class="menu_group_item">';
    echo '<b><font style="size:+1; text-align:center;">' . _('The security settings on your account do not permit you to access this function') . '</font></b>';

    echo '</td>
      </tr>
      </table>
      </td>
      </tr>';

    include($PathPrefix . 'includes/footer.inc');
    exit;
  }
 }

if (in_array(9,$_SESSION['AllowedPageSecurityTokens']) and $PageSecurity==0 and count($_SESSION['AllowedPageSecurityTokens'])==2){
  $SupplierLogin=1;
} else if (in_array(1,$_SESSION['AllowedPageSecurityTokens']) and $PageSecurity==0 and count($_SESSION['AllowedPageSecurityTokens'])==2){
  $SupplierLogin=0;
}

if (in_array(15, $_SESSION['AllowedPageSecurityTokens'])) { /*System administrator login */
  $debug = 1; //allow debug messages
} else {
  $debug = 0; //don't allow debug messages
}
function CryptPass( $Password ) {
    global $CryptFunction;
    if ( $CryptFunction == 'sha1' ) {
      return sha1($Password);
    } elseif ( $CryptFunction == 'md5' ) {
      return md5($Password);
  } else {
      return $Password;
    }
 }


if (sizeof($_POST) > 0 AND !isset($AllowAnyone)) {
  /*Security check to ensure that the form submitted is originally sourced from webERP with the FormID = $_SESSION['FormID'] - which is set before the first login*/
  if (!isset($_POST['FormID']) or ($_POST['FormID'] != $_SESSION['FormID'])) {
    $title = _('Error in form verification');
    include('includes/header.inc');
    prnMsg(_('This form was not submitted with a correct ID') , 'error');
    include('includes/footer.inc');
    exit;
  }
}

?>
