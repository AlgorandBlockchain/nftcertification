<?php // -*- C++ -*-

// $Id$

// See http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.9
// for cache control header descriptions (used in many places on the site).

// Provide default content-type, charset and language information
// Manual pages will override this, and maybe others too
header("Content-language: en");
header("Content-type: text/html; charset=utf-8");

// Be 100% sure the timezone is set
if (ini_get("date.timezone") === "" && function_exists("date_default_timezone_set")) {
    date_default_timezone_set("UTC");
}

// As of PHP 5.3.0 multibyte sequence errors are no longer
// silent. Prior to that version this bitfield does not exist
// so define it to prevent notices on older versions
if (!defined("ENT_IGNORE")) {
    define("ENT_IGNORE", 0);
}

// Prevent cross site scripting problems
unset($RSIDEBAR_DATA);
unset($SIDEBAR_DATA);
unset($SEARCH_BASE);
unset($LANG);
unset($COUNTRY);
unset($ONLOAD);
unset($MYPHPNET);
unset($LAST_UPDATED);

// Load the My PHP.net settings before any includes
myphpnet_load();

// TODO: Remove MQ dependencies from phpweb
$MQ = get_magic_quotes_gpc();
if (get_magic_quotes_runtime()) {
    @set_magic_quotes_runtime(0);
}

// Check for APC support
$APC = function_exists('apc_store');

// Site details (mirror site information)
include 'site.inc';

// Choose language used for translated parts
include 'langchooser.inc';

// Get country of the user and set it in a cookie
include 'ip-to-country.inc';

// Common layout functions
include 'layout.inc';

// This file is generated on rsync.php.net and propagated
// from there. It just defines $LAST_UPDATED, which is the
// mirror's last updated time.
include 'last_updated.inc';

// -----------------------------------------------------------------------------

// SETBETA Setting for temporary banners
if(isset($_GET['setbeta']) && !headers_sent()) {
    myphpnet_setbeta( (bool) $_GET['setbeta']);
    myphpnet_save();
    list($path, $query) = explode('?', $_SERVER['REQUEST_URI'], 2);
    mirror_redirect($path);
    exit;
}


// Load in the user preferences
function myphpnet_load()
{
    global $MYPHPNET, $MYSITE;

    // Empty the preferences array
    $MYPHPNET = array(FALSE, FALSE, "NONE", 0, FALSE);

    if ($MYSITE === 'http://docs.php.net/') {
        $MYPHPNET[4] = TRUE;
    }

    // If we have a cookie, set the values in the array
    if (!empty($_COOKIE['MYPHPNET'])) {
        $MYPHPNET = explode(",", $_COOKIE['MYPHPNET']);
    }
}

// Get or set preferred language code
function myphpnet_language($langcode = FALSE)
{
    global $MYPHPNET, $LANGUAGES;

    // Set language code
    if ($langcode && isset($LANGUAGES[$langcode])) {
        $MYPHPNET[0] = $langcode;
    }
    // Return code or FALSE
    elseif (isset($MYPHPNET[0]) && $MYPHPNET[0]) {
        return $MYPHPNET[0];
    }
    else {
        if (myphpnet_beta()) {
            return "en";
        }
        return FALSE;
    }
}

define("MYPHPNET_URL_NONE", FALSE);
define("MYPHPNET_URL_FUNC", 'quickref');
define("MYPHPNET_URL_MANUAL", 'manual');

// Set URL search fallback preference
function myphpnet_urlsearch($type = FALSE)
{
    global $MYPHPNET;

    // Set type if specified and if correct
    if ($type && in_array($type, array(MYPHPNET_URL_FUNC, MYPHPNET_URL_MANUAL))) {
        $MYPHPNET[1] = $type;
    }

    // Return code or NONE
    elseif (isset($MYPHPNET[1]) && !empty($MYPHPNET[1])) {
        return $MYPHPNET[1];
    } else { return MYPHPNET_URL_NONE; }
}

// Set mirror site redirection
function myphpnet_mirror($murl = FALSE)
{
    global $MYPHPNET;

    // Set mirror URL if specified and if correct
    if ($murl && ($murl == "AUTO" || mirror_status($murl) == MIRROR_OK)) {
        $MYPHPNET[2] = $murl;
    }

    // Return code or NONE
    elseif (isset($MYPHPNET[2])) {
        return $MYPHPNET[2];
    } else { return "NONE"; }
}

// Set suggestion hiding preference
function myphpnet_hidesuggest($hide = FALSE)
{
    global $MYPHPNET;

    // Set hiding preference, or return with value
    if (is_numeric($hide)) {
        $MYPHPNET[3] = $hide;
    }
    elseif (isset($MYPHPNET[3])) {
        return $MYPHPNET[3];
    } else {
        return 0;
    }
}

// Save user settings in cookie
function myphpnet_save()
{
    global $MYPHPNET;

    // Fill in values not specified
    for ($i = 0; $i <= 3; $i++) {
        if (!isset($MYPHPNET[$i])) { $MYPHPNET[$i] = FALSE; }
    }

    // Set all the preferred values for a year
    mirror_setcookie("MYPHPNET", join(",", $MYPHPNET), 60*60*24*365);

}

function myphpnet_setbeta($bool = false) {
    global $MYPHPNET;

    $bool = (bool) $bool;

    $MYPHPNET[4] = (bool) $bool;
}
function myphpnet_beta() {
    global $MYPHPNET;
    global $MYSITE;

    if (isset($_GET["beta"])) {
        return (bool)$_GET["beta"];
    }

    if ($MYSITE === 'http://prototype.php.net/') {
        return true;
    }

    if (isset($MYPHPNET[4])) {
        return (bool)$MYPHPNET[4];
    }

    return false;
}

// Default: Default search.
// Lang: Not yet implemented (TODO: Compare google lang codes with ours. We did this for bing already, so maybe it's an easy fix)
// TODO: Possible $default escaping issues
function google_cse($default = '', $lang = 'en') {
?>
<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : '<?php echo $lang; ?>', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var customSearchControl = new google.search.CustomSearchControl(
      '011570197911755000456:fip9wopfz_u', customSearchOptions);
    customSearchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    customSearchControl.draw('cse', options);
<?php
    if ($default) {
        echo "    customSearchControl.execute(" . json_encode($default) . ");";
    }
?>
  }, true);
</script>
<?php
}
