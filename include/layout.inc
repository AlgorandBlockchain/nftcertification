<?php
/* $Id$ */

// Set the static content root differently on php.net
if ($MYSITE == "http://www.php.net/" || $MYSITE == 'http://php.net/') {
    $_SERVER['STATIC_ROOT'] = 'http://static.php.net/www.php.net';
} elseif ($MYSITE == 'https://www.php.net/' || $MYSITE == 'https://php.net/') {
    $_SERVER['STATIC_ROOT'] = 'https://static.php.net/www.php.net';
} elseif (!isset($_SERVER['STATIC_ROOT'])) {
    $_SERVER['STATIC_ROOT'] = "";
}

// Use class names instead of colors
ini_set('highlight.comment', 'comment');
ini_set('highlight.default', 'default');
ini_set('highlight.keyword', 'keyword');
ini_set('highlight.string',  'string');
ini_set('highlight.html',    'html');

// Highlight PHP code
function highlight_php($code, $return = FALSE)
{
    // Using OB, as highlight_string() only supports
    // returning the result from 4.2.0
    ob_start();
    highlight_string($code);
    $highlighted = ob_get_contents();
    ob_end_clean();

    // This should eventually be a php_syntax_check() call when we move to PHP5
    // But use this ugly hack for now to avoid code snippets with bad syntax screwing up the highlighter
    if(strstr($highlighted,"include/layout.inc</b>")) $highlighted = '<span class="html">'.nl2br(htmlentities($code))."</span>";

    // Fix output to use CSS classes and wrap well
    $highlighted = '<div class="phpcode">' . str_replace(
        array(
            '&nbsp;',
            '<br />',
            '<font color="',        // for PHP 4
            '<span style="color: ', // from PHP 5.0.0RC1
            '</font>',
            "\n ",
            '  ',
            '  '
        ),
        array(
            ' ',
            "<br />\n",
            '<span class="',
            '<span class="',
            '</span>',
            "\n&nbsp;",
            '&nbsp; ',
            '&nbsp; '
        ),
        $highlighted
    ) . '</div>';

    if ($return) { return $highlighted; }
    else { echo $highlighted; }
}

// Stats pages still need this
function commonHeader($title) { site_header($title); }

