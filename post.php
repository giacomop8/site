<?php 
require_once("templates/header.php"); 

if(isset($_GET['id'])) {
    $postId = $_GET['id'];
    
    $select = "SELECT * FROM posts WHERE id_post='$postId'";
    $result = mysqli_query($conexao, $select);
    $postAtual = mysqli_fetch_assoc($result);
    mysqli_close($conexao);

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $data = new DateTime($postAtual['date']);

    $dia = strftime('%d', $data->getTimestamp());
    $mes = strftime('%B', $data->getTimestamp());
    $ano = strftime('%Y', $data->getTimestamp());
}

?>
<main>

    <div class="conteudo">
        <!-- LADO ESQUERDO -->
        <section class="left">
            <!-- POSTAGEM DO BANCO DE DADOS -->
            <div class="noticia">        
                <h2><?=$postAtual['title'] ?></h2>    
                <p class="descricao"><?=$postAtual['description'] ?></p>  
                <p class="data"><?= $dia.' de '.$mes.', '.$ano ?></p>  
                <img src="<?=$SITE_RAIZ?>img/posts/<?= $postAtual['title'] ?>.png" alt="<?= $postAtual['title'] ?>">        
                <p class="texto" style="font-size: 2.5em;"><?=$postAtual['text'] ?></p>
            </div>
            
            <!-- PARA COMPARTILHAR NAS REDES -->
            <aside class="redes">
                <div id="share"><p>Compartilhe em sua rede!</p></div>
                <div id="share-icones">
                    <a href="">
                        <img src="img/ico/whatsapp.png" alt="whatsapp">
                    </a>
                    <a href="">            
                        <img src="img/ico/instagramfacebook.png" alt="instagram">
                    </a>
                    <a href="">
                        <img src="img/ico/youtube.png" alt="youtube">
                    </a>
                    <a href="">
                        <img src="img/ico/facebook.png" alt="facebook">
                    </a>
                </div>
            </aside>
        </section>
        <!-- LADO DIREITO -->
        <section class="right">
            <div class="ultimas-noticias">
                <h3>ÚLTIMAS NOTÍCIAS</h3>
                
            </div>
        </section>
        
    </div>

</main>

<?php require_once("templates/footer.php"); ?>