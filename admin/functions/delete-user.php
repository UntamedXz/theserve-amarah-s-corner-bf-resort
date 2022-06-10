<?php
require_once '../../includes/database_conn.php';

$admin_id = $_POST['delete_admin_id'];
$admin_id_loggedin = $_POST['admin_id'];

if ($admin_id == $admin_id_loggedin) {
    echo 'failed';
} else {
    $get_old_info = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $admin_id");

    $row = mysqli_fetch_array($get_old_info);

    $image = $row['profile_image'];

    if ($image != '') {
        $delete_admin = mysqli_query($conn, "DELETE FROM admin WHERE admin_id = $admin_id");

        unlink('../../assets/images/' . $image);
    } else {
        $delete_admin = mysqli_query($conn, "DELETE FROM admin WHERE admin_id = $admin_id");
    }

    if ($delete_admin) {
        echo 'success';
    }
}
