<?php
session_start();
include "../template/header.php";
include "../util/conexao.php";
if (isset($_GET["cod"])) {
    $cod = $_GET["cod"]; //
    $sql = "SELECT * FROM usuario WHERE id_usuario=" . base64_decode($cod) . ";";
    $resultado = pg_query($conexao, $sql);
    $qtde = pg_num_rows($resultado);
    if ($qtde > 0) {
        $exibe = pg_fetch_array($resultado);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pedro 72B">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($cod) ? "ALTERAR " : "CADASTRAR" ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box box-body " style="">
<h1 style="padding
: 5px;"><?= isset($cod) ? "ALTERAR PRODUTOS" : "CADASTRAR PRODUTOS" ?></h1>
<hr>
    <form action="usuario_model.php" class="dropzone" method="POST" enctype="multipart/form-data">
        <!--  FORMULÁRIO MODULAR CADASTRO/ALTERAÇÃO COM CONDIÇÕES PHP -->
        <input type="hidden" id="cod" name="cod" value="<?=base64_decode($cod);?>">
        <!-- NOME (cad/alter) -->
        <div class="form-group">
            <h4> <label for="nome">LOGIN</label></h4>
            <input type="text" id="nome" class="form-control" name="nome" required
                   value="<?= isset($exibe["login"]) ? $exibe["login"] : null ?>">
        </div>
        <!-- SENHA (cad/alter) -->
        <div class="form-group ">
            <?php
            if (!isset($cod))
            {
            ?>
                <h4><label for="senha">SENHA </label> <meter id="mtSenha" min="0" max="50" low="8" high="15" optimum="20" ></meter> </h4>
                <input type="password" id="senha"  name="senha" class="form-control" required>
        </div>

        <div class="form-group">
                <h4><label  for="confirma_senha"> CONFIRMAR SENHA</label></h4>
                <input type="password" id="confirma_senha" class="form-control" name="confirma_senha" required>
            <?php
            }
            ?>

        </div>
        <!-- E-MAIL -->
        <div class="form-group">
            <h4><label for="email">E-MAIL</label></h4>
     
            <input type="email" id="email" name="email" class="form-control" required
                   value="<?= isset($exibe["email"]) ? $exibe["email"] : null ?>">

        </div>

        <!--PRIVILEGIO () -->
        <div class="form-group">
            <h4><label for="priveligio">PRIVILEGIO</label> <br>
                <input type="radio" name="privilegio" value="f"
                    <?= ($exibe["privilegio"] == 'f' || isset($cod) == false) ? 'checked' : null ?>>
                Usuário<br>
                <input type="radio" name="privilegio" value="t"
                    <?= ($exibe["privilegio"] == 't') ? 'checked' : null ?>>
                Administrador
            </h4>
        </div>
        <hr>
       <center>
            <div class="form-group">
                <input  class="btn btn-primary" type="submit" name="acao" id="acao" value="<?= isset($cod) ? "ALTERAR" : "SALVAR" ?>"> &nbsp;
                <input class="btn btn-danger" type="reset" value="LIMPAR">
            </div>
        </center>
    </form>
</div>

</body>
</html>
<?php
include "../template/js.php";
?>
<script>
    
    <?php
    if(isset($_SESSION["duplicata"])){
    ?>
    swal("ERRO!", " <?=$_SESSION["duplicata"]?>!", "error");
    <?php
    unset($_SESSION["duplicata"]);
    }
    ?>

    $("form").validate({
        rules: {
            senha: {
                equalTo: "#confirma_senha"
            },
            confirma_senha: {
                equalTo: "#senha"
            }

        }
    });



<?php
if(isset($_SESSION["salvo"])){
?>
swal("Mensagem!", "Usuario <?=$_SESSION["salvo"]?>!", "success");
<?php
unset($_SESSION["salvo"]);
}
?>

// FUNCAO SAIR (deseja sair?)
function sair() {
    swal({
        title: "Sair",
        text: "Deseja Realmente Sair, Admin?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Ficar",
                value: null,
                visible: true,
                className: "",
                closeModal: false,
            },
            confirm: {
                text: "Sair!",
                value: true,
                visible: true,
                className: "swal-button-danger",
                closeModal: false
            }
        }
    })
        .then((confirm) => {
            if (confirm) {
                $.ajax({
                    url: 'index.php',
                    method: 'POST',
                    success: function (data) {
                        swal("ADEUS", {
                            icon: "success",
                        });
                        window.location.href = "../apeiron/index.php";
                    }
                });
            } else {
                swal({
                    title: "Não Sairei!",
                    icon: "error",
                    button: "OK",
                });                }
        });
}


// FUNCAO DESDELETAR (chamada pelo botao de recuperar)
function recuperar(id_usuario) {

    swal({
        title: "Recuperar Registro",
        text: "Deseja realmente recuperar?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "Recuperar!",
                value: true,
                visible: true,
                className: "swal-button--danger",
                closeModal: false
            }
        }
    })
        .then((confirm) => {
            if (confirm) {
                $.ajax({
                    url: 'usuario_model.php',
                    method: 'GET',
                    data: {
                        acao: "RESTAURAR",
                        'cod': id_usuario
                    },
                    success: function (data) {
                        swal("Cadastro Restaurado com Sucesso!", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });

            } else {
                swal({
                    title: "Operação Cancelada!",
                    text: "Restauração Abortada pelo ADM!",
                    icon: "error",
                    button: "OK",
                });
            }
        });
}

// FUNCAO DE DELETAR (chamada pelo botao deletar)
function deletar(id_usuario) {
    swal({
        title: "Deletar Registro",
        text: "Deseja realmente excluir?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "Deletar!",
                value: true,
                visible: true,
                className: "swal-button--danger",
                closeModal: false
            }
        }
    })
        .then((confirm) => {
            if (confirm) {
                $.ajax({
                    url: 'usuario_model.php',
                    method: 'GET',
                    data: {
                        acao: "DELETAR",
                        'cod': id_usuario
                    },
                    success: function (data) {
                        swal("Cadastro Deletado com Sucesso!", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });

            } else {
                swal({
                    title: "Operação Cancelada!",
                    text: "Deleção Abortada pelo ADM!",
                    icon: "error",
                    button: "OK",
                });

            }
        });
}


</script>
<?php
include "../template/footer.php";
?>