function site_header($title = '', $config = array())
{
    if (myphpnet_beta()) {
        return site_header_beta($title, $config);
    }
    global $EXPL_LANG, $SIDEBAR_DATA, $RSIDEBAR_DATA, $PAGE_COLUMNS, $PGI;

    // Default to empty array if improper parameter passed
    if (!is_array($config)) { $config = array(); }

    // String defaults
    $lang_input = $canonical = $base = $meta = $layout_helper = '';

    // Count number of columns for layout. The number identifies
    // the layout precisely, as we have no page having a right
    // sidebar and no left sidebar
    $PAGE_COLUMNS = 1;
    if (!empty($SIDEBAR_DATA))  { $PAGE_COLUMNS++; }
    if (!empty($RSIDEBAR_DATA)) { $PAGE_COLUMNS++; }

    // Check which language we are presenting, default to english
    $lang = "en";
    if (isset($config["lang"])) {
        $lang = language_convert($config["lang"]);
    } elseif (isset($PGI, $PGI['head'], $PGI['head'][1])) {
        $lang = language_convert($PGI['head'][1]);
    }

    // Print out lang and charset headers
    if (!isset($config["charset"])) { $config["charset"] = "utf-8"; }
    header("Content-type: text/html;charset={$config['charset']}");
    header("Content-language: {$lang}");
    if (isset($config["generate_modified"]) && $config["generate_modified"]) {
        $timestamp = @filemtime($_SERVER["DOCUMENT_ROOT"] . "/" .$_SERVER["BASE_PAGE"]);
        if ($timestamp) {
            $tsstring = gmdate("D, d M Y H:i:s ", $timestamp) . "GMT";
            header("Last-Modified: " . $tsstring);
        }
    }


    if (isset($config["extra_headers"]) && is_array($config["extra_headers"])) {
        foreach($config["extra_headers"] as $key => $value) {
            header(sprintf("%s: %s", $key, $value));
        }
    }

    if (!empty($title)) { $title = ": $title"; }

    // This page should not be indexed by robots
    if (in_array("noindex", $config)) {
        $meta .= "\n <meta name=\"robots\" content=\"noindex\" />";
    }

    // Set onload handler if required
    $onload = (isset($config['onload']) ? ' onload="' . $config['onload'] . '"' : '');

    // Explicit language setting means that we should put that into the form
    if (isset($EXPL_LANG)) {
        $lang_input = "\n   <input type=\"hidden\" name=\"lang\" value=\"$EXPL_LANG\" />";
    }

    // Link tags
    $link = "";
    if (isset($config['link']) && is_array($config['link'])) {
        foreach($config['link'] as $rel => $url) {
            if (!is_array($url)) {
                $link .= "\n <link rel=\"$rel\" href=\"$url\" />";
            } else {
                $link .= "\n <link ";
                foreach($url as $attr => $val) {
                    $link .= "$attr=\"$val\" ";
                }
                $link .= "/>";
            }
        }
    }

    // Base href setting for URL shortcuts to work
    if (!empty($_SERVER['BASE_HREF'])) {
        $base = "\n <base href=\"{$_SERVER['BASE_HREF']}\" />";
        $canonical = '<link rel="canonical" href="//php.net/' . $_SERVER['BASE_PAGE'] . '" />';
    }

    // Define layout helper in case we need it
    if ($PAGE_COLUMNS > 2) {
        $layout_helper = "<div id=\"layout_{$PAGE_COLUMNS}_helper\">";
    }

    // Choose name of mirror site specific CSS file
    $mirror_specific_style = ($_SERVER['STATIC_ROOT'] ? 'phpnet' : 'mirror');

    // Support for more header tags
    $moreheadtags = '';
    if (isset($config['headtags'])) {
      if (is_array($config['headtags'])) {
        $moreheadtags = "\n " . join("\n ", $config['headtags']);
      } else {
        $moreheadtags = "\n " . ((string)$config['headtags']);
      }
    }
    $classname = "default";
    if(isset($_SERVER['BASE_PAGE'])) {
        $classname = dirname($_SERVER['BASE_PAGE']);
        if(empty($classname)) {
            $classname = "default";
        }
    }

    // Right-to-left support
    $rtl = "";
    /* Does not appear to work... commenting out.
    switch ($lang) {
        case "he":
        case "ar":
            $rtl = ' style="direction: rtl"';
            break;
    }
    */

    // RTL Hack. Edit styles/rtl.css for rtl specific CSS.
    $import_rtl = '';
    if (in_array($lang, array('ar', 'fa', 'he'))) {
        $import_rtl = '@import url("' . $_SERVER['STATIC_ROOT'] . '/styles/rtl.css");';
    }

    $profile = "";
    if (isset($config['profile']) && !empty($config['profile'])) {
        $profile = ' profile="';
        if (is_array($config['profile'])) {
            $profile .= implode(" ", $config['profile']);
        } else {
            $profile .= $config['profile'];
        }
        $profile .= '"';
    }


    print <<<END_HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}">
<head{$profile}>
 <title>PHP{$title}</title>
 <style type="text/css" media="all">
  @import url("{$_SERVER['STATIC_ROOT']}/styles/site.css");
  @import url("{$_SERVER['STATIC_ROOT']}/styles/{$mirror_specific_style}.css");
  $import_rtl
 </style>
 <!--[if IE]><![if gte IE 6]><![endif]-->
  <style type="text/css" media="print">
   @import url("{$_SERVER['STATIC_ROOT']}/styles/print.css");
  </style>
 <!--[if IE]><![endif]><![endif]-->
 <meta http-equiv="Content-Type" content="text/html; charset={$config['charset']}"/>
 <link rel="shortcut icon" href="{$_SERVER['STATIC_ROOT']}/favicon.ico" />{$link}
 $canonical
 <script type="text/javascript" src="{$_SERVER['STATIC_ROOT']}/userprefs.js"></script>{$base}{$meta}{$moreheadtags}
</head>
<body{$onload}>

<div id="head-beta-warning">
  <a id="beta-warning" href="?setbeta=1&amp;beta=1">
    <span class="dismiss">dismiss</span>
    <span class="blurb">Step into the future! Click here to switch to the beta php.net site</span>
  </a>
</div>

