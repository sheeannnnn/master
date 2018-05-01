<?php
    include_once("../connection/dbconnect.php");
    global $connect;
// DB table to use
$table = 'history';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'dateandtime', 
           'dt' => 0
           // 'formatter' => function ($d, $row){
           //      return date( 'F d, Y ', strtotime($d));
           // }
        ),
    array( 'db' => 'pressure',  
           'dt' => 1,
           'formatter' => function ($d, $row){
                return number_format($d).' N';
           }
        ),
    array( 'db' => 'status',  
           'dt' => 2,
           'formatter' => function ($d, $row){
             if ($d == 'true'){
                return 'Activated';
            } elseif ($d == 'false'){
                return 'Inactive';
            }
           } 
         )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'capstone',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>