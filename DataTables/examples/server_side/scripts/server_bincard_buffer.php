<?php
include ("../../../../include/globalx.php");include ("../../../../include/functions.php");
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
$sqlz = mysql_query("SELECT tbarang.kode_brg, tstock.masuk, tstock.keluar, tbarang.status, tstock.loc_code FROM tbarang INNER JOIN tstock ON tbarang.kode_brg = tstock.kode_brg WHERE tbarang.status = 'AKTIF' AND tstock.loc_code = '".$_GET['loc_code']."' GROUP BY tstock.kode_brg");
if (($sqlz)&&(mysql_num_rows($sqlz)>0)) {
    while ($dataz = mysql_fetch_array($sqlz)) {
        $kode_brg = $dataz['kode_brg'];
        $sqlx = mysql_query("SELECT * FROM tstock WHERE kode_brg = '".$kode_brg."' AND loc_code = '".$_GET['loc_code']."' ORDER BY tgl ASC ");
        if (($sqlx)&&(mysql_num_rows($sqlx)>0)) {
            $jmlh_stock = 0;
            while ($datax=mysql_fetch_array($sqlx)) {
                $jmlh_stock = $jmlh_stock + $datax['masuk'] - $datax['keluar'];
                if ($jmlh_stock < 0) {$jmlh_stock = 0;}                
            }
            $sqly = mysql_query("UPDATE tstock set saldo = ".$jmlh_stock." WHERE kode_brg = '".$kode_brg."' AND loc_code = '".$_GET['loc_code']."'");
        }
    }
}

