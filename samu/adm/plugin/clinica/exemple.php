<?php



//fetch.php

$columns = array('', '', '','', '', '','','','','','');

$query = "SELECT * FROM # WHERE ";

if ($_POST["is_date_search"] == "yes") {
    $start_date = DateTime::createFromFormat('d/m/Y', $_POST["start_date"])->format('Y-m-d');
    $end_date = DateTime::createFromFormat('d/m/Y', $_POST["end_date"])->format('Y-m-d');

    $query .= '# BETWEEN "' . $start_date . '" AND "' . $end_date . '" AND ';
}




if(isset($_POST["search"]["value"]))
$query .= '
  (id LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR #LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%"
  OR # LIKE "%' . $_POST["search"]["value"] . '%")
 ';

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = date("d/m/Y", strtotime($row[""]));
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = $row[""];
 $sub_array[] = '<a style="color:green;" class=" view"  id="' . $row["id"] . '" ><i class="material-icons">visibility</i></a>';
 $sub_array[] = '<a target="_blank" href= "../pdf/gerar_pdf.php?cod=' . $row["id"] . ' rel="noopener noreferrer"  ><i class="material-icons" style="color:red;">picture_as_pdf</i></a>';
 $sub_array[] = '<a type="button" id="getEdit" style="color:White;" data-toggle="modal" data-target="#myModal" data-id="' . $row[0] . '"><i class="fa fa-pencil-square-o fa-2x" style="color:blue;" aria-hidden="true"></i> </a>';
 $sub_array[] = '<a href="config/delete.php?cod=' . $row['id'] . '" style="color:black" onclick="return checkDelete()"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>';

 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM #";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);
