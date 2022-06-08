<?php
require_once '../../includes/database_conn.php';

$request = $_REQUEST;
$col = array(
    0 => 'order_id',
    1 => 'block_street_building',
    2 => 'barangay',
    3 => 'city_municipality',
    4 => 'province',
    5 => 'email',
    6 => 'order_date',
    7 => 'order_total',
    8 => 'order_status_name',
);

$sql = "SELECT orders.order_id, order_address.block_street_building, order_address.barangay, order_address.city_municipality, order_address.province, customers.email, orders.order_date, orders.order_total, order_status.order_status_name
FROM orders
LEFT JOIN order_address
ON orders.order_id = order_address.order_id
LEFT JOIN order_status
ON orders.order_status = order_status.order_status_id
LEFT JOIN customers
ON orders.user_id = customers.user_id";

$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

$sql = "SELECT orders.order_id, order_address.block_street_building, order_address.barangay, order_address.city_municipality, order_address.province, customers.email, orders.order_date, orders.order_total, order_status.order_status_name
FROM orders
LEFT JOIN order_address
ON orders.order_id = order_address.order_id
LEFT JOIN order_status
ON orders.order_status = order_status.order_status_id
LEFT JOIN customers
ON orders.user_id = customers.user_id WHERE 1=1";

if (!empty($request['search']['value'])) {
    $sql .= " AND (orders.order_id LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_address.block_street_building LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_address.barangay LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_address.city_municipality LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_address.province LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR customers.email LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR orders.order_date LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR orders.order_total LIKE '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_status.order_status_name LIKE '" . $request['search']['value'] . "%' )";
}

$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);

$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . " " . $request['order'][0]['dir'] . " LIMIT " . $request['start'] . " ," . $request['length'] . " ";

$query = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata[] = $row[0];
    $subdata[] = $row[1] . ", " . $row[2] . ", " . $row[3] . ", " . $row[4];
    $subdata[] = $row[5];
    $subdata[] = $row[6];
    $subdata[] = "P " . $row[7];
    $subdata[] = $row[8];
    $subdata[] = '
    <button type="button" id="getEdit" data-id="' . $row[0] . '"><i class="fa-solid fa-pen"></i><span>Edit</span></button>
    <button type="button" id="getDelete" data-id="' . $row[0] . '"><i class="fa-solid fa-trash-can"></i><span>Delete</span></button>
    ';
    $data[] = $subdata;
}

$json_data = array(
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data" => $data,
);

echo json_encode($json_data);
