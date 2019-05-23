<?php
include "../util/conexao.php";
$sql = "SELECT * FROM usuario;";
$query = pg_query($conexao_compartilhada, $sql);
$qtde = pg_affected_rows($query);
include "../template/header.php";
?>

<section class="content-header">
    <h1>
        Lista de Usuários
    </h1>
    <ol class="breadcrumb">
        <li><a href="iuUsuarios.php" class="btn btn-success btn-xs" style="color: white;">Novo</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-striped table-responsive table-hover" style="width: auto !important;">
                <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>LOGIN</th>
                    <th>E-MAIL</th>
                    <th>DATA EXCLUSAO</th>
                    <th>EXCLUÍDO</th>
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
                        <td><?= (!empty($dados["data_exclusao"])) ? date("d/m/Y", strtotime($dados["data_exclusao"])) : null ?></td>
                        <td><?= ($dados["excluido"] == 's') ? '<i class="fas fa-times"></i>' : '-' ?></td>
                        <td>
                            <?php
                            if ($dados["excluido"] == 'n') {
                                ?>
                                <a class="btn btn-warning"
                                   href="iuUsuarios.php?acao=ALTERAR&cod=<?= base64_encode($dados[">

                                    <i class="far fa-edit"></i>
                                </a>&nbsp
                                <a class="btn btn-danger"
                                   href="usuario_model.php?acao=DELETAR&cod=<?= base64_encode($dados[">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <?php
                            } else if ($dados["excluido"] == 's') {
                                ?>
                                <a href="usuario_model.php?acao=RESTAURAR&cod=<?= base64_encode($dados["
                                   class="btn btn-success">

                                    <i class="fa fa-repeat" aria-hidden="true"></i>
                                </a>&nbsp
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
                    <th>LOGIN</th>
                    <th>E-MAIL</th>
                    <th>DATA EXCLUSAO</th>
                    <th>EXCLUÍDO</th>
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
include "../template/footer.php";
?>
</body>
</html>