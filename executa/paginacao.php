<?php
    include "conectarApeiron.php";
    $pagina = $_POST['page'];
    $sectionTema = $_POST['section'];
    $limite = $_POST['item'];
    switch($sectionTema):
        case 1:
            $sqlContagem ="SELECT cod FROM rpm.produto WHERE categoria = 'politica' AND excluido = FALSE;";
            $tema ='politica';
            break;
        case 2:
            $sqlContagem ="SELECT cod FROM rpm.produto WHERE categoria = 'cultura pop' AND excluido = FALSE;";
            $tema ='cultura pop';
            break;
        case 3:
            $sqlContagem ="SELECT cod FROM rpm.produto WHERE categoria = 'cti' AND excluido = FALSE;";
            $tema ='cti';
            break;
    endswitch;
    $contagem = pg_query($conecta_Apeiron, $sqlContagem);
    $total = pg_num_rows($contagem);
    $tot_pagina = ceil($total / $limite);
    $inicio = ($pagina * $limite) - $limite;
    $efectJs = ($sectionTema - 1) * $limite + 1;
    $sql ="SELECT cod, nome, detalhes, preco, estoque, foto FROM rpm.produto WHERE categoria = '$tema' AND excluido = FALSE LIMIT $limite OFFSET $inicio;";
    $resultado = pg_query($conecta_Apeiron, $sql);
    $qtd = pg_num_rows($resultado);
    if($qtd > 0):
        while($linha = pg_fetch_array($resultado)):
            ?>
            <?php
                if($linha['estoque'] > 0):
            ?>
            <section class="blocoCompra" onmouseenter="apareceCompra('#p<?= $efectJs; ?>')" onmouseleave="desapareceCompra('#p<?= $efectJs; ?>')" onclick="desapareceCompra('#p<?= $efectJs; ?>')">
            <?php
                else:
            ?>
            <section class="blocoCompra">
            <?php
                endif;
            ?>
                <img src="http://200.145.153.175/pedrocarmo/Apeiron/imgup/<?= $linha['foto']; ?>" alt="">
                <p>
                    <?= $linha['nome']; ?>
                </p>
                <hr>
                <p>
                    <?= $linha['preco']; ?>
                </p>
                <hr id="" class="carrega">
                <a href="confirmaCarrinho.php?idProduto=<?= $linha['cod'] ?>&img=http://200.145.153.175/pedrocarmo/Apeiron/imgup/<?= $linha['foto']?>&detalhes=<?= $linha['detalhes']?>&nome= <?= $linha['nome'] ?>" class="compra" id="p<?php echo $efectJs; ?>" target="_blank">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <?php
                    if($linha['estoque'] == 0):
                ?>
                        <div class="sem-estoque">
                            <i class="fas fa-archive"></i>
                            <p>FIM DE ESTOQUE</p>
                        </div>
                <?php
                    endif;
                ?>
            </section>
            <?php
            $efectJs += 1;
        endwhile;
    else:
        echo "erro".$limite."sda";
    endif;
    pg_close($conecta_Apeiron);
    $anterior = $pagina-1;
    $seguinte =$pagina+1;
    if($pagina == 1 and $tot_pagina > 1):
       echo "<a onclick='mudaPagina($seguinte,$sectionTema)' class='seta right' ><i class='fas fa-angle-right'></i></a>";
    elseif($pagina == $tot_pagina and $tot_pagina > 1):
        echo "<a  onclick='mudaPagina($anterior,$sectionTema)' class='seta left'><i class='fas fa-angle-left'></i></a>";
    elseif($tot_pagina > 1):
        echo "<a onclick='mudaPagina($anterior,$sectionTema)' class='seta left' ><i class='fas fa-angle-left'></i></a>";
        echo "<a onclick='mudaPagina($seguinte,$sectionTema)' class='seta right'><i class='fas fa-angle-right'></i></a>";
    endif;

?>