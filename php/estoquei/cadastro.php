<?php 

    require '../conector.php';
    session_start();

    $name = filter_input(INPUT_POST, 'nome_prod', FILTER_SANITIZE_STRING);

    $qtd = filter_input(INPUT_POST, 'qtd_prod', FILTER_SANITIZE_STRING);
    $id = $_SESSION['id'];

    $query = "SELECT nome_est FROM estoque WHERE nome_est = '$name' ";

    $row = mysqli_query($conn, $query);
    
    var_dump($row);

    if($res = mysqli_num_rows($row) == 0){  
        
        $query = "INSERT INTO estoque (nome_est, quantidade_est, id_user) VALUES ('$name', '$qtd', '$id')";

        if(mysqli_query($conn, $query)){
            header('Location: index.php?full=exist');
        } 
    } else {
        header('Location: index.php?fail=exist');
    }

?>