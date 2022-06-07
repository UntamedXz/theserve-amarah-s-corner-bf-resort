<?php
require_once '../../includes/database_conn.php';

$request = $_REQUEST;
$col = array(
    0   =>  'variant_title',
);
//create column like table in database

$sql = "SELECT * FROM product_variant";
$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM product_variant WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (variant_title Like '" . $request['search']['value'] . "%' ) ";
}
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);

//Order
// $sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'] . "  LIMIT " .
//     $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata[] = '
    <div class="variant-tab-group">
        <span>Add attributes (Ignore if product doesn\'t have this attribute)</span>
        <div class="input-group">
            <input class="selected-variation" type="text" name="" id="" data-id="'.$row[0].'" value="'.$row[1].'" readonly>
            <input class="attributes" type="text" name="" placeholder="Add attributes separated by |. e.g. red|green|yellow" id="">
        </div>
    </div>
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