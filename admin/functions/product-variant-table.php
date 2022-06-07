<?php
require_once '../../includes/database_conn.php';

$request = $_REQUEST;
$col = array(
    0 => 'variant_title'
);

$sql = "SELECT * FROM product_variant";
$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

$sql = "SELECT * FROM product_variant WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (variant_title LIKE '" . $request['search']['value'] . "%' ) ";
}
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);

$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . " " . $request['order'][0]['dir'] . " LIMIT " . $request['start'] . " ," . $request['length'] . " ";

$query = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata[] = $row[1];
    $subdata[] = '
    <button type="button" id="getEdit" data-id="' . $row[0] . '"><i class="fa-solid fa-pen"></i><span>Edit</span></button>
    <button type="button" id="getDelete" data-id="' . $row[0] . '"><i class="fa-solid fa-trash-can"></i><span>Delete</span></button>
    ';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
