<?php
require_once '../../includes/database_conn.php';

$request = $_REQUEST;
$col = array(
    // 0   =>  'category_id',
    0   =>  'product_img1',
    1   =>  'category_title',
    2   =>  'subcategory_title',
    3   =>  'product_title',
    4   =>  'product_slug',
    5   =>  'product_price'
);
//create column like table in database

$sql = "SELECT product.product_id, product.product_img1, category.category_title, subcategory.subcategory_title, product.product_title, product.product_slug, product.product_price FROM product LEFT JOIN category ON product.category_id=category.category_id LEFT JOIN subcategory ON product.subcategory_id=subcategory.subcategory_id";
$query = mysqli_query($conn, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT product.product_id, product.product_img1, category.category_title, subcategory.subcategory_title, product.product_title, product.product_slug, product.product_price FROM product LEFT JOIN category ON product.category_id=category.category_id LEFT JOIN subcategory ON product.subcategory_id=subcategory.subcategory_id WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (category_title Like '" . $request['search']['value'] . "%'";
    $sql .= " OR subcategory_title Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR product_title Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR product_slug Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR product_price Like '" . $request['search']['value'] . "%' )";
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
    $subdata[] = '<img style="width: 80px; border-radius: 50%;" src="../assets/images/' . $row[1] . '" alt="">';
    $subdata[] = $row[2];
    $subdata[] = $row[3];
    $subdata[] = $row[4];
    $subdata[] = $row[5];
    $subdata[] = $row[6];
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
