<?php

$message = array();

/* HEADER */
include_once("templates/header.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $selectId = "SELECT * FROM posts WHERE id_post='$id'";
    $query = mysqli_query($conexao, $selectId);    
    $post = mysqli_fetch_assoc($query);    
}

?>

<!-- MAIN -->
<div class="main">
    <main>
        <div class="cadastro">             
            <h2><?=$post['title']?></h2>
            <p><?=$post['description']?></p>
            <img src="<?=$SITE_RAIZ?>img/posts/<?=$post['title']?>.jpg" alt="<?=$post['title']?>">
            <p><?=$post['text']?></p>

            <a href="edit.php?id=<?=$post['id_post']?>"><button type="submit" class="btn btn-primary">Editar postagem</button></a>
        </div>
    </main>
</div>
</body>
</html>