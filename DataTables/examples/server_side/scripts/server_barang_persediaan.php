<?php

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

// DB table to use
$table = 'tbarang';

// Table's primary key
$primaryKey = 'no_urut';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'no_urut', 'dt' => 0 ),
	array( 'db' => 'kode_brg', 'dt' => 1 ),
	array( 'db' => 'nama_brg',  'dt' => 2 ),
	array( 'db' => 'kategori',  'dt' => 3 ),
	array( 'db' => 'grup',  'dt' => 4 ),
	array(
		'db'        => 'harga_beli',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return ''.number_format($d,0,'.',',');
		}
	),
        array( 'db' => 'status',  'dt' => 6 )
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

require( 'ssp.class_barang_persediaan.php' );

//echo json_encode(
//	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
//);

$joinQuery = "";
$extraWhere = "";
$groupBy = "";
$having = " status = 'AKTIF'";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);