<div id="headnav">
 <a href="/" rel="home"><img src="{$_SERVER['STATIC_ROOT']}/images/php.gif"
 alt="PHP" width="120" height="67" id="phplogo" /></a>
 <div id="headmenu">
  <a href="/downloads.php">downloads</a> |
  <a href="/docs.php">documentation</a> |
  <a href="/FAQ.php">faq</a> |
  <a href="/support.php">getting help</a> |
  <a href="/mailing-lists.php">mailing lists</a> |
  <a href="/license">licenses</a> |
  <a href="https://wiki.php.net/">wiki</a> |
  <a href="https://bugs.php.net/">reporting bugs</a> |
  <a href="/sites.php">php.net sites</a> |
  <a href="/conferences/">conferences</a> |
  <a href="/my.php">my php.net</a>
 </div>
</div>

<div id="headsearch">
 <form method="post" action="/search.php" id="topsearch">
  <p>
   <span title="Keyboard shortcut: Alt+S (Win), Ctrl+S (Apple)">
    <span class="shortkey">s</span>earch for
   </span>
   <input type="text" name="pattern" value="" size="30" accesskey="s" title="Search"/>
   <span>in the</span>
   <select name="show">
    <option value="all"      >all php.net sites</option>
    <option value="local"    >this mirror only</option>
    <option value="quickref" selected="selected">function list</option>
    <option value="manual"   >online documentation</option>
    <option value="bugdb"    >bug database</option>
    <option value="news_archive">Site News Archive</option>
    <option value="changelogs">All Changelogs</option>
    <option value="pear"     >just pear.php.net</option>
    <option value="pecl"     >just pecl.php.net</option>
    <option value="talks"    >just talks.php.net</option>
    <option value="maillist" >general mailing list</option>
    <option value="devlist"  >developer mailing list</option>
    <option value="phpdoc"   >documentation mailing list</option>
   </select>
   <input type="image"
          src="{$_SERVER['STATIC_ROOT']}/images/small_submit_white.gif"
          class="submit" alt="search" />{$lang_input}
  </p>
 </form>
</div>

<div id="layout_{$PAGE_COLUMNS}">{$layout_helper}
END_HEADER;

    // Print out left column
    if ($PAGE_COLUMNS > 1) {
        echo "\n <div id=\"leftbar\">\n$SIDEBAR_DATA\n </div>";
    }

    // Print out right column
    if ($PAGE_COLUMNS > 2) {
        echo "\n <div id=\"rightbar\">\n$RSIDEBAR_DATA\n </div>";
    }

    // Any layout workarounds?
    if (!empty($config["layout_workaround"])) {
        echo $config["layout_workaround"];
    }

    // Start main page content
    echo "\n <div id=\"content\" class=\"$classname\"{$rtl}>\n";
}

// Stats pages still need this
function commonFooter() { site_footer(); }

function site_footer($config = array())
{
    if (myphpnet_beta()) {
        return site_footer_beta($config);
    }
    global $LAST_UPDATED, $PAGE_COLUMNS;

    $stats         = (have_stats() ? "\n <a href=\"/stats/\">stats</a> |" : "");
    $rsslink       = (isset($config["rss"]) ?
        "<a href=\"{$config["rss"]}\">RSS</a> |" :
        "");
    $atomlink      = (isset($config["atom"]) ?
        "<a href=\"{$config["atom"]}\">Atom</a> |" :
        "");
    $viewsource    = (isset($_SERVER['BASE_PAGE']) ?
        "<a href=\"/source.php?url=/{$_SERVER['BASE_PAGE']}\">show source</a> |" :
        "");
    $provider_url  = mirror_provider_url();
    $provider_name = mirror_provider();
    $mirror_text   = (is_official_mirror() ?
        "<a href=\"/mirror.php\">This mirror</a> generously provided by:" :
        "<a href=\"/mirror.php\">This unofficial mirror</a> is operated at:");
    $last_updated  = strftime("%c %Z", $LAST_UPDATED);
    $layout_helper = ($PAGE_COLUMNS > 2 ? "</div>" : "");
    //$functionsjs   = (in_array("functionsjs", $config) ? "\n<script src=\"" . $_SERVER['STATIC_ROOT'] . '/functions.js" type="text/javascript"></script>' : '');

    // Automate the Copyright year
    $current_year = date('Y');

    print <<<END_FOOTER

 </div>
 <div class="cleaner">&nbsp;</div>
{$layout_helper}</div>

<div id="footnav">
 $rsslink $atomlink $viewsource
 <a href="/credits.php">credits</a> |$stats
 <a href="/sitemap.php">sitemap</a> |
 <a href="/contact.php">contact</a> |
 <a href="/contact.php#ads">advertising</a> |
 <a href="/mirrors.php">mirror sites</a>
</div>

<div id="pagefooter">
 <div id="copyright">
  <a href="/copyright.php">Copyright &copy; 2001-{$current_year} The PHP Group</a><br />
  All rights reserved.
 </div>

 <div id="thismirror">
  {$mirror_text}
  <a href="{$provider_url}">{$provider_name}</a><br />
  Last updated: {$last_updated}
 </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    function showBetaWarning() {
        return document.cookie.indexOf("BetaWarning=") == -1;
    }

    // ----- BETA WARNING CODE -----
    var headBetaWarning = $('#head-beta-warning');

    // Wire up the beta warning.
    headBetaWarning.find('.dismiss').click(function(e) {
        e.preventDefault();
        $('body').css('margin-top', 0);
        headBetaWarning.slideUp("fast");

        // Hide it for a month by default.
        var expiry = new Date();
        expiry.setTime(expiry.getTime() + (30 * 24 * 60 * 60 * 1000));

        document.cookie = "BetaWarning=off; expires=" + expiry.toGMTString() + "; path=/";
    });

    if (showBetaWarning()) {
        headBetaWarning.show();
        $('body').css('margin-top', '25px');
        $('#beta-warning').slideDown(300, function() {
           $(this).find('.blurb').fadeIn('slow');
        });
    }

});
</script>

