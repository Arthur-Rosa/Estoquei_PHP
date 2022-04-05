<?php 
require '../conector.php';
session_start(); 

$quantidade = 12;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoquei - Inicio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/login_css/login.css">
    <link rel="stylesheet" href="../../css/index_css/index.css">
</head>

<body>
    <div class="bg">

        <div class="bar-lateral">

            <h3>Olá, <span id="dd"><?php echo $_SESSION['nome'] ?></span></h3>
            <form class="form-inline my-2 my-lg-0" action="indexx.php" method="get">
                <input class="form-control mr-sm-2" name="value" type="search" placeholder="Digite o numero da ordem"
                    aria-label="Search" />
                <button class="btn btn-outline-success btn-success my-2 my-sm-0 mt-1" value="Pesquisar"
                    type="submit">Pesquisar</button>
            </form>
            <div class="bg-img">
                <img src="../../image/EstoqueiLogo.png" class="logo-img" />
            </div>

        </div>
        <div class="bar-super">
            <button class="btn btn-success" id="new">Novo Item</button>
        </div>

        <div class="tablee">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Número da Ordem</th>
                        <th scope="col">Nome do produto</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
            

            $id = $_SESSION['id'];

            $query = "SELECT id, nome_est, quantidade_est, id_user FROM estoque WHERE id_user = '" .$id ."' LIMIT $inicio, $quantidade ";

            $row = mysqli_query($conn, $query);

            

            if (mysqli_num_rows($row)) {
                while ($value = $row->fetch_assoc()) {

                    $id = $value['id'];
                    $nome = $value['nome_est'];
                    $quantidade = $value['quantidade_est'];
            ?>

                    <tr>
                        <th scope="row" class="table-bordered"><?php echo $id ?></th>
                        <td class="table-bordered"><?php echo $nome ?></td>
                        <td class="table-bordered"><?php echo $quantidade ?></td>
                        <td><button class="btn btn-warning"
                                onclick="window.location.href='?edt=true&id=<?php echo $value['id']; ?>'">Editar</button>
                            <button class="btn btn-danger"
                                onclick="window.location.href='?exc=true&id=<?php echo $value['id']; ?>'">Excluir</button>
                        </td>
                    </tr>
                    <?php
                }
            }

            if (!mysqli_num_rows($row)) {
                echo '<th style="padding: 30px;"> Sem produtos cadastrados </th>';
            }

            $sqlTotal   = "SELECT id FROM estoque";
            //Executa o SQL
            $qrTotal    = mysqli_query($conn, $sqlTotal);
            //Total de Registro na tabela
            $numTotal   = mysqli_num_rows($qrTotal);
            //O calculo do Total de página ser exibido
            $totalPagina = ceil($numTotal / $quantidade);

            $exibir = 2;

            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;

            $posterior = (($pagina + 1) >= $totalPagina) ? $totalPagina : $pagina + 1;


            ?>
                    <td class="navegacao mt">
                        <?php
                        echo '<a href="?pagina=1" style="text-decoration:none;" class="text-muted">primeira</a> | ';

                        echo "<a style='text-decoration:none;' class='text-muted' href=\"?pagina=$anterior\">anterior</a> | ";

                        for ($i = $pagina - $exibir; $i <= $pagina - 1; $i++) {
                            if ($i > 0)
                                echo '<a style="text-decoration:none;" class="text-muted" href="?pagina=' . $i . '"> ' . $i . ' </a>';
                        }

                        echo '<a style="text-decoration:none;" class="text-muted" href="?pagina=' . $pagina . '"><strong>' . $pagina . '</strong></a>';

                        for ($i = $pagina + 1; $i < $pagina + $exibir; $i++) {
                            if ($i <= $totalPagina)
                                echo '<a style="text-decoration:none;" class="text-muted" href="?pagina=' . $i . '"> ' . $i . ' </a>';
                        }
                        ?>
                        <?php echo " | <a style='text-decoration:none;' class='text-muted' href=\"?pagina=$posterior\">próxima</a> | ";
                        echo "  <a style='text-decoration:none;' class='text-muted' href=\"?pagina=$totalPagina\">última</a>"; ?>

                    </td>
                </tbody>
            </table>

        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
var d = document.getElementById('dd');

d.addEventListener('click', () => {
    $(function() {
        $("#modalExit").modal();
    });
})

var c = document.getElementById('new');

c.addEventListener('click', () => {
    $(function() {
        $("#myModal").modal();
    });
})
</script>

</html>

<?php 
$query = "SELECT id FROM estoque WHERE id_user = '".$_SESSION['id']."' ";
$row = mysqli_query($conn, $query);
?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cadastro</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="cadastro.php">
                    <label>Número da ordem</label>
                    <input type="text" value="<?php  if (mysqli_num_rows($row)) {
    while ($value = $row->fetch_assoc()) {       
        $contador = $value['id'];
    }

    $contador += 1;
    echo $contador;
} else {
    $contador = 1;
    echo $contador;
} ?>" name="nome" disabled />

                    <label class="em">Nome do Produto</label>
                    <input type="text" name="nome_prod" placeholder="Digite o nome do produto" />

                    <label class="snh">Quantidade</label>
                    <input type="number" name="qtd_prod" placeholder="Digite a quantidade" />
                    <div class="btn-log">
                        <button type="submit" class="btn btn-success btn-lg">Adicionar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php
if(@$_GET['fail'] == 'exist'){
?>
<div class="modal fade" id="modalName" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Erro</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Infelizmente já temos um Produto com esse Nome !!! Tente Novamente</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    if ($("#modalName").modal()) {
        var d = document.getElementById('modalName');
        d.addEventListener('click', () => {
            $(function() {
                $("#myModal").modal();
            });
        })
    }
});
</script>
<?php 
}
if(@$_GET['full'] == 'exist'){
?>
<div class="modal fade" id="modalF" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Sucesso !!!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Produto cadastrado com sucesso !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalF").modal();
});
</script>
<?php
}
if(@$_GET['edt'] == 'true'){
    $id = $_GET['id'];
    $_SESSION['id_estoque'] = $id;

    $query = "SELECT id, nome_est, quantidade_est, id_user FROM estoque WHERE id_user = '$id' ";
    $row = mysqli_query($conn, $query);

    if (mysqli_num_rows($row)) {
        while ($value = $row->fetch_assoc()) {
            $id = $value['id'];
            $nome = $value['nome_est'];
            $quantidade = $value['quantidade_est'];
        
        }
    }

?>
<div class="modal fade" id="ModalEdit" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cadastro</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="atualiza.php">
                    <label>Número da ordem</label>
                    <input type="number" name="ordem" value="<?php echo $id ?>" disabled />

                    <label class="em">Nome do Produto</label>
                    <input type="text" name="nome_prod" value="<?php echo $nome ?>"
                        placeholder="Digite o nome do produto" required />

                    <label class="snh">Quantidade</label>
                    <input type="number" name="qtd_prod" value="<?php echo $quantidade ?>"
                        placeholder="Digite a quantidade" required />
                    <div class="btn-log">
                        <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#ModalEdit").modal();
});
</script>
<?php
}
if(@$_GET['name'] == 'error'){
?>
<div class="modal fade" id="modalName" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Erro</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Nome já existente !!! Tente Novamente</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    if ($("#modalName").modal()) {
        var d = document.getElementById('modalName');

        d.addEventListener('click', () => {
            window.location.href = '?edt=true';
        })
    }
});
</script>
<?php
}
if(@$_GET['success'] == 'true'){
?>
<div class="modal fade" id="modalK" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Sucesso !!!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Produto atualizado com sucesso !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalK").modal();
});
window.addEventListener('click', () => {
    window.location.href = 'index.php';
})
</script>
<?php 
} 
// exc=true
if(@$_GET['exc'] == 'true'){
    $id = $_GET['id'];
    $_SESSION['id_estoque'] = $id;
?>
<div class="modal fade" id="modalA" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">ALERTA</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edt">
                <h5>Deseja mesmo excluir o item ?</h5>
                <button class="btn btn-danger" onclick="window.location.href='delete.php?'">EXCLUIR</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalA").modal();
});
</script>
<?php
}
// del=fully
if(@$_GET['del'] == 'fully'){
?>
<div class="modal fade" id="modalDEl" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Sucesso !!!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Produto DELETADO com sucesso !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalDEl").modal();
});
window.addEventListener('click', () => {
    window.location.href = 'index.php';
})
</script>
<?php    
}
// del=delle
if(@$_GET['del'] == 'delle'){
?>
<div class="modal fade" id="modalDEle" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">ERROR</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Ocorreu um erro ao deletar o produto.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalDEle").modal();
});
window.addEventListener('click', () => {
    window.location.href = 'index.php';
})
</script>
<?php    
}
?>
<div class="modal fade" id="modalExit" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Olá <?php echo $_SESSION['nome']; ?></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edt">
                <h5>Deseja mesmo sair ?</h5>
                <h5>Vou sentir sua falta !!!</h5>
                <button class="btn btn-danger" onclick="window.location.href='../logout.php'">SAIR</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Foi engano</button>
            </div>
        </div>
    </div>
</div>