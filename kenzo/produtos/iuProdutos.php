<?php
include "../template/header.php";
include "../util/conexao_produtos.php";
if (isset($_GET["cod"])) {
    $cod = $_GET["cod"]; //
    $sql = "SELECT * FROM rpm.produto WHERE cod=" . base64_decode($cod) . ";";
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
</head>
<body>

<div class="box box-body" style="padding: 2.5%;">
<h1 style="padding
: 5px;"><?= isset($cod) ? "ALTERAR PRODUTOS" : "CADASTRAR PRODUTOS" ?></h1>
<hr>
    <form action="produto_model.php" class="dropzone" method="POST" enctype="multipart/form-data">
        <!--  FORMULÁRIO MODULAR CADASTRO/ALTERAÇÃO COM CONDIÇÕES PHP -->
        <input type="hidden" id="cod" name="cod" value="<?=base64_decode($cod);?>">
        <input type="hidden" id="foto_old" name="foto_old" value="<?= isset($exibe["foto"]) ? $exibe["foto"] : null ?>">
        <!-- NOME (cad/alter) -->
        <div class="form-group">
            <h4> <label for="nome">NOME</label></h4>
            <input type="text" id="nome" class="form-control" name="nome" required
                   value="<?= isset($exibe["nome"]) ? $exibe["nome"] : null ?>"> 
        </div>

        <div class="form-group">
            <h4> <label for="nome">DETALHES</label></h4>
            <input type="text" id="detalhes" class="form-control" name="detalhes" required
                   value="<?= isset($exibe["detalhes"]) ? $exibe["detalhes"] : null ?>"> 
        </div>

        <div class="form-group">
            <h4><label for="text">PRECO</label></h4>
            <input type="number" id="preco" name="preco" class="form-control" required
                   value="<?= isset($exibe["preco"]) ? $exibe["preco"] : null ?>"> 
        </div>
        <div class="form-group">
            <h4><label for="text">CATEGORIA</label></h4>
            <input type="text" id="categoria" name="categoria" class="form-control" required
                   value="<?= isset($exibe["categoria"]) ? $exibe["categoria"] : null ?>">
        </div>
        <div class="form-group">
            <h4><label for="text">ESTOQUE</label></h4>
            <input type="number" id="estoque" name="estoque" class="form-control" required
                   value="<?= isset($exibe["estoque"]) ? $exibe["estoque"] : null ?>">
        </div>

        <div class="form-group">
        <h4><label for="text">COR</label></h4>
        <input type="text" id="cor" name="cor" class="form-control" required
               value="<?= isset($exibe["cor"]) ? $exibe["cor"] : null ?>">
        </div>

        <!-- FOTO DE PRODUTO (cad/alter) TESTAR SE MOSTRA IMAGEM SO NO ALTERAR -->
        <div class="form-group">
            <h4><label for="foto">FOTO DE PERFIL</label></h4>
            <?php
            if (isset($exibe["foto"])) {
                echo '<img src="../imgup/'. $exibe["foto"] . '" alt="ERRO" style="width: auto; height: 150px;" ><br>';
            }
            ?>
            <input class="btn btn-file" type="file" id="myFile" name="foto"><br>
        </div>

        <div class="form-group">
        <hr>
        <center>
            <input  class="btn btn-primary" type="submit" name="acao" id="acao" value="<?= isset($cod) ? "ALTERAR" : "SALVAR" ?>">
            <input class="btn btn-danger" type="reset" value="LIMPAR">
        </center>
         
        </div>

    </form>
</div>

</body>
</html>
<?php
include "../template/js.php";
?>
<script>
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

    $("#myFile").change(function () {
        var ext = $('#myFile').val().split('.').pop().toLowerCase();

        if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
            alert('Insira somente arquivos do tipo: png, jpg e jpeg');
            $("#myFile").val(null);
        }
    });

    $('#myFile').bind('change', function () {

        if (this.files[0].size > 210000) {
            alert("Insira arquivos com até 200kb!");
            $("#myFile").val(null);
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