<!--[if IE 6]>
<script type="text/javascript">
    var IE6UPDATE_OPTIONS = {
        icons_path: "/ie6update/images/"
    }
</script>
<script type="text/javascript" src="/ie6update/ie6update.js"></script>
<![endif]-->

</body>
</html>
END_FOOTER;
}

// Resize the image using the output of make_image()
// (considering possible HTML/XHTML image tag endings)
function resize_image($img, $width = 1, $height = 1)
{
    // Drop width and height values from image if available
    $str = preg_replace('!width=\"([0-9]+?)\"!i',  '', $img);
    $str = preg_replace('!height=\"([0-9]+?)\"!i', '', $str);

    // Return image with new width and height added
    return preg_replace(
        '!/?>$!',
        sprintf(' height="%s" width="%s" />', $height, $width),
        $str
    );
}

// Return an <img /> tag for a given image file available on the server
function make_image($file, $alt = FALSE, $align = FALSE, $extras = FALSE,
                    $dir = '/images', $border = 0, $addsize = TRUE)
{
    // If no / was provided at the start of $dir, add it
    $webdir = $_SERVER['STATIC_ROOT'] . ($dir{0} == '/' ? '' : '/') . $dir;

    // Get width and height values if possible
    if ($addsize && ($size = @getimagesize($_SERVER['DOCUMENT_ROOT'] . "$dir/$file"))) {
        $sizeparams = ' ' . trim($size[3]);
    } else {
        $sizeparams = '';
    }

    // Convert right or left alignment to CSS float,
    // but leave other alignments intact (for now)
    if (in_array($align, array("right", "left"))) {
        $align = ' style="float: ' . $align . ';"';
    } elseif ($align) {
        $align = ' align="' . $align . '"';
    } else {
        $align = '';
    }

    // Return with image built up
    return sprintf('<img src="%s/%s" alt="%s"%s%s%s />',
        $webdir,
        $file,
        ($alt    ? $alt : ''),
        $sizeparams,
        $align,
        ($extras ? ' ' . $extras              : '')
    );
}

// Print an <img /> tag out for a given file
function print_image($file, $alt = FALSE, $align = FALSE, $extras = FALSE,
                     $dir = '/images', $border = 0)
{
    echo make_image($file, $alt, $align, $extras, $dir, $border);
}

// Shortcut to usual news image printing (right floating
// image from the news dir with an alt and an URL)
function news_image($URL, $image, $alt, $print = true)
{
    $str = "<a href=\"$URL\">" . make_image("news/$image", $alt, "right") . "</a>";
    if ($print) {
        echo $str;
    }
    return $str;
}

// Return HTML code for a submit button image
function make_submit($file, $alt = FALSE, $align = FALSE, $extras = FALSE,
                     $dir = '/images', $border = 0)
{
    // Get an image without size info and convert the
    // border attribute to use CSS, as border="" is not
    // supported on <input> elements in [X]HTML
    $img = make_image($file, $alt, $align, $extras, $dir, 0, FALSE);
    $img = str_replace(
        "border=\"$border\"",
        "style=\"border: {$border}px;\"",
        $img
    );

    // Return with ready input image
    return '<input type="image"' . substr($img, 4);
}

