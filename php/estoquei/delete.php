<?php 

require '../conector.php';
session_start();

$id = $_SESSION['id_estoque'];

$query = "DELETE FROM estoque WHERE id = {$id}";
$row = mysqli_query($conn, $query);

if($row){
    header('Location: index.php?del=fully');
    exit();
} else {
    header('Location: index.php?del=delle');
    exit();
}

?>