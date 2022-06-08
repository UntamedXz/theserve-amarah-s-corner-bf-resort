<?php 
require_once '../../includes/database_conn.php';

if(isset($_POST['delete'])) {
    $adminId = $_POST['admin_id'];
    $OldProfileImg = $_POST['OldProfileImg'];

    $deleteProfileImg = mysqli_query($conn, "UPDATE admin SET profile_image = NULL WHERE admin_id = $adminId");

    unlink('../../assets/images/' . $OldProfileImg);

    if($deleteProfileImg) {
        echo 'success';
    }
}