// Return a hiperlink to something within the site
function make_link ($url, $linktext = FALSE, $target = FALSE, $extras = FALSE)
{
    return sprintf("<a href=\"%s\"%s%s>%s</a>",
        $url,
        ($target   ? ' target="' . $target . '"' : ''),
        ($extras   ? ' ' . $extras               : ''),
        ($linktext ? $linktext                   : $url)
    );
}

// Print a hyperlink to something, within the site
function print_link($url, $linktext = FALSE, $target = FALSE, $extras = FALSE)
{
    echo make_link($url, $linktext, $target, $extras);
}

// make_popup_link()
// return a hyperlink to something, within the site, that pops up a new window
//
function make_popup_link ($url, $linktext=false, $target=false, $windowprops="", $extras=false) {
    return sprintf("<a href=\"%s\" target=\"%s\" onclick=\"window.open('%s','%s','%s');return false;\"%s>%s</a>",
        htmlspecialchars($url, ENT_QUOTES | ENT_IGNORE),
        ($target ? $target : "_new"),
        htmlspecialchars($url, ENT_QUOTES | ENT_IGNORE),
        ($target ? $target : "_new"),
                $windowprops,
        ($extras ? ' '.$extras : ''),
        ($linktext ? $linktext : $url)
    );
}

// print_popup_link()
// print a hyperlink to something, within the site, that pops up a new window
//
function print_popup_link($url, $linktext=false, $windowprops="", $target=false, $extras=false) {
    echo make_popup_link($url, $linktext, $windowprops, $target, $extras);
}

// Print a link for a downloadable file (including filesize)
function download_link($file, $title, $showsize = TRUE, $mirror = '')
{
    // Construct the download link for this site or a mirror site
    $download_link = "get/$file/from/a/mirror";
    if ($mirror != '') {
        $download_link = $mirror . $download_link;
    } else {
        $download_link = "/" . $download_link;
    }

    // Print out the download link
    print_link($download_link, $title);

    // Size display is required
    if ($showsize) {

        // We have a full path or a relative to the distributions dir
        if ($tmp = strrchr($file, "/")) {
            $local_file = substr($tmp, 1, strlen($tmp));
        } else {
            $local_file = "distributions/$file";
        }

        // Try to get the size of the file
        $size = @filesize($local_file);

        // Print out size in bytes (if size is
        // less then 1Kb, or else in Kb)
        if ($size) {
            echo ' [';
            if ($size < 1024) {
                echo number_format($size, 0, '.', ',') . 'b';
            } else {
                echo number_format($size/1024, 0, '.', ',') . 'Kb';
            }
            echo ']';
        }
    }
}

function sect_to_file($string) {
    $string = strtolower($string);
    $string = str_replace(' ','-',$string);
    $string = str_replace('_','-',$string);
    $func = "function.$string.php";
    $chap = "ref.$string.php";
    $feat = "features.$string.php";
    $struct = "control-structures.$string.php";
    if(@is_file($func)) return $func;
    else if(@is_file($chap)) return $chap;
    else if(@is_file($feat)) return $feat;
    else if(@is_file($struct)) return $struct;
    else return "$string.php";
}

function clean($var) {
  return htmlspecialchars(get_magic_quotes_gpc() ? stripslashes($var) : $var, ENT_QUOTES);
}

// Clean out the content of one user note for printing to HTML
function clean_note($text)
{
    // Highlight PHP source
    $text = highlight_php(trim($text), TRUE);

    // Turn urls into links
    $text = preg_replace(
        '!((mailto:|(http|ftp|nntp|news):\/\/).*?)(\s|<|\)|"|\\\\|\'|$)!',
        '<a href="\1" rel="nofollow" target="_blank">\1</a>\4',
        $text
    );

    return $text;
}

function display_errors($errors)
{
    echo '<div class="errors">';
    if (count($errors) > 1) {
        echo "You need to do the following before your submission will be accepted:<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>\n";
        }
        echo "</ul>";
    }
    else {
        echo $errors[0];
    }
    echo '</div>';
}

