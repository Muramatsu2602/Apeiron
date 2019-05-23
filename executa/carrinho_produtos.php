<?php
    session_start();
    include "conectarApeiron.php";
    $id = $_SESSION['id'];
    $pagina = $_POST['page'];
    $sqlBuscaCodCarrinho = "SELECT cod FROM rpm.carrinho WHERE cod_usu = $id";
    $resultado = pg_query($conecta_Apeiron, $sqlBuscaCodCarrinho);
    $codCarrinho=pg_fetch_array($resultado);
    $sqlContagem ="SELECT rpm.produto.nome, rpm.produto.detalhes, rpm.produto.cod, rpm.produto.preco,rpm.produto.foto,rpm.item_carrinho.qtde,rpm.item_carrinho.valor FROM rpm.item_carrinho,rpm.produto WHERE rpm.item_carrinho.cod_produto = rpm.produto.cod AND rpm.item_carrinho.id_carrinho =".$codCarrinho['cod'].";";
    $contagem = pg_query($conecta_Apeiron, $sqlContagem);
    $total = pg_num_rows($contagem);
    $limite = 5;
    $tot_pagina = ceil($total / $limite);
    $inicio = ($pagina * $limite) - $limite;
    $sqlBuscaCarrinho = "SELECT rpm.produto.nome, rpm.produto.detalhes, rpm.produto.cod, rpm.produto.preco,rpm.produto.foto,rpm.item_carrinho.qtde,rpm.item_carrinho.valor FROM rpm.item_carrinho,rpm.produto WHERE rpm.item_carrinho.cod_produto = rpm.produto.cod AND rpm.item_carrinho.id_carrinho =".$codCarrinho['cod']." LIMIT $limite OFFSET $inicio";
    $resultprodutos = pg_query($conecta_Apeiron, $sqlBuscaCarrinho);
    $num=pg_num_rows($resultprodutos);
    if($num == 0):
        echo "<p style='color: red;'>VAZIO</p>";
    else:
        ?>
        <div class="carrinho-conteudo">
        <?php
        while($linha=pg_fetch_array($resultprodutos)):
        ?>
            <div class="carrinho-item">
                <img src="http://200.145.153.175/pedrocarmo/Apeiron/imgup/<?= $linha['foto']?>" alt="" class="carrinho-imagem">
                <div class="carrinho-descricao">
                    <h4><?= $linha['nome'] ?></h4>
                    <p><?= $linha['valor'] ?></p>
                    <p>QUANTIDADE:<?= $linha['qtde'] ?></p>
                </div>
                <a href="confirmaCarrinho.php?idProduto=<?= $linha['cod'] ?>&img=http://200.145.153.175/pedrocarmo/Apeiron/imgup/<?= $linha['foto']?>&detalhes=<?= $linha['detalhes']?>&nome= <?= $linha['nome'] ?>" class="carrinho-link" target="_blank">
                    <i class="fas fa-pen-square"></i>
                </a>
            </div>
        <?php
        endwhile;
        ?>
        </div>
        <div class="carrinho-confirma">
            <div class="carrinho-segura-seta">
        <?php
        pg_close($conecta_Apeiron);
        $anterior = $pagina-1;
        $seguinte =$pagina+1;
        if($pagina == 1 and $tot_pagina > 1):
            echo "<button onclick='carrinho($seguinte)' class='carrinho-seta' ><i class='fas fa-angle-right'></i></button>";
        elseif($pagina == $tot_pagina and $tot_pagina > 1):
            echo "<button  onclick='carrinho($anterior)' class='carrinho-seta'><i class='fas fa-angle-left'></i></button>";
        elseif($tot_pagina > 1):
            echo "<button onclick='carrinho($anterior)' class='carrinho-seta' ><i class='fas fa-angle-left'></i></button>";
            echo "<button onclick='carrinho($seguinte)' class='carrinho-seta'><i class='fas fa-angle-right'></i></button>";
        endif;
        ?>
            </div>
            <form style="padding: 0 0 0 62%">
               <a href=".//cadastro_cliente.php" class="input" id="carrinho-compra">COMPRAR</a>
               <button id="carrinho-exclui" class="input">EXCLUIR</button>
               <script src="js/clickLimpar.js" type="text/javascript"></script>
            </form>
        </div>
        <?php
    endif;
?>

