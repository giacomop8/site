<?php 
include_once("templates/header.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = "SELECT p.id_post, p.title, p.description, p.text, p.date, i.path, i.name_image, i.extension
                FROM posts p
                INNER JOIN images i ON p.id_post = i.id_post
                WHERE p.id_post='$id'";

    $query = mysqli_query($conexao, $select);
    $postAtual = mysqli_fetch_assoc($query);

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
                <img src="http://<?=$_SERVER['SERVER_NAME']?>/projetos/site_raiz/uploads/posts/<?=$postAtual['title']?>.<?=$postAtual['extension']?>" alt="<?= $postAtual['name_image'] ?>">        
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