<?php

$message = array();

/* HEADER */
include_once("templates/header.php");


$select = "SELECT * FROM posts ORDER BY date DESC";
$result = mysqli_query($conexao, $select);
mysqli_close($conexao);
$row = mysqli_num_rows($result);

?>

<!-- MAIN -->
<div class="main">
    <main>
        <?php
        
        $posts = array();
        for($i=0; $i<$row; $i++):
            $posts[] = mysqli_fetch_assoc($result);
        endfor;

        if($row == 0) {
            echo "SEM POSTS CADASTRADOS";
        }

        for($i=0; $i<$row; $i++):
            $post = $posts[$i];
            $id = $post['id_post'];
        ?>
            <div class="post">
                <section class="linha1">
                    <div class="titulo">
                        <?= $post['title'] ?>
                    </div>
                    <div class="botoes">
                        <a href="post.php?id=<?=$id?>"><button class="btn btn-secondary">Ver Post</button></a>&nbsp;
                        <a href="edit.php?id=<?=$id?>"><button class="btn btn-secondary">Editar</button></a>&nbsp;
                        <a href="delete.php?id=<?=$id?>"><button class="btn btn-secondary">Apagar</button></a>
                    </div>
                </section><hr>
                <section class="linha2">
                    <p></p>
                    <?php
                        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                        date_default_timezone_set('America/Sao_Paulo');

                        $data = new DateTime($post['date']);

                        $dia = strftime('%d', $data->getTimestamp());
                        $mes = strftime('%B', $data->getTimestamp());
                        $ano = strftime('%Y', $data->getTimestamp());
                        $hora = strftime('%H', $data->getTimestamp());
                        $minuto = strftime('%M', $data->getTimestamp());
                        $segundo = strftime('%S', $data->getTimestamp());
                        
                    ?>
                    <input class="dataDia" type="text" value="<?= $dia ?>">
                    -<input class="dataMes" type="text" value="<?= $mes ?>">
                    -&nbsp;<input class="dataAno" type="text" value="<?= $ano ?>">
                    |&nbsp;<input class="hora" type="text" value="<?= $hora ?>">h:&nbsp;
                    <input class="hora" type="text" value="<?= $minuto ?>">m:&nbsp;
                    <input class="hora" type="text" value="<?= $segundo ?>">s   
                </section>
            </div>
        <?php endfor; ?>
    </main>
</div>
</body>
</html>