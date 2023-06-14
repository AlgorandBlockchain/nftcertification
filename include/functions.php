<?
// fungsi-fungsi pendukung.
function minuss($jumlah){
	if(substr($jumlah,0,1) == "-"){
		return  "(".number_format($jumlah*(-1),2,'.',',').")";
	}
	else{
		return  number_format($jumlah,2,'.',',');
	}
}
function pembulatan($uang)
{
 $ratusan = substr($uang, -3);
 if($ratusan<500)
 $akhir = $uang - $ratusan;
 else
 $akhir = $uang + (1000-$ratusan);
 echo number_format($akhir, 2, ',', '.');;
}

function auto($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00".$nomor;
		break;
		case "2" :
			return "0".$nomor;
		break;
		default :
			return $nomor;
		break;
	}
}
function nobukti($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00000".$nomor;
		break;
		case "2" :
			return "0000".$nomor;
		break;
		case "3" :
			return "000".$nomor;
		break;
		case "4" :
			return "00".$nomor;
		break;
		case "5" :
			return "0".$nomor;
		break;
		default :
			return $nomor;
		break;
	}
}
function absen($tipe) {
	if ($tipe==0) {
		return "Masuk";
	}
	if ($tipe==1) {
		return "Pulang";
	}
	if ($tipe==4) {
		return "Masuk Lembur";
	}
	if ($tipe==5) {
		return "Pulang Lembur";
	}


}

function getMinggu($tahun, $bulan , $hari) {
       return ceil(($hari + date("w",mktime(0,0,0,$bulan,1,$tahun)))/7);
   }

function baliktgl($tgl) {
	//21/12/2010
	$hari = substr($tgl,0,2);
	$bln = substr($tgl,3,2);
	$thn = substr($tgl,6,4);
	$tgle = $thn."-".$bln."-".$hari;
	return $tgle;
}

function baliktglinput($tgl) {
	//21/12/2010
	$hari = substr($tgl,6,2);
	$bln = substr($tgl,4,2);
	$thn = substr($tgl,0,4);
	$tgle = $thn."-".$bln."-".$hari;
	return $tgle;
}

function baliktglindo($tglx) {
	//2010-12-01
	$hari = substr($tglx,8,2);
	$bln = substr($tglx,5,2);
	$thn = substr($tglx,0,4);
	$tgli = $hari."-".$bln."-".$thn;
	return $tgli;
}

function tgl_indo($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan    = getBulan(substr($tgl,5,2));
  $tahun    = substr($tgl,0,4);
  return $tanggal.' '.$bulan.' '.$tahun;
}

function getBulan($bln){
  switch ($bln){
	case 1:
	  return "January";
	  break;
	case 2:
	  return "February";
	  break;
	case 3:
	  return "March";
	  break;
	case 4:
	  return "April";
	  break;
	case 5:
	  return "May";
	  break;
	case 6:
	  return "June";
	  break;
	case 7:
	  return "July";
	  break;
	case 8:
	  return "August";
	  break;
	case 9:
	  return "September";
	  break;
	case 10:
	  return "October";
	  break;
	case 11:
	  return "November";
	  break;
	case 12:
	  return "December";
	  break;
  }
}

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function destroyDir($dir, $virtual = false)
{
  $ds = DIRECTORY_SEPARATOR;
  $dir = $virtual ? realpath($dir) : $dir;
  $dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir;
  if (is_dir($dir) && $handle = opendir($dir))
  {
    while ($file = readdir($handle))
    {
      if ($file == '.' || $file == '..')
      {
        continue;
      }
      elseif (is_dir($dir.$ds.$file))
      {
        destroyDir($dir.$ds.$file);
      }
      else
      {
        unlink($dir.$ds.$file);
      }
    }
    closedir($handle);
    rmdir($dir);
    return true;
  }
    else
  {
    return false;
  }
}


 function dateDifference($day_1,$day_2) {
   $diff = strtotime($day_1) - strtotime($day_2);

   $sec   = $diff % 60;
   $diff  = intval($diff / 60);
   $min   = $diff % 60;
   $diff  = intval($diff / 60);
   $hours = $diff % 24;
   $days  = intval($diff / 24);

   return array($sec,$min,$hours,$days);
}

function strleft($leftstring, $length) {
  return(substr($leftstring, 0, $length));
}

function datediff($tgl1, $tgl2){
$tgl1 = strtotime($tgl1);
$tgl2 = strtotime($tgl2);
$diff_secs = abs($tgl1 - $tgl2);
$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
return array( "years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int) date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int) date("s", $diff) );
}

function tgltostr($tgl) {
	//21/12/2010
	$thn = substr($tgl,0,4);
	$bln = substr($tgl,5,2);
	$hari = substr($tgl,8,2);
	$tgle = $thn."".$bln."".$hari;
	return $tgle;
}

function huruf_awal_besar($pemisah, $paragrap) {
  //pisahkan $paragraf berdasarkan $pemisah dengan fungsi explode
  $pisahkalimat=explode($pemisah, $paragrap);
  $kalimatbaru = array();
  //looping dalam array
  foreach ($pisahkalimat as $kalimat) {
    //jadikan awal huruf masing2 array menjadi huruf besar dengan fungsi ucfirst
    $kalimatawalhurufbesar=ucfirst(strtolower($kalimat));
    $kalimatbaru[] = $kalimatawalhurufbesar;
  }

  //kalo udah gabungin lagi dengan fungsi implode
  $textgood = implode($pemisah, $kalimatbaru);
  return $textgood;
}

function wordlimit($text,$limit=20) {
  if (strlen($text)>$limit)
    $word = mb_substr($text,0,$limit-3)."...";
  else
    $word = $text;
  return $word;
}

function bataskalimat($text,$limit=40) {
  if (strlen($text)>$limit)
    $word = mb_substr($text,0,$limit-3)."...";
  else
    $word = $text;
  return $word;
}

function bataskalimatx($text,$limit=30) {
  if (strlen($text)>$limit)
    $word = mb_substr($text,0,$limit-3)."...";
  else
    $word = $text;
  return $word;
}

function bataskalimaty($text,$limit=120) {
  if (strlen($text)>$limit)
    $word = mb_substr($text,0,$limit-3)."...";
  else
    $word = $text;
  return $word;
}

function bataskalimatz($text,$limit=145) {
  if (strlen($text)>$limit)
    $word = mb_substr($text,0,$limit-3)."...";
  else
    $word = $text;
  return $word;
}



?>
