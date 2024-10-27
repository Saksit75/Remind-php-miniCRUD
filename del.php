<?php
include 'server.php';

if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);    
    $sql = "DELETE FROM users WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
        header("Location: index.php");
    }else{
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ')</script>";
        header("Location: index.php");
    }
}
?>