<?php
require_once __DIR__ . '/../../../conexao/conexao.php';

$dbDetails = array(
    'host' => $servidor,
    'user' => $usuario,
    'pass' => $senha,
    'db'   => $dbname
);

$table = 'trauma';
 
$primaryKey = 'id';



$columns = array(

    array('db' => 'id', 'dt' => 0),
    array(
        'db'        => 'txtdatahora',
        'dt'        => 1,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array('db' => 'funcionario',  'dt' => 2),
    array('db' => 'plantao',  'dt' => 3),
    
    array('db' => 'evento',  'dt' => 4),
    array('db' => 'qru',  'dt' => 5),
    array('db' => 'qra',  'dt' => 6),
    array('db' => 'qth',  'dt' => 7),
    array('db' => 'qti',  'dt' => 8),
    array('db' => 'message',  'dt' => 9),

    array(
        'dt' => 10,
        'formatter' => function ($row) {

            return '<a style="color:green;" class=" view"  id="' . $row['id'] . '" ><i class="fa fa-lg fa-search" aria-hidden="true"></i></a> 
            <a id="getEdit"   data-toggle="modal" data-target="#myModal" data-id="' . $row[0] . '"><i class="fas fa-lg fa-edit"></i></a></a>';
        }
    ),

    array( 
        'dt'        => 11, 
        'formatter' => function( $row ) { 
            return '<a href="delete1.php?cod='.$row['id'].'" style="color:black" onclick="return checkDelete()" ><i class="fa fa-lg fa-trash" aria-hidden="true"></i></a>'; 
        } 
    )
    );








// Include SQL query processing class 
require 'ssp.class.php';

// Output data as json format 
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);