// Displays an event. Used in event submission
// previews and event information displays
function display_event($event, $include_date = 1)
{
    global $COUNTRIES;
    // Current month (int)($_GET['cm'] ?: 0)
    global $cm;
    // Current year (int)($_GET['cy'] ?: 0)
    global $cy;

    // Weekday names array
    for ($i = 1; $i <= 7; $i++) {
        $days[$i] = strftime('%A', mktime(12, 0, 0, 4, $i));
    }

    // Recurring possibilities
    $re = array(
         1 => 'First',
         2 => 'Second',
         3 => 'Third',
         4 => 'Fourth',
        -1 => 'Last',
        -2 => '2nd Last',
        -3 => '3rd Last'
    );

    if (!isset($event['start']) && isset($event['sday'])) {
        $sday = mktime(12,0,0,$event['smonth'],$event['sday'],$event['syear']);
    } else {
        $sday = (isset($event['start']) && !empty($event['start'])) ? strtotime($event['start']) : 0;
    }

    if (!isset($event['end']) && isset($event['eday'])) {
        $eday = mktime(12,0,0,$event['emonth'],$event['eday'],$event['eyear']);
    } else {
        $eday = (isset($event['end']) && !empty($event['end'])) ? strtotime($event['end']) : 0;
    }
?>
<table border="0" cellspacing="0" cellpadding="3" width="100%" class="vevent">
 <tr bgcolor="#dddddd"><td>
<?php

    // Print out date if needed
    if ($include_date && (isset($event['start']))) {
        echo "<b>", date("F j, Y", $sday), "</b>\n";
    }

    // Print link in case we have one
    if ($event['url']) { echo '<a href="', htmlentities($event['url'], ENT_QUOTES | ENT_IGNORE, 'UTF-8'),'" class="url">'; }
    // Print event description
    echo "<b class='summary'>", stripslashes(htmlentities($event['sdesc'], ENT_QUOTES | ENT_IGNORE, 'UTF-8')), "</b>";
    // End link
    if ($event['url']) { echo "</a>"; }

    // Print extra date info for recurring and multiday events
    switch ($event['type']) {
        case 2:
        case 'multi':
            $dtend = date("Y-m-d", strtotime("+1 day", $eday));
            echo " (<abbr class='dtstart'>", date("Y-m-d",$sday), "</abbr> to <abbr class='dtend' title='$dtend'>", date("Y-m-d",$eday), "</abbr>)";
            break;
        case 3:
        case 'recur':
            $days = $re[$event['recur']]. " " .$days[$event['recur_day']];
            if (!$cm || $cy) {
                $cm = date("m");
                $cy = date("Y");
            }
            $month = date("M", mktime(0, 0, 0, $cm, 1, $cy));
            $dtstart = date("Y-m-d", strtotime($days . ' 0st' .$month. ' ' .$cy));
            echo ' (Every <abbr class="dtstart" title="'.$dtstart.'">', $days, "</abbr> of the month)";
            break;
    }

    // Event category
    if(isset($event['category']) && $event['category']) {
        $cat = array("unknown", "User Group Event", "Conference", "Training");
        echo ' [' . $cat[$event['category']] . '] ';
    }

    // Print out country information
    echo ' (<span class="location">' , $COUNTRIES[$event['country']] , '</span>)';
?>
</td></tr>
 <tr bgcolor="#eeeeee" class="description"><td>
<?php

    // Print long description
    echo preg_replace("/\r?\n\r?\n/", "<br /><br />", trim(htmlentities($event['ldesc'],ENT_QUOTES | ENT_IGNORE, 'UTF-8')));
    // If we have an URL, print it out
    if ($event['url']) {
        echo '<br /><br /><b>URL:</b> ',
             '<a href="', htmlentities($event['url'], ENT_QUOTES | ENT_IGNORE, 'UTF-8'), '">',
             htmlentities($event['url'], ENT_QUOTES | ENT_IGNORE, 'UTF-8'), '</a>';
    }
?>
</td></tr>
</table>
<?php
}

/**
 * Print a view
 *
 * @param string $templateName
 * @param array $params
 * @return void
 */
function print_view($templateName, array $params = array()) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/views/' . $templateName;
    if(file_exists($path)) {
        if(!empty($params)) {
            extract($params);
        }
        include_once $path;
    }
}

