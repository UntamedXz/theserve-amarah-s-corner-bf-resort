<?php 
require_once '../includes/database_conn.php';

if(isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $OldProfileImg = $_POST['OldProfileImg'];

    $deleteProfileImg = mysqli_query($conn, "UPDATE customers SET user_profile_image = NULL WHERE user_id = $userId");

    unlink('../assets/images/' . $OldProfileImg);

    if($deleteProfileImg) {
        echo 'success';
    }
}