<?php
 	session_start();
    $_SESSION['LOGIN'] = $_GET['logou'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
        
        include "padrao/meta.php";
        ?>
    <title>PESQUISA</title>
</head>
<body>
    <?php
        include "padrao/header.php";
        $nome = $_POST['produto_pesquisado'];
        $cor = $_POST['cor'];
    ?>
    <div class="resultado-pesquisa">
        <?php 
            if (isset($_POST['cor']) and $nome == "")
            {
              ?> 
              <h1>Produto(s) com:</h1>
              <h1>Tom <?php echo $cor; ?></h1> 
            
            <?php  
            }
            else if (isset($_POST['cor']) and isset($_POST['produto_pesquisado']))
            {
              ?>
              <h1>Resultado(s) de pesquisa para:</h1>
              <h1><?php echo $nome; ?> de tom <?php echo $cor; ?></h1> 
            
            <?php    
            }
        
            else
            {
                ?> <h1>Resultado(s) de pesquisa para: "<?php echo $nome; ?>"</h1> 
            <?php
            }
        ?>
    </div>
    <main style="width:100%; display:flex; flex-direction: column; height: 100%; padding:0% calc(0.1 * 100vw) 0%; background-color:white;">
    
    <?php 
        
        $conecta_Apeiron = pg_connect("host=localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
        
        if (isset($_POST['cor']) and $nome == null)
        {
            $sql = "SELECT * FROM rpm.produto WHERE cor = '$cor'";    
        }
        else if (isset($_POST['cor']) and isset($_POST['produto_pesquisado']))
        {
            $sql = "SELECT * FROM rpm.produto WHERE UPPER(nome) LIKE UPPER('%$nome%') and cor = '$cor'";   
        }
        else if ($nome == null and $cor ==null)
        {
            $sql = null; 
        }
        else
        {
            $sql = "SELECT * FROM rpm.produto WHERE UPPER(nome) LIKE UPPER('%$nome%')"; 
        } 
        
        

        $resultado=pg_query($conecta_Apeiron,$sql);
        $qtde=pg_num_rows($resultado);
        
        if ($qtde > 0)
        {
          for ($cont=0; $cont < $qtde; $cont++)
          {
              $linha=pg_fetch_array($resultado);
              echo'
              <div class="encontrado">
                <a href="confirmaCarrinho.php?idProduto='.$linha['cod'].'&img=http://200.145.153.175/pedrocarmo/Apeiron/imgup/'.$linha['foto'].'&detalhes='.$linha['detalhes'].'&nome='.$linha['nome'].'" class="manda_dapesquisa"></a>
                <img src="http://200.145.153.175/pedrocarmo/Apeiron/imgup/'.$linha['foto'].'" alt="" class="foto-encontrada">
                <h2 class="nome-encontrado">
                <i class="fas fa-dot-circle"></i>'.$linha['nome'].'<i class="fas fa-dot-circle"></i>
                </h2>
                <hr>
                <section class="descriccao-encontrado">
                    <i class="fas fa-book-open"></i>
                    <p>
                        '.$linha['detalhes'].'
                    </p>
                </section>
              </div>';
          }
        }
        else 
        {    
         ?>     
        <div class="encontrado">
            <h2 class="nome-naoencontrado">
                <i class="fas fa-window-close"></i>NENHUM PRODUTO FOI ENCONTRADO<i class="fas fa-window-close"></i>
            </h2>
        </div> 
        <?php 
            
        }
        ?>  
    </main>
    <script>
            $(".manda_dapesquisa").hover(function(){
                $(this).css("box-shadow", "0px 0px  20px 2px #ff0000");
                }, function(){
                $(this).css("box-shadow", "none");
            });    
    </script>
    <?php
        include "padrao/footer.php";
    ?>
    
    <!-- 
    CRÉDITOS AO BIBAR E JOÃO GUEDES POR AJUDAREM EXTREMAMENTE, S2 S2 rs
    -->
</body>
</html>