<?php 

    require '../conector.php';
    session_start();

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nomeClear = preg_replace('/[^[:alnum:]_]/', '', $nome);


    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $senhaClear = preg_replace('/[^[:alnum:]_]/', '', $senha);
  
    $query = "SELECT id, nome, senha FROM usuario WHERE nome = '$nomeClear' AND senha = '$senhaClear' ";

    $result = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($result)){
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nome'] = $row['nome'];

            header('Location: ../estoquei/index.php');
        }
    } else {
        header('Location: login.php?lg=false');
    }

        
    
        // 
    

?>