<?php
    session_start();
    include "conectarApeiron.php";
    $pagina = $_POST['page'];
    $sqlEndereco = "SELECT id_endereco FROM endereco WHERE id_usuario =".$_SESSION['id'].";";
    $resultadoBuscaEndereco = pg_query($conecta_Apeiron, $sqlEndereco);
    $total = pg_num_rows($resultadoBuscaEndereco);
    $limite = 9;
    $inicio = ($pagina * $limite) - $limite;
    $tot_pagina = ceil($total / $limite);
    $sqlEnderecoPaginacao = "SELECT id_endereco, endereco, numero FROM endereco WHERE id_usuario =".$_SESSION['id']." LIMIT $limite OFFSET $inicio;";
    $resultadoEndereco = pg_query($conecta_Apeiron, $sqlEnderecoPaginacao);
    $id = 0;
    while($endereco = pg_fetch_array($resultadoEndereco)):
        ?>
            <button id="clickEndereco<?=$id?>" name="#clickEndereco<?=$id?>" value="<?= $endereco['id_endereco']?>" onclick="item('#clickEndereco<?=$id?>')"><i class="far fa-envelope"></i><p><?php echo $endereco['endereco']." n°".$endereco['numero']; ?></p></button>
        <?php
        $id+=1;
    endwhile;
    $anterior = $pagina-1;
    $seguinte =$pagina+1;
    echo"<div style='display: flex; width:100%; justify-content: space-between;'>";
    if($pagina == 1 and $tot_pagina > 1):
        echo "<button onclick='mudaPagina($seguinte)'  style='display: flex; width: 20%; align-items: center; justify-content: center;'><i class='fas fa-angle-right'></i></button>";
    elseif($pagina == $tot_pagina and $tot_pagina > 1):
        echo "<button onclick='mudaPagina($anterior)'  style='display: flex; width: 20%; align-items: center; justify-content: center'><i class='fas fa-angle-left'></i></button>";
    elseif($tot_pagina > 1):
        echo "<button onclick='mudaPagina($anterior)'  style='display: flex; width: 20%; align-items: center; justify-content: center'><i class='fas fa-angle-left'></i></button>";
        echo "<button onclick='mudaPagina($seguinte)'  style='display: flex; width: 20%; align-items: center; justify-content: center'><i class='fas fa-angle-right'></i></button>";
    endif;
    echo"</div>";
    pg_close($conecta_Apeiron);
    
?>