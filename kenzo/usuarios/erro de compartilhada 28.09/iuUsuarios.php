<?php
include "../template/header.php";
include "../util/conexao.php";
if (isset($_GET["cod"])) {
    $cod = $_GET["cod"]; //
    $sql = "SELECT * FROM rpm.usuario WHERE cod=" . base64_decode($cod) . ";";
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
<h1 style="padding-top: 5px;"><?= isset($cod) ? "ALTERAR USUÁRIOS" : "CADASTRAR USUÁRIOS" ?></h1>
<div class="box box-body" style="padding: 2.5%;">
    <form action="usuario_model.php" class="dropzone" method="POST" enctype="multipart/form-data">
        <!--  FORMULÁRIO MODULAR CADASTRO/ALTERAÇÃO COM CONDIÇÕES PHP -->
        <input type="hidden" id="cod" name="cod" value="<?=base64_decode($cod);?>">
        <input type="hidden" id="foto_old" name="foto_old" value="<?= isset($exibe["foto"]) ? $exibe["foto"] : null ?>">
        <!-- NOME (cad/alter) -->
        <div class="form-group">
            <h4> <label for="nome">NOME</label></h4>
            <input type="text" id="nome" class="form-control" name="nome" required
                   value="<?= isset($exibe["nome"]) ? $exibe["nome"] : null ?>"> <br>
        </div>
        <!-- SENHA (cad/alter) -->
        <div class="form-group">
            <?php
            if (!isset($cod))
            {
            ?>
            <h4><label for="senha">SENHA  </label> <meter role="progressbar" value="0" id="mtSenha" max="30"></meter> </h4>  &nbsp;

                <input type="password" id="senha"  name="senha" class="form-control" required>
            <br>
        </div>

        <div class="form-group">
            <h4><label  for="confirma_senha"> CONFIRMAR SENHA</label></h4>
            <input type="password" id="confirma_senha" class="form-control" name="confirma_senha" required>
        </div>

        <?php
        }
        ?>
        <!-- E-MAIL -->
        <div class="form-group">
            <h4><label for="email">E-MAIL</label></h4>
            <input type="email" id="email" name="email" class="form-control" required
                   value="<?= isset($exibe["email"]) ? $exibe["email"] : null ?>"> <br>
        </div>
        <!--DATA DE NASCIMENTO (cad/alter) -->
        <div class="form-group">
            <h4><label for="data_nasc">DATA DE NASCIMENTO</label></h4>
            <input type="text" class="mask_date form-control" id="data_nasc" name="data_nasc" required
                   value="<?= isset($exibe["data_nasc"]) ? date('d/m/Y', strtotime($exibe["data_nasc"])) : null ?>"> <br>
        </div>
        <!-- SEXO (cad/alter?) ver se isset do campo ta printando  -->
        <div class="form-group">
            <h4> <label for="sexo">SEXO</label>  <br>
            <input type="radio" name="sexo" id="sexoM" value="M"
                <?= ($exibe["sexo"] == 'M') ? 'checked' : null ?>> Masculino <br>
            <input type="radio" name="sexo" id="sexoF" value="F"
                <?= ($exibe["sexo"] == 'F') ? 'checked' : null ?>> Feminino<br>
            </h4>
        </div>
        <!--PRIVILEGIO () -->
        <div class="form-group">
            <h4><label for="priveligio">PRIVILEGIO</label> <br>
            <input type="radio" name="privilegio" value="f"
                <?= ($exibe["privilegio"] == 'f') ? 'checked' : null ?>>
            Usuário<br>
            <input type="radio" name="privilegio" value="t"
                <?= ($exibe["privilegio"] == 't') ? 'checked' : null ?>>
            Administrador<br>
            </h4>
        </div>
        <!-- FOTO DE PERFIL (cad/alter) TESTAR SE MOSTRA IMAGEM SO NO ALTERAR -->
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
            <input  class="btn btn-primary" type="submit" name="acao" id="acao" value="<?= isset($cod) ? "ALTERAR" : "SALVAR" ?>">
            <input class="btn btn-danger" type="reset" value="LIMPAR">
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

        if (this.files[0].size > 100000) {
            alert("Insira arquivos com até 100kb!");
            $("#myFile").val(null);
        }


    });
</script>
<?php
include "../template/footer.php";
?>
