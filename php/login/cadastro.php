<?php 

    
    require '../conector.php';

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $nomeClear = preg_replace('/[^[:alnum:]_]/', '', $nome);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $senhaClear = preg_replace('/[^[:alnum:]_]/', '', $senha);
    // echo $nome, $email, $senha;

    $query = "SELECT nome, email FROM usuario WHERE nome = '$nome' AND email = '$email' ";
    $r = mysqli_query($conn, $query);

    if(mysqli_num_rows($r) > 0){
        header('Location: login.php?t=true');
    } else {
        $query = "INSERT INTO usuario (nome, email, senha) VALUES ('$nomeClear', '$email', '$senhaClear' ) ";

        if(mysqli_query($conn, $query)){
            header('Location: login.php?l=true');
        } else {
            header('Location: login.php?l=false');
        }
    }

    

?>