<?php 
require_once '../../includes/database_conn.php';

$updates_id = $_POST['delete_updates'];

$get_updates = mysqli_query($conn, "SELECT * FROM updates WHERE updates_id = $updates_id");

    $updates_image = '';

    while($row = mysqli_fetch_array($get_updates)) {
        $updates_image = $row['updates_image'];
    }

$delete_updates = mysqli_query($conn, "DELETE FROM updates WHERE updates_id = $updates_id");

if($delete_updates) {
    echo 'success';
    unlink('../../assets/images/' . $updates_image);
}