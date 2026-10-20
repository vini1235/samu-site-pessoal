<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../../../conexao/conexao.php';

// Database connection info 
$dbDetails = array(
    'host' => $servidor,
    'user' => $usuario,
    'pass' => $senha,
    'db' => $dbname
); 
 
// DB table to use 
$table = 'cid'; 
 
// Table's primary key 
$primaryKey = 'idCid'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'idCid', 'dt' => 0 ), 
    array( 'db' => 'descricaoCid',  'dt' => 1 ), 
 
   
 
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);