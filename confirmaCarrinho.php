<?php
    session_start();
    $id = $_GET['idProduto'];
    include "executa/conectarApeiron.php";
    $sqlBusca = "SELECT cod FROM rpm.carrinho WHERE cod_usu=".$_SESSION['id'].";";
    $buscaCarrinho = pg_query($conecta_Apeiron, $sqlBusca);
    $tabelaCarrinho = pg_fetch_array($buscaCarrinho);
    $sqlVereficaItemCompra = "SELECT id_carrinho FROM rpm.item_carrinho WHERE id_carrinho =".$tabelaCarrinho['cod']." AND cod_produto = $id;";
    $resultadoVerefica = pg_query($conecta_Apeiron, $sqlVereficaItemCompra);
    $existe = pg_num_rows($resultadoVerefica);
    $sqlMaximo = "SELECT estoque FROM rpm.produto WHERE cod = $id;";
    $resultadoSqlMaximo = pg_query($conecta_Apeiron, $sqlMaximo);
    $numEstoque = pg_fetch_array($resultadoSqlMaximo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <?php
    include "padrao/meta.php";
    ?>
    
    <title>Confirma Carrinho</title>
</head>
<body>
    <?php
    include "padrao/header.php";
    ?>
    <section class="bannerCompra">
    </section>
    <section class="itemDecora">
        <article class="explica">
            <p>Aqui você coloca no carrinho, não significa que a compra foi confirmada.</p>
        </article>
        <article class="explica">
            <p>Aqui, voce escolhe o quanto deseja levar, há apresentação mais detalhada.</p>
        </article>
        <article class="explica">
            <p>Faça boas compras</p>
        </article>
    </section>
    <main class="confirmacao">
        <img src="<?= $_GET['img']?>" alt="" class="mostraProduto">
        <h2 class="tit"><i class="far fa-star"></i><?= $_GET['nome']?><i class="far fa-star"></i></h2>
        <hr>
        <section class="contemDescricao">
            <i class="fas fa-book-open"></i>
            <p>
                <?= $_GET['detalhes']; ?>
            </p>
        </section>
        <form action="" class="cadastraItemCarrinho" id="confirmaCarrinho">
            <input type="number" class="input localiza <?php if($numEstoque['estoque'] == 0):?>disabled<?php endif; ?>" min="1" max="<?= $numEstoque['estoque'] ?>" style="padding: 0;" placeholder="n° de botton" name="quantidade" <?php if($numEstoque['estoque'] == 0):?>disabled<?php endif; ?> >
            <div class="envolveCompra">
               <input type="reset" class="<?php if($existe == 0): ?>disabled<?php endif; ?> input" value="EXCLUIR" <?php if($existe == 0): ?> disabled <?php endif; ?> id="excluiRegistro" onclick="excluir()">
               <input type="hidden" value="<?= $id ?>" name="codProduto">
               <input type="hidden" value="<?= $numEstoque['estoque'] ?>" name="valorMaxEstoque" >
               <?php
                if($existe != 0):
                      ?>
                          <input type="hidden" value="true" name="e?carrinho">
                      <?php
                endif;
                ?>
               <input type="hidden" value="<?= $numEstoque['estoque'] ?>" name="valorMaxEstoque" >
               <input type="submit" class="<?php if(!isset($_SESSION['id'])): ?>disabled<?php endif; ?> input" value="CONFIRMAR"<?php if(!isset($_SESSION['id'])): ?> disabled <?php endif; ?> >
            </div>
        </form>
    </main>
    <script>
        function excluir() {
            $.ajax({
                url: 'executa/excluiCarrinho.php',
                type: 'post',
                data: $('#confirmaCarrinho').serialize(),
                success: function(data) {
                    alert("Excluído com sucesso!");
                    window.close('this');
                },
                error: function() {
                    alert("erro");
                }
            });
        }
        $('#confirmaCarrinho').submit(function(e) {
            e.preventDefault();
            $('#confirmaCarrinho').prop("disabled",true);
            $.ajax({
                url: 'executa/colocaCarrinho.php',
                type: 'post',
                data: $('#confirmaCarrinho').serialize(),
                success: function(data) {
                    alert(data);
                    window.close('this');
                },
                error: function() {
                    alert("erro");
                }
            });
        });
        
    </script>
    <?php
    include "padrao/footer.php";
    pg_close($conecta_Apeiron);
    ?>
</body>
</html>