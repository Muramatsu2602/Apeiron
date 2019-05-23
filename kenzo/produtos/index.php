<?php
session_start();
include "../util/conexao_produtos.php";
$sql = "SELECT * FROM rpm.produto;";
$query = pg_query($conexao, $sql);
$qtde = pg_affected_rows($query);
include "../template/header.php";
?>

<section class="content-header">
    <h1>
        Lista de Produtos
    </h1>
    <ol class="breadcrumb">
        <li><a href="iuProdutos.php" class="btn btn-success btn-xs" style="color: white;">Novo</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-striped table-responsive table-hover table-dark"
                   style="width: auto !important;">
                <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>NOME</th>
                    <th>ESTOQUE</th>
                    <th>CATEGORIA</th>
                    <th>EXCLUÍDO</th>
                    <th>DATA DE EXCLUSÃO</th>
                    <th> AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($dados = pg_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $dados["cod"] ?></td>
                        <td><?= $dados["nome"] ?></td>
                        <td><?= $dados["estoque"] ?></td>
                        <td><?= $dados["categoria"] ?></td>
                        <td><?= ($dados["excluido"] == 't') ? '<i class="fas fa-times"></i>' : '-' ?></td>
                        <td><?= ($dados["excluido"] == 't') ? date("d/m/Y", strtotime($dados["data_exclusao"])) : '-' ?></td>
                        <td>
                            <?php
                            if ($dados["excluido"] == 'f') {
                                ?>
                                <a class="btn btn-warning"
                                   href="iuProdutos.php?acao=ALTERAR&cod=<?= base64_encode($dados["cod"]) ?>">

                                    <i class="far fa-edit"></i>
                                </a>&nbsp
                                <button type="button" class="btn btn-danger" onclick="deletar(<?= $dados["cod"] ?>)"><i
                                            class="far fa-trash-alt"></i></button>
                                <?php
                            } else if ($dados["excluido"] == 't') {
                                ?>
                                <button type="button" class="btn btn-success" onclick="recuperar(<?= $dados["cod"] ?>)">
                                    <i
                                            class="fa fa-repeat"></i></button>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>CÓDIGO</th>
                    <th>NOME</th>
                    <th>ESTOQUE</th>
                    <th>CATEGORIA</th>
                    <th>EXCLUÍDO</th>
                    <th>DATA DE EXCLUSÃO</th>
                    <th> AÇÕES</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

<script>

    <?php
    if(isset($_SESSION["salvo"])){
    ?>
    swal("Mensagem!", "Usuario <?=$_SESSION["salvo"]?>!", "success");
    <?php
    unset($_SESSION["salvo"]);
    }
    ?>

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
                            window.location.href = "http://200.145.153.175/marcosdias/apeiron/index.php";
                        }
                    });
                } else {
                    swal({
                        title: "Não Sairei!",
                        icon: "error",
                        button: "OK",
                    });
                }
            });
    }


    // FUNCAO DESDELETAR (chamada pelo botao de recuperar)
    function recuperar(cod) {

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
                        url: 'produto_model.php',
                        method: 'GET',
                        data: {
                            acao: "RESTAURAR",
                            'cod': cod
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
                    closeModal: false,
                },
                confirm: {
                    text: "Deletar!",
                    value: true,
                    visible: true,
                    className: "swal-button--danger",
                    closeModal: true
                }
            }
        })
            .then((confirm) => {
                if (confirm) {
                    $.ajax({
                        url: 'produto_model.php',
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
include "../template/js_produtos.php";
include "../template/footer.php";
?>

</body>
</html>