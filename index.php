<?php require_once("templates/header.php"); ?>

<main>
    <div class="container">
        <!-- SLIDE INDEX -->
        <div id="mainSlider" class="carousel slide" date-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
                <li data-target="#mainSlider" data-slide-to="1"></li>
                <li data-target="#mainSlider" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/slide/banner1.png" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Quer criar uma empresa?</h2>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="img/slide/banner2.png" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Quer criar uma empresa?</h2>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="img/slide/banner3.png" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Quer criar uma empresa?</h2>
                    </div>
                </div>
            </div>
        </div> 
        <br><br><hr>

        <div>

        </div>
        <hr>

        <!-- ÚLTIMOS POSTS -->
        <div class="todasNoticias">
            <h1>TODAS AS NOTÍCIAS</h1>
        </div>
        
        <div id="posts-container">
        <?php

        $posts = array();
        for($i=0; $i<$row; $i++):
            $posts[] = mysqli_fetch_assoc($result);
        endfor;

        /* SE NÃO HOUVER POSTS NO BANCO DE DADOS */
        if(count($posts) == 0):
            echo "SEM POSTS";
            
        /* CASO TENHA MENOS DE 5 POSTS NO BANCO DE DADOS */
        elseif(count($posts) < 6):
         
            $contador = count($posts);

            for($i=0; $i<$contador; $i++):            
                $post = $posts[$i];                

                setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');

                $data = new DateTime($post['date']);

                $dia = strftime('%d', $data->getTimestamp());
                $mes = strftime('%B', $data->getTimestamp());
                $ano = strftime('%Y', $data->getTimestamp());
            ?>
                <div class="post-box">
                    <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><img src="<?=$SITE_RAIZ?>img/posts/<?= $post['title'] ?>.jpg" alt="<?= $post['title'] ?>"></a>
                    <div class="post-title">
                        <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><?= strtoupper($post['title']) ?></a> <br>
                    </div>
                    <div class="post-data">
                        <p><?= $dia.' de '.$mes.', '.$ano ?></p>
                    </div>
                    <div class="post-description">
                        <p><?= $post['description'] ?></p>
                    </div>
                    <div class="post-saiba-mais">
                        <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><button class="btn btn-danger">Leia mais...</button></a>
                    </div>
                </div>
            <?php endfor;?>
        
        <!-- CASO TENHA 5 OU MAIS POSTAGENS NO BANCO DE DADOS -->
        <?php else: ?>
            <?php for($i=0; $i<6; $i++):            
                $post = $posts[$i];

                setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');

                $data = new DateTime($post['date']);

                $dia = strftime('%d', $data->getTimestamp());
                $mes = strftime('%B', $data->getTimestamp());
                $ano = strftime('%Y', $data->getTimestamp());
            ?>
                <div class="post-box">
                    <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><img src="<?=$SITE_RAIZ?>img/posts/<?= $post['title'] ?>.jpg" alt="<?= $post['title'] ?>"></a>
                    <div class="post-title">
                        <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><?= $post['title'] ?></a> <br>
                    </div>
                    <div class="post-data">
                        <p><?= $dia.' de '.$mes.', '.$ano ?></p>
                    </div>
                    <div class="post-description">
                        <p><?= $post['description'] ?></p>
                    </div>
                    <div class="post-saiba-mais">
                        <a href="<?=$SITE_RAIZ?>post.php?id=<?= $post['id_post'] ?>"><button class="btn btn-danger">Leia mais...</button></a>
                    </div>
                </div>
            <?php endfor;?>
        <?php endif; ?>

    </div>
    <div class="btn-noticias">
        <button class="btn btn-danger">TODAS AS NOTÍCIAS</button>
    </div>
</main>

<?php require_once("templates/footer.php"); ?>