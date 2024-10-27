<?php
include 'server.php';

if (isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['tel']) && $_POST['tel'] != '') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);

    $sql = "UPDATE users SET name = '$name', tel = '$tel' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "<script>
            alert('Error updating record: " . mysqli_error($conn) . "');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Username or Tel is invalid');
        window.location.href = 'index.php';
    </script>";
}
?>
