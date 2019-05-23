<?php
session_start();
include "../util/conexao.php";
$sql = "SELECT * FROM usuario;";
$query = pg_query($conexao, $sql);
$qtde = pg_affected_rows($query);
include "../template/header.php";
?>

<section class="content-header">
    <h1>
        Lista de Usuários
    </h1>
    <ol class="breadcrumb">
        <li><a href="iuUsuarios.php" class=" btn btn-success btn-xs " style="color: white;" >Novo</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-striped table-responsive table-hover"
                   style="width: auto !important;">
                <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>EXCLUÍDO</th>
                    <th>DATA DE EXCLUSAO</th>
                    <th>PRIVILEGIO</th>
                    <th> AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($dados = pg_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $dados["id_usuario"] ?></td>
                        <td><?= $dados["login"] ?></td>
                        <td><?= $dados["email"] ?></td>
                        <td><?= ($dados["excluido"] == 's') ? '<i class="fas fa-times"></i>' : '-' ?></td>
                        <td><?= ($dados["excluido"] == 's') ? date("d/m/Y", strtotime($dados["data_exclusao"])) : '-' ?></td>
                        <td><?= ($dados["privilegio"] == 'f') ? "Usuario" : "Admin" ?></td>
                        <td>
                            <?php
                            if ($dados["excluido"] == 'n') {
                                ?>
                                <a class="btn btn-warning"
                                   href="iuUsuarios.php?acao=ALTERAR&cod=<?= base64_encode($dados["id_usuario"]) ?>">

                                    <i class="far fa-edit"></i>
                                </a>&nbsp
                                <button type="button" class="btn btn-danger" onclick="deletar(<?= $dados["id_usuario"] ?>)"><i
                                            class="far fa-trash-alt"></i></button>

                                <?php
                            } else if ($dados["excluido"] == 's') {
                                ?>
                                <button type="button" class="btn btn-success" onclick="recuperar(<?= $dados["id_usuario"] ?>)"><i
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
                    <th>E-MAIL</th>
                    <th>EXCLUÍDO</th>
                    <th>DATA DE EXCLUSAO</th>
                    <th>PRIVILEGIO</th>
                    <th> AÇÕES</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<?php
include "../template/js.php";
/*
 *
 * <script>

    <?php
    if (isset($_SESSION['salvo'])){
    ?>

    swal(
        '<?=$_SESSION["salvo"]?>',
        'com Sucesso!!',
        '<?=$_SESSION["salvo"] == "Salvo" ? "success" : "success"?>',
    )
    <?php
    }
    ?>
</script>
 *
 *
 * */
?>

<script>

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
                            window.location.href = "http://200.145.153.175/marcosdias/apeiron/index.php";
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
</body>
</html>