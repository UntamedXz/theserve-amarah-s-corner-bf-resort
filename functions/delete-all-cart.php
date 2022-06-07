<?php
session_start();
require_once '../includes/database_conn.php';

$user_id = $_POST['user_id'];

$delete = mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

if($delete) {
    $_SESSION['alert'] = 'success_all';
    echo "success";
}