// Print news links for archives
function news_archive_sidebar()
{
    global $SIDEBAR_DATA;
    $SIDEBAR_DATA = '
<h3>Latest news</h3>

<p>
 For the latest news, <a href="/index.php" rel="home">check the homepage</a>,
 or <a href="/feed.atom">our Atom feed</a>.
</p>

<h3>Archives by year</h3>

<ul class="toc">
';
    for ($i = date("Y"); $i >= 1998; $i--) {
        $pagename = "archive/$i.php";
        $classname = ($pagename == $_SERVER['BASE_PAGE'] ? ' class="active"' : '');
        $SIDEBAR_DATA .= "<li{$classname}><a href=\"/{$pagename}\">{$i}</a></li>\n";
    }
    $SIDEBAR_DATA .= '</ul>';
}

// Print news
function print_news($news, $dog, $max = 5, $onlyyear = null, $return = false) {
    $retval = array();
    $count = 0;
    $news = $news ? $news : array(); // default to empty array (if no news)
    foreach($news as $item) {
        $vevent = "";
        $ok = false;

        // Only print entries in the provided s/dog/cat/ egory
        // If its a conference, use the hCalendar container
        foreach($item["category"] as $category) {
            if (in_array($category["term"], (array)$dog)) {
                $ok = true;
                ++$count;
            }
            if ($category["term"] === "conferences" || $category["term"] === "cfp") {
                $vevent = " vevent";
            }
        }
        if ($count > $max) {
            break;
        }
        if ($ok === false) {
            continue;
        }

        $image = "";
        if(isset($item["newsImage"])) {
            $image = news_image($item["newsImage"]["link"], $item["newsImage"]["content"], $item["newsImage"]["title"], false);
        }

        //$id = parse_url($item["id"], PHP_URL_FRAGMENT); 5.1.2
        $id = parse_url($item["id"]);
        $id = $id["fragment"];

        // Find the permlink
        foreach($item["link"] as $link) {
            if ($link["rel"] === "via") {
                $permlink = $link["href"];
                break;
            }
        }
        if (!isset($permlink)) {
            $permlink = "#" .$id;
        }

        // PHP4 strtotime() doesn't support RFC3339 timestamps
        $published = substr($item["published"], 0, 10);
        $nixtimestamp = strtotime($published);
        $newsdate = date("d-M-Y", $nixtimestamp);
        if ($onlyyear && date("Y", $nixtimestamp) != $onlyyear) {
            $count--;
            continue;
        }

        if ($return) {
            $retval[] = array(
                "title" => $item["title"],
                "id"    => $id,
                "permlink" => $permlink,
                "date"     => $newsdate,
            );
            continue;
        }

        echo <<< EOT
<div class="newsItem hentry{$vevent}">
    <div class="newsImage">{$image}</div>
    <h2 class="summary entry-title"><a name="{$id}" id="{$id}" href="{$permlink}" rel="bookmark" class="bookmark">{$item["title"]}</a></h2>
    <div class="entry-content description">
        <abbr class="published newsdate" title="{$item["published"]}">{$newsdate}</abbr>
        {$item["content"]}
    </div>
</div>

EOT;
    }

    return $retval;
}




// BETA
function site_header_beta($title = '', $config = array())
{
    global $SIDEBAR_DATA;
    global $MYSITE;

    $defaults = array(
        "lang" => myphpnet_language(),
        "current" => "",
        "meta-navigation" => array(),
        'classes' => '',
        'layout_span' => 9,
    );

    $config = array_merge($defaults, $config);

    $lang = language_convert($config["lang"]);
    $curr = $config["current"];
    $classes = $config['classes'];

    if (empty($title)) {
        $title = "Hypertext Preprocessor";
    }

    // shorturl; http://wiki.snaplog.com/short_url
    if (isset($_SERVER['BASE_PAGE']) && $shortname = get_shortname($_SERVER["BASE_PAGE"])) {
        $shorturl = "http://php.net/" . $shortname;
    }

    // For static content
    // FIXME: How does static.php.net work? Will it get the /js/ folders?
    if (false && ($MYSITE == "http://www.php.net/" || $MYSITE == 'http://php.net/')) {
        $STATIC_ROOT = "http://static.php.net/www.php.net/";
    } elseif (false && !empty($_SERVER["STATIC_ROOT"])) {
        $STATIC_ROOT = $_SERVER["STATIC_ROOT"];
    } else {
        $STATIC_ROOT = "/";
    }

    require dirname(__FILE__) ."/header.inc";
}
function site_footer_beta($config = array())
{
    require dirname(__FILE__) . "/footer.inc";
}

function news_toc($sections = null) {
    include dirname(__FILE__) . "/pregen-news.inc";
    $items = array(
        "news" => array(
            "title" => "News",
            "link"  => "/archive/",
            "children" => print_news($NEWS_ENTRIES, "frontpage", 3, null, true),
        ),
        "conferences" => array(
            "title" => "Conferences",
            "link"  => "/conferences/",
            "children" => print_news($NEWS_ENTRIES, "conferences", 3, null, true),
        ),
        "papers" => array(
            "title" => "Call for Papers",
            "link"  => "/conferences/",
            "children" => print_news($NEWS_ENTRIES, "cfp", 3, null, true),
        ),
    );

    foreach($items as $section => $menu) {

        // only print requested sections.
        if (is_array($sections) && !in_array($section, $sections)) {
            continue;
        }

        echo "<dt><a href='{$menu["link"]}'>{$menu["title"]}</a></dt>\n";
        foreach($menu["children"] as $child) {
            echo "<dd><a href='{$child["permlink"]}'>{$child["title"]}</a></dd>\n";
        }
    }
}
function doc_toc($lang) {
    $file = dirname(__FILE__) . "/../manual/$lang/toc/index.inc";
    if (!file_exists($file)) {
        $lang = "en"; // Fallback on english if the translation doesn't exist
        $file = dirname(__FILE__) . "/../manual/en/toc/index.inc";
    }
    require dirname(__FILE__) . "/../manual/$lang/toc/index.inc";

?>
    <dl>
        <dt><a href="/manual/">PHP Manual</a></dt>
        <?php doc_toc_list($lang, $TOC, 'getting-started'); ?>
        <?php doc_toc_title($lang, $TOC, 'install', 'dd'); ?>
    </dl>

    <dl>
        <?php doc_toc_title($lang, $TOC, 'langref'); ?>
        <?php doc_sub_entry($lang, 'langref', 'language.basic-syntax'); ?>
        <?php doc_sub_entry($lang, 'langref', 'language.variables'); ?>
        <?php doc_sub_entry($lang, 'langref', 'language.operators'); ?>
        <?php doc_sub_entry($lang, 'langref', 'language.functions'); ?>
        <?php doc_sub_entry($lang, 'langref', 'language.oop5'); ?>
    </dl>

    <dl>
        <?php doc_toc_title($lang, $TOC, 'funcref'); ?>
        <?php doc_sub_entry($lang, 'refs.basic.vartype', 'book.array'); ?>
        <?php doc_sub_entry($lang, 'refs.calendar', 'book.datetime'); ?>
        <?php doc_sub_entry($lang, 'refs.basic.text', 'book.strings'); ?>
        <?php doc_toc_title($lang, $TOC, 'faq'); ?>
    </dl>

    <dl>
        <?php doc_toc_title($lang, $TOC, 'security'); ?>
        <?php doc_sub_entry($lang, 'security', 'security.database'); ?>
        <?php doc_sub_entry($lang, 'security', 'security.variables'); ?>
        <?php doc_sub_entry($lang, 'faq', 'faq.passwords'); ?>
        <?php doc_toc_title($lang, $TOC, 'appendices'); ?>
    </dl>
<?php
}
function doc_sub_entry($lang, $file, $subfile, $elm = "dd") {
    static $cache = array();

    if (isset($cache["$lang.$file"])) {
        $TOC = $cache["$lang.$file"];
    } else {
        include dirname(__FILE__) . "/../manual/$lang/toc/$file.inc";
    }

    foreach($TOC as $entry) {
        if (substr($entry[0], 0, strlen($subfile)) == $subfile) {
            echo "\t<$elm><a href='/manual/$lang/{$entry[0]}'>{$entry[1]}</a></$elm>\n";
        }
    }
}
function doc_toc_list($lang, $index, $file) {
    include dirname(__FILE__) . "/../manual/$lang/toc/$file.inc";

    doc_toc_title($lang, $index, $file);
    foreach($TOC as $entry) {
        echo "\t<dd><a href='/manual/$lang/{$entry[0]}'>{$entry[1]}</a></dd>\n";
    }
}
function doc_toc_title($lang, $index, $file, $elm = "dt") {
    foreach($index as $entry) {
        if ($entry[0] == "$file.php") {
            $link  = $entry[0];
            $title = $entry[1];
            break;
        }
    }
    echo "<$elm><a href='/manual/$lang/$link'>$title</a></$elm>\n";
}






/* vim: set et ts=4 sw=4 ft=php: : */
