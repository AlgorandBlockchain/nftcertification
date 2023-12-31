<?php
include_once 'shared-manual.inc';
$TOC = array();
$PARENTS = array();
include_once dirname(__FILE__) ."/toc/book.intl.inc";
$setup = array (
  'home' =>
  array (
    0 => 'index.php',
    1 => 'PHP Manual',
  ),
  'head' =>
  array (
    0 => 'UTF-8',
    1 => 'zh',
  ),
  'this' =>
  array (
    0 => 'class.numberformatter.php',
    1 => 'NumberFormatter',
  ),
  'up' =>
  array (
    0 => 'book.intl.php',
    1 => 'intl',
  ),
  'prev' =>
  array (
    0 => 'collator.sort.php',
    1 => 'Collator::sort',
  ),
  'next' =>
  array (
    0 => 'numberformatter.create.php',
    1 => 'NumberFormatter::create',
  ),
  'alternatives' =>
  array (
  ),
  'extra_header_links' =>
  array (
    'rel' => 'alternate',
    'href' => '/manual/en/feeds/class.numberformatter.atom',
    'type' => 'application/atom+xml',
  ),
);
$setup["toc"] = $TOC;
$setup["parents"] = $PARENTS;
manual_setup($setup);

manual_header();
?>
<div id="class.numberformatter" class="reference">
 <h1 class="title">The NumberFormatter class</h1>


 <div class="partintro"><p class="verinfo">(PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)</p>


  <div class="section" id="numberformatter.intro">
   <h2 class="title">ç®€ä»‹</h2>
   <p class="simpara">
    Programs store and operate on numbers using a locale-independent binary
    representation. When displaying or printing a number it is converted to a
    locale-specific string. For example, the number 12345.67 is &quot;12,345.67&quot; in
    the US, &quot;12 345,67&quot; in France and &quot;12.345,67&quot; in Germany.
   </p>
   <p class="simpara">
    By invoking the methods provided by the NumberFormatter class, you can
    format numbers, currencies, and percentages according to the specified or
    default locale. NumberFormatter is locale-sensitive so you need to create
    a new NumberFormatter for each locale. NumberFormatter methods format
    primitive-type numbers, such as double and output the number as a
    locale-specific string.
   </p>
   <p class="para">
    For currencies you can use currency format type to create a formatter that
    returns a string with the formatted number and the appropriate currency
    sign. Of course, the NumberFormatter class is unaware of exchange rates
    so, the number output is the same regardless of the specified currency.
    This means that the same number has different monetary values depending on
    the currency locale. If the number is 9988776.65 the results will be:
    <ul class="simplelist">
     <li class="member">9 988 776,65 â‚¬ in France</li>
     <li class="member">9.988.776,65 â‚¬ in Germany</li>
     <li class="member">$9,988,776.65 in the United States</li>
    </ul>
   </p>
   <p class="simpara">
    In order to format percentages, create a locale-specific formatter with
    percentage format type. With this formatter, a decimal fraction such as
    0.75 is displayed as 75%.
   </p>
   <p class="simpara">
    For more complex formatting, like spelled-out numbers, the rule-based
    number formatters are used.
   </p>
  </div>


  <div class="section" id="numberformatter.synopsis">
   <h2 class="title">ç±»æ‘˜è¦</h2>


   <div class="classsynopsis">
    <div class="ooclass">

    </div>


    <div class="classsynopsisinfo">
     <span class="ooclass">
      <strong class="classname">NumberFormatter</strong>
     </span>
     {</div>




    <div class="classsynopsisinfo classsynopsisinfo_comment">/* æ–¹æ³• */</div>
    <div class="constructorsynopsis dc-description">
    <span class="modifier">public</span>
     <span class="methodname"><a href="numberformatter.create.php" class="methodname">__construct</a></span>
     ( <span class="methodparam"><span class="type">string</span> <code class="parameter">$locale</code></span>
    , <span class="methodparam"><span class="type">int</span> <code class="parameter">$style</code></span>
    [, <span class="methodparam"><span class="type">string</span> <code class="parameter">$pattern</code></span>
   ] )</div>

    <div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="modifier">static</span>
   <span class="type">NumberFormatter</span>
    <span class="methodname"><a href="numberformatter.create.php" class="methodname">create</a></span>
    ( <span class="methodparam"><span class="type">string</span> <code class="parameter">$locale</code></span>
   , <span class="methodparam"><span class="type">int</span> <code class="parameter">$style</code></span>
   [, <span class="methodparam"><span class="type">string</span> <code class="parameter">$pattern</code></span>
  ] )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.formatcurrency.php" class="methodname">formatCurrency</a></span>
    ( <span class="methodparam"><span class="type">float</span> <code class="parameter">$value</code></span>
   , <span class="methodparam"><span class="type">string</span> <code class="parameter">$currency</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.format.php" class="methodname">format</a></span>
    ( <span class="methodparam"><span class="type"><a href="language.pseudo-types.php#language.types.number" class="type number">number</a></span> <code class="parameter">$value</code></span>
   [, <span class="methodparam"><span class="type">int</span> <code class="parameter">$type</code></span>
  ] )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">int</span>
    <span class="methodname"><a href="numberformatter.getattribute.php" class="methodname">getAttribute</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">int</span>
    <span class="methodname"><a href="numberformatter.geterrorcode.php" class="methodname">getErrorCode</a></span>
    ( <span class="methodparam">void</span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.geterrormessage.php" class="methodname">getErrorMessage</a></span>
    ( <span class="methodparam">void</span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.getlocale.php" class="methodname">getLocale</a></span>
    ([ <span class="methodparam"><span class="type">int</span> <code class="parameter">$type</code></span>
  ] )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.getpattern.php" class="methodname">getPattern</a></span>
    ( <span class="methodparam">void</span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.getsymbol.php" class="methodname">getSymbol</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">string</span>
    <span class="methodname"><a href="numberformatter.gettextattribute.php" class="methodname">getTextAttribute</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">float</span>
    <span class="methodname"><a href="numberformatter.parsecurrency.php" class="methodname">parseCurrency</a></span>
    ( <span class="methodparam"><span class="type">string</span> <code class="parameter">$value</code></span>
   , <span class="methodparam"><span class="type">string</span> <code class="parameter reference">&$currency</code></span>
   [, <span class="methodparam"><span class="type">int</span> <code class="parameter reference">&$position</code></span>
  ] )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">mixed</span>
    <span class="methodname"><a href="numberformatter.parse.php" class="methodname">parse</a></span>
    ( <span class="methodparam"><span class="type">string</span> <code class="parameter">$value</code></span>
   [, <span class="methodparam"><span class="type">int</span> <code class="parameter">$type</code></span>
   [, <span class="methodparam"><span class="type">int</span> <code class="parameter reference">&$position</code></span>
  ]] )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">bool</span>
    <span class="methodname"><a href="numberformatter.setattribute.php" class="methodname">setAttribute</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   , <span class="methodparam"><span class="type">int</span> <code class="parameter">$value</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">bool</span>
    <span class="methodname"><a href="numberformatter.setpattern.php" class="methodname">setPattern</a></span>
    ( <span class="methodparam"><span class="type">string</span> <code class="parameter">$pattern</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">bool</span>
    <span class="methodname"><a href="numberformatter.setsymbol.php" class="methodname">setSymbol</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   , <span class="methodparam"><span class="type">string</span> <code class="parameter">$value</code></span>
   )</div>
<div class="methodsynopsis dc-description">
   <span class="modifier">public</span>
   <span class="type">bool</span>
    <span class="methodname"><a href="numberformatter.settextattribute.php" class="methodname">setTextAttribute</a></span>
    ( <span class="methodparam"><span class="type">int</span> <code class="parameter">$attr</code></span>
   , <span class="methodparam"><span class="type">string</span> <code class="parameter">$value</code></span>
   )</div>


   }</div>


  </div>





<div class="section" id="intl.numberformatter-constants">
 <h2 class="title">é¢„å®šä¹‰å¸¸é‡</h2>

 <div class="section" id="intl.numberformatter-constants.unumberformatstyle">
  <p class="para">
   These styles are used by the  <span class="function"><a href="numberformatter.create.php" class="function">numfmt_create()</a></span>
   to define the type of the formatter.
   <dl>

    <dt id="numberformatter.constants.pattern-decimal">
     <span class="term">
      <strong><code>NumberFormatter::PATTERN_DECIMAL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Decimal format defined by pattern</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.decimal">
     <span class="term">
      <strong><code>NumberFormatter::DECIMAL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Decimal format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.currency">
     <span class="term">
      <strong><code>NumberFormatter::CURRENCY</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Currency format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.percent">
     <span class="term">
      <strong><code>NumberFormatter::PERCENT</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Percent format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.scientific">
     <span class="term">
      <strong><code>NumberFormatter::SCIENTIFIC</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Scientific format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.spellout">
     <span class="term">
      <strong><code>NumberFormatter::SPELLOUT</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Spellout rule-based format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.ordinal">
     <span class="term">
      <strong><code>NumberFormatter::ORDINAL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Ordinal rule-based format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.duration">
     <span class="term">
      <strong><code>NumberFormatter::DURATION</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Duration rule-based format</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pattern-rulebased">
     <span class="term">
      <strong><code>NumberFormatter::PATTERN_RULEBASED</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rule-based format defined by pattern</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.default-style">
     <span class="term">
      <strong><code>NumberFormatter::DEFAULT_STYLE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Default format for the locale</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.ignore">
     <span class="term">
      <strong><code>NumberFormatter::IGNORE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Alias for PATTERN_DECIMAL</span>
     </dd>

    </dt>

   </dl>






  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.types">
  <p class="para">
   These constants define how the numbers are parsed or formatted. They should
   be used as arguments to  <span class="function"><a href="numberformatter.format.php" class="function">numfmt_format()</a></span>
   and  <span class="function"><a href="numberformatter.parse.php" class="function">numfmt_parse()</a></span>.
   <dl>

    <dt id="numberformatter.constants.type-default">
     <span class="term">
      <strong><code>NumberFormatter::TYPE_DEFAULT</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Derive the type from variable type</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.type-int32">
     <span class="term">
      <strong><code>NumberFormatter::TYPE_INT32</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Format/parse as 32-bit integer</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.type-int64">
     <span class="term">
      <strong><code>NumberFormatter::TYPE_INT64</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Format/parse as 64-bit integer</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.type-double">
     <span class="term">
      <strong><code>NumberFormatter::TYPE_DOUBLE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Format/parse as floating point value</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.type-currency">
     <span class="term">
      <strong><code>NumberFormatter::TYPE_CURRENCY</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Format/parse as currency value</span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.unumberformatattribute">
  <p class="para">
   Number format attribute used by
    <span class="function"><a href="numberformatter.getattribute.php" class="function">numfmt_get_attribute()</a></span>
   and
    <span class="function"><a href="numberformatter.setattribute.php" class="function">numfmt_set_attribute()</a></span>.
   <dl>

    <dt id="numberformatter.constants.parse-int-only">
     <span class="term">
      <strong><code>NumberFormatter::PARSE_INT_ONLY</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Parse integers only.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.grouping-used">
     <span class="term">
      <strong><code>NumberFormatter::GROUPING_USED</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Use grouping separator.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.decimal-always-shown">
     <span class="term">
      <strong><code>NumberFormatter::DECIMAL_ALWAYS_SHOWN</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Always show decimal point.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.max-integer-digits">
     <span class="term">
      <strong><code>NumberFormatter::MAX_INTEGER_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Maximum integer digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.min-integer-digits">
     <span class="term">
      <strong><code>NumberFormatter::MIN_INTEGER_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Minimum integer digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.integer-digits">
     <span class="term">
      <strong><code>NumberFormatter::INTEGER_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Integer digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.max-fraction-digits">
     <span class="term">
      <strong><code>NumberFormatter::MAX_FRACTION_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Maximum fraction digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.min-fraction-digits">
     <span class="term">
      <strong><code>NumberFormatter::MIN_FRACTION_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Minimum fraction digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.fraction-digits">
     <span class="term">
      <strong><code>NumberFormatter::FRACTION_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Fraction digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.multiplier">
     <span class="term">
      <strong><code>NumberFormatter::MULTIPLIER</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Multiplier.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.grouping-size">
     <span class="term">
      <strong><code>NumberFormatter::GROUPING_SIZE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Grouping size.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.rounding-mode">
     <span class="term">
      <strong><code>NumberFormatter::ROUNDING_MODE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding Mode.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.rounding-increment">
     <span class="term">
      <strong><code>NumberFormatter::ROUNDING_INCREMENT</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding increment.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.format-width">
     <span class="term">
      <strong><code>NumberFormatter::FORMAT_WIDTH</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The width to which the output of format() is padded.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.padding-position">
     <span class="term">
      <strong><code>NumberFormatter::PADDING_POSITION</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       The position at which padding will take place. See pad position
       constants for possible argument values.
      </span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.secondary-grouping-size">
     <span class="term">
      <strong><code>NumberFormatter::SECONDARY_GROUPING_SIZE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Secondary grouping size.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.significant-digits-used">
     <span class="term">
      <strong><code>NumberFormatter::SIGNIFICANT_DIGITS_USED</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Use significant digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.min-significant-digits">
     <span class="term">
      <strong><code>NumberFormatter::MIN_SIGNIFICANT_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Minimum significant digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.max-significant-digits">
     <span class="term">
      <strong><code>NumberFormatter::MAX_SIGNIFICANT_DIGITS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Maximum significant digits.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.lenient-parse">
     <span class="term">
      <strong><code>NumberFormatter::LENIENT_PARSE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Lenient parse mode used by rule-based formats.</span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.unumberformattextattribute">
  <p class="para">
   Number format text attribute used by
    <span class="function"><a href="numberformatter.gettextattribute.php" class="function">numfmt_get_text_attribute()</a></span> and
    <span class="function"><a href="numberformatter.settextattribute.php" class="function">numfmt_set_text_attribute()</a></span>.
   <dl>

    <dt id="numberformatter.constants.positive-prefix">
     <span class="term">
      <strong><code>NumberFormatter::POSITIVE_PREFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Positive prefix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.positive-suffix">
     <span class="term">
      <strong><code>NumberFormatter::POSITIVE_SUFFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Positive suffix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.negative-prefix">
     <span class="term">
      <strong><code>NumberFormatter::NEGATIVE_PREFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Negative prefix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.negative-suffix">
     <span class="term">
      <strong><code>NumberFormatter::NEGATIVE_SUFFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Negative suffix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.padding-character">
     <span class="term">
      <strong><code>NumberFormatter::PADDING_CHARACTER</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The character used to pad to the format width.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.currency-code">
     <span class="term">
      <strong><code>NumberFormatter::CURRENCY_CODE</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The ISO currency code.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.default-ruleset">
     <span class="term">
      <strong><code>NumberFormatter::DEFAULT_RULESET</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       The default rule set. This is only available with rule-based
       formatters.
      </span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.public-rulesets">
     <span class="term">
      <strong><code>NumberFormatter::PUBLIC_RULESETS</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       The public rule sets. This is only available with rule-based
       formatters. This is a read-only attribute. The public rulesets are
       returned as a single string, with each ruleset name delimited by &#039;;&#039;
       (semicolon).
      </span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.unumberformatsymbol">
  <p class="para">
   Number format symbols used by  <span class="function"><a href="numberformatter.getsymbol.php" class="function">numfmt_get_symbol()</a></span>
   and  <span class="function"><a href="numberformatter.setsymbol.php" class="function">numfmt_set_symbol()</a></span>.
   <dl>

    <dt id="numberformatter.constants.decimal-separator-symbol">
     <span class="term">
      <strong><code>NumberFormatter::DECIMAL_SEPARATOR_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The decimal separator.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.grouping-separator-symbol">
     <span class="term">
      <strong><code>NumberFormatter::GROUPING_SEPARATOR_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The grouping separator.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pattern-separator-symbol">
     <span class="term">
      <strong><code>NumberFormatter::PATTERN_SEPARATOR_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The pattern separator.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.percent-symbol">
     <span class="term">
      <strong><code>NumberFormatter::PERCENT_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The percent sign.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.zero-digit-symbol">
     <span class="term">
      <strong><code>NumberFormatter::ZERO_DIGIT_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Zero.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.digit-symbol">
     <span class="term">
      <strong><code>NumberFormatter::DIGIT_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Character representing a digit in the pattern.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.minus-sign-symbol">
     <span class="term">
      <strong><code>NumberFormatter::MINUS_SIGN_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The minus sign.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.plus-sign-symbol">
     <span class="term">
      <strong><code>NumberFormatter::PLUS_SIGN_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The plus sign.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.currency-symbol">
     <span class="term">
      <strong><code>NumberFormatter::CURRENCY_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The currency symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.intl-currency-symbol">
     <span class="term">
      <strong><code>NumberFormatter::INTL_CURRENCY_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The international currency symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.monetary-separator-symbol">
     <span class="term">
      <strong><code>NumberFormatter::MONETARY_SEPARATOR_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The monetary separator.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.exponential-symbol">
     <span class="term">
      <strong><code>NumberFormatter::EXPONENTIAL_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The exponential symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.permill-symbol">
     <span class="term">
      <strong><code>NumberFormatter::PERMILL_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Per mill symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pad-escape-symbol">
     <span class="term">
      <strong><code>NumberFormatter::PAD_ESCAPE_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Escape padding character.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.infinity-symbol">
     <span class="term">
      <strong><code>NumberFormatter::INFINITY_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Infinity symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.nan-symbol">
     <span class="term">
      <strong><code>NumberFormatter::NAN_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Not-a-number symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.significant-digit-symbol">
     <span class="term">
      <strong><code>NumberFormatter::SIGNIFICANT_DIGIT_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Significant digit symbol.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.monetary-grouping-separator-symbol">
     <span class="term">
      <strong><code>NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">The monetary grouping separator.</span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.unumberformatroundingmode">
  <p class="para">
   Rounding mode values used by  <span class="function"><a href="numberformatter.getattribute.php" class="function">numfmt_get_attribute()</a></span>
   and  <span class="function"><a href="numberformatter.setattribute.php" class="function">numfmt_set_attribute()</a></span> with
   <strong><code>NumberFormatter::ROUNDING_MODE</code></strong> attribute.
   <dl>

    <dt id="numberformatter.constants.round-ceiling">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_CEILING</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding mode to round towards positive infinity.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-down">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_DOWN</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding mode to round towards zero.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-floor">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_FLOOR</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding mode to round towards negative infinity.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-halfdown">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_HALFDOWN</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       Rounding mode to round towards &quot;nearest neighbor&quot; unless both neighbors
       are equidistant, in which case round down.
      </span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-halfeven">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_HALFEVEN</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       Rounding mode to round towards the &quot;nearest neighbor&quot; unless both
       neighbors are equidistant, in which case, round towards the even
       neighbor.
      </span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-halfup">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_HALFUP</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">
       Rounding mode to round towards &quot;nearest neighbor&quot; unless both neighbors
       are equidistant, in which case round up.
      </span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.round-up">
     <span class="term">
      <strong><code>NumberFormatter::ROUND_UP</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Rounding mode to round away from zero.</span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

 <div class="section" id="intl.numberformatter-constants.unumberformatpadposition">
  <p class="para">
   Pad position values used by  <span class="function"><a href="numberformatter.getattribute.php" class="function">numfmt_get_attribute()</a></span>
   and  <span class="function"><a href="numberformatter.setattribute.php" class="function">numfmt_set_attribute()</a></span> with
   <strong><code>NumberFormatter::PADDING_POSITION</code></strong> attribute.
   <dl>

    <dt id="numberformatter.constants.pad-after-prefix">
     <span class="term">
      <strong><code>NumberFormatter::PAD_AFTER_PREFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Pad characters inserted after the prefix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pad-after-suffix">
     <span class="term">
      <strong><code>NumberFormatter::PAD_AFTER_SUFFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Pad characters inserted after the suffix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pad-before-prefix">
     <span class="term">
      <strong><code>NumberFormatter::PAD_BEFORE_PREFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Pad characters inserted before the prefix.</span>
     </dd>

    </dt>


    <dt id="numberformatter.constants.pad-before-suffix">
     <span class="term">
      <strong><code>NumberFormatter::PAD_BEFORE_SUFFIX</code></strong>
      (<span class="type"><a href="language.types.integer.php" class="type integer">integer</a></span>)
     </span>
     <dd>

      <span class="simpara">Pad characters inserted before the suffix.</span>
     </dd>

    </dt>

   </dl>

  </p>
 </div>

</div>





  <div class="section" id="numberformatter.seealso">
   <h2 class="title">å‚è§</h2>
   <p class="para">
    <ul class="simplelist">
     <li class="member">
      <a href="http://icu-project.org/userguide/formatParse.html" class="link external">&raquo;&nbsp;
       ICU formatting documentation
      </a>
     </li>
     <li class="member">
      <a href="http://icu-project.org/userguide/formatNumbers.html" class="link external">&raquo;&nbsp;ICU number formatters</a>
     </li>
     <li class="member">
      <a href="http://www.icu-project.org/apiref/icu4c/classDecimalFormat.html#details" class="link external">&raquo;&nbsp;ICU decimal formatters</a>
     </li>
     <li class="member">
      <a href="http://www.icu-project.org/apiref/icu4c/classRuleBasedNumberFormat.html#details" class="link external">&raquo;&nbsp;
       ICU rule-based number formatters
      </a>
     </li>
    </ul>
   </p>
  </div>
 </div>



































































































<h2>Table of Contents</h2><ul class="chunklist chunklist_reference"><li><a href="numberformatter.create.php">NumberFormatter::create</a> â€” Create a number formatter</li><li><a href="numberformatter.formatcurrency.php">NumberFormatter::formatCurrency</a> â€” Format a currency value</li><li><a href="numberformatter.format.php">NumberFormatter::format</a> â€” Format a number</li><li><a href="numberformatter.getattribute.php">NumberFormatter::getAttribute</a> â€” Get an attribute</li><li><a href="numberformatter.geterrorcode.php">NumberFormatter::getErrorCode</a> â€” Get formatter's last error code.</li><li><a href="numberformatter.geterrormessage.php">NumberFormatter::getErrorMessage</a> â€” Get formatter's last error message.</li><li><a href="numberformatter.getlocale.php">NumberFormatter::getLocale</a> â€” Get formatter locale</li><li><a href="numberformatter.getpattern.php">NumberFormatter::getPattern</a> â€” Get formatter pattern</li><li><a href="numberformatter.getsymbol.php">NumberFormatter::getSymbol</a> â€” Get a symbol value</li><li><a href="numberformatter.gettextattribute.php">NumberFormatter::getTextAttribute</a> â€” Get a text attribute</li><li><a href="numberformatter.parsecurrency.php">NumberFormatter::parseCurrency</a> â€” Parse a currency number</li><li><a href="numberformatter.parse.php">NumberFormatter::parse</a> â€” Parse a number</li><li><a href="numberformatter.setattribute.php">NumberFormatter::setAttribute</a> â€” Set an attribute</li><li><a href="numberformatter.setpattern.php">NumberFormatter::setPattern</a> â€” Set formatter pattern</li><li><a href="numberformatter.setsymbol.php">NumberFormatter::setSymbol</a> â€” Set a symbol value</li><li><a href="numberformatter.settextattribute.php">NumberFormatter::setTextAttribute</a> â€” Set a text attribute</li></ul>
</div>
<?php manual_footer(); ?>