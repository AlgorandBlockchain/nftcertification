<?php
include ("../../../../include/globalx.php");include ("../../../../include/functions.php");

if ($_GET['reindex']==1) {
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
}

// DB table to use
$table = 'tbarang';

// Table's primary key
$primaryKey = 'no_urut';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'ud.kode_brg', 'dt' => 0, 'field' => 'kode_brg' ),
	array( 'db' => 'u.nama_brg',  'dt' => 1, 'field' => 'nama_brg' ),
	array( 'db' => 'ud.saldo',   'dt' => 2, 'field' => 'saldo', 'formatter' => function( $d, $row ) {return ''.number_format($d,0,'.',',');} ),
        array( 'db' => 'u.unit_ro',   'dt' => 3, 'field' => 'unit_ro' ),
        array( 'db' => 'ud.loc_code',   'dt' => 4, 'field' => 'loc_code' ),
        array( 'db' => 'u.no_urut',   'dt' => 5, 'field' => 'no_urut' ),
        array( 'db' => 'u.status',   'dt' => 6, 'field' => 'status' ),
        array( 'db' => 'SUM(ud.keluar) as sum_keluar',   'dt' => 7, 'field' => 'sum_keluar', 'formatter' => function( $d, $row ) {return ''.number_format($d,0,'.',',');} ),
        array( 'db' => 'SUM(ud.masuk) as sum_masuk',   'dt' => 8, 'field' => 'sum_masuk', 'formatter' => function( $d, $row ) {return ''.number_format($d,0,'.',',');} )
);

// SQL server connection information
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'dbsoliens_erp',
	'host' => 'localhost'
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.class_bincard.php');
$joinQuery = "FROM tbarang AS u INNER JOIN tstock AS ud ON (ud.kode_brg = u.kode_brg)";
$extraWhere = " ud.loc_code = '".$_GET['loc_code']."'";
$groupBy = " ud.kode_brg";
$having = " u.status = 'AKTIF'";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
