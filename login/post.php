<?php

$message = array();

/* HEADER */
include_once("templates/header.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = "SELECT p.id_post, p.title, p.description, p.text, i.path, i.name_image, i.extension
                FROM posts p
                INNER JOIN images i ON p.id_post = i.id_post
                WHERE p.id_post='$id'";

    $query = mysqli_query($conexao, $select);
    $post = mysqli_fetch_assoc($query);    
}

?>

<!-- MAIN -->
<div class="main">
    <main>
        <div class="cadastro">
            <h2><?=$post['title']?></h2>
            <p><?=$post['description']?></p>
            <img src="http://<?=$_SERVER['SERVER_NAME']?>/projetos/site_raiz/uploads/posts/<?=$post['title']?>.<?=$post['extension']?>" alt="<?=$post['name_image']?>">
            <p><?=$post['text']?></p>

            <a href="edit.php?id=<?=$post['id_post']?>"><button type="submit" class="btn btn-primary">Editar postagem</button></a>
        </div>
    </main>
</div>
</body>
</html>