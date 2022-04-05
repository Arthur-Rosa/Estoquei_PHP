<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Est0quei - Login</title>
    <link rel="stylesheet" href="../../css/login_css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <div class="bg-image">
        <img src="../../image/EstoqueiLogo.png" class="image-logo" />
        <div class="form">
            <img src="../../image/LogoP.png" class="image-p" />
            <form action="lg.php" method="post">
                <label>Usuário</label>
                <input type="text" name="nome" placeholder="Digite o seu usuário..." />
                <label class="snh">Senha</label>
                <input type="password" name="senha" placeholder="Digite o sua senha..." />
                <div class="btn-log">
                    <button type="submit" class="btn btn-success btn-lg">Entrar</button>
                </div>
            </form>
            <h3>Não tem uma conta ? <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                    data-target="#myModal">Cadastre - se</button></h3>
        </div>
    </div>

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
                        <label>Usuário</label>
                        <input type="text" name="nome" placeholder="Digite o seu usuário..." />

                        <label class="em">E-mail</label>
                        <input type="email" name="email" placeholder="Digite o seu e-mail..." />

                        <label class="snh">Senha</label>
                        <input type="password" name="senha" placeholder="Digite o sua senha..." />
                        <div class="btn-log">
                            <button type="submit" class="btn btn-success btn-lg">Cadastrar-se</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>

        </div>
    </div>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>

<?php 
  if(@$_GET['l'] == 'true'){
?>
<div class="modal fade" id="modalSucces" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Cadastro</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Cadastro Realizado com sucesso !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalSucces").modal();
});
window.addEventListener('click', () => {
    window.location.href = 'login.php';
})
</script>
<?php
  }

  if(@$_GET['l'] == 'false'){
?>
<div class="modal fade" id="modalSucces" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Erro</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Infelizmente ocorreu um Erro !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#modalSucces").modal();
});
$(function() {
    $("#modalF").modal();
});
window.addEventListener('click', () => {
    window.location.href = 'login.php';
})
</script>

<?php
  }
  if(@$_GET['t'] == 'true'){
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
                <h5>Infelizmente já temos um Usuário com este nome !!! Tente Novamente</h5>
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
  if(@$_GET['lg'] == 'false') {
?>
<div class="modal fade" id="modalF" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Erro</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Usuário ou senha inválida</h5>
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
window.addEventListener('click', () => {
    window.location.href = 'login.php';
})
</script>
<?php
  }
?>