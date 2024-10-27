<?php
include 'server.php';
if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['tel']) && $_POST['tel'] != '') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);

    $sql = "INSERT INTO users (name, tel) VALUES ('$name', '$tel')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    }
}else{
    echo "<script>
    alert('Username or Tel is invalid');
    window.location.href = 'index.php';
  </script>";
}
?>