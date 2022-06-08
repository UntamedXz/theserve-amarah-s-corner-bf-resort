<?php
require_once '../../includes/database_conn.php';

$request = $_REQUEST;
$col = array(
    0   =>  'admin_id',
    1   =>  'admin_name',
    2   =>  'admin_username',
    3   =>  'admin_email',
    4   =>  'profile_image',
    5   =>  'admin_phone_number',
    6   =>  'admin_type',
);
//create column like table in database

$sql = "SELECT admin.admin_id,
admin.admin_name,
admin.admin_username,
admin.admin_email,
admin.profile_image,
admin.admin_phone_number,
admin_type.admin_type
FROM admin
LEFT JOIN admin_type
ON admin.admin_type = admin_type.admin_type_id";
$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT admin.admin_id,
admin.admin_name,
admin.admin_username,
admin.admin_email,
admin.profile_image,
admin.admin_phone_number,
admin_type.admin_type
FROM admin
LEFT JOIN admin_type
ON admin.admin_type = admin_type.admin_type_id WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (admin.admin_name Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR admin.admin_username Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR admin.admin_email Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR admin.profile_image Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR admin.admin_phone_number Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR admin_type.admin_type Like '" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'] . "  LIMIT " .
    $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata[] = $row[1];
    $subdata[] = $row[2];
    $subdata[] = $row[3];
    $subdata[] = '<img style="width: 100px;" src="../assets/images/'.$row[4].'" alt="">';
    $subdata[] = $row[5];
    $subdata[] = strtoupper($row[6]);
    $subdata[] = '
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
