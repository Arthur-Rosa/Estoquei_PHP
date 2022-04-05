<?php 
    require '../conector.php';
    session_start();

   

    $idInpt = $_SESSION['id_estoque'];

    $nomeInpt = filter_input(INPUT_POST, 'nome_prod', FILTER_SANITIZE_STRING);
    $qtdInpt = filter_input(INPUT_POST, 'qtd_prod', FILTER_SANITIZE_STRING);

    //var_dump($idInpt);
    //echo $idInpt, $nomeInpt, $qtdInpt;

    $query = "SELECT id, nome_est, quantidade_est, id_user FROM estoque WHERE id = '$idInpt' ";
    
    $row = mysqli_query($conn, $query);

    if (mysqli_num_rows($row)) {
        while ($value = $row->fetch_assoc()) {
            $id = $value['id'];
            $nome = $value['nome_est'];
            $quantidade = $value['quantidade_est'];

            if($nomeInpt != $nome) {
                
                $query = "SELECT nome_est FROM estoque WHERE nome_est = '$nomeInpt' ";
                
                $aciona = mysqli_query($conn, $query);
                $row = mysqli_num_rows($aciona);
                if($row > 0){
                    
                    header('Location: index.php?name=error');
                    
                } else {
                    
                    $query = "UPDATE estoque SET nome_est = '$nomeInpt', quantidade_est = '$qtdInpt' WHERE id = '$id' ";
                    
                    $result = mysqli_query($conn, $query);
                    if($result){
                        
                        header('Location: index.php?success=true');

                        exit();   
                    }
                }
            } else if ($qtdInpt != $quantidade){
                $query = "UPDATE estoque SET quantidade_est = '$qtdInpt' WHERE id = '$id' ";
                    
                $result = mysqli_query($conn, $query);
                if($result){
                        
                    header('Location: index.php?success=true');

                    exit();   
                }
            } else {
                header('Location: index.php?');
            }
        }
    }

?>