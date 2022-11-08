<?php

$message = array();

/* HEADER */
include_once("templates/header.php");


if(isset($_GET['id'])){

    $id = $_GET['id'];
    $selectId = "SELECT p.id_post, p.title, p.description, p.text, p.date, i.name_image, i.extension, i.path
                            FROM posts p
                            INNER JOIN images i ON p.id_post = i.id_post
                            WHERE p.id_post='$id'";
    $query = mysqli_query($conexao, $selectId);    
    $post = mysqli_fetch_assoc($query);
}
?>

<!-- MAIN -->
<div class="main">
    <main>
        <div class="cadastro">
           <form action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$post['id_post']?>">
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Digite o título da postagem" value="<?=$post['title']?>">
                </div><br>

                <div class="form-group">
                    <label>Descrição breve:</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Digite um resumo" value="<?=$post['description']?>">
                </div><br>
                
                <div class="form-group">
                    <label>Texto completo:</label>
                    <textarea type="text" id="trumbowyg-editor" name="texto" class="form-control" rows="10" placeholder="Digite o texto completo da postagem"><?=$post['text']?></textarea>
                </div><br>

                <div class="form-group">
                    <label>Inserir imagem:</label><br>
                    <input class="form-control" type="file" name="imagem" multiple="multiple">
                </div><br>

                <div class="fomr-group">
                    <label>Data/Hora:</label><br>
                    <input class="form-control" type="datetime-local" name="data" id="" value="<?=$post['date']?>">
                </div><br>
                <button type="submit" name="editpost" class="btn btn-primary">Editar postagem</button>
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="dist/trumbowyg.min.js"></script>
            <script>
                $('#trumbowyg-editor').trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'], // Only supported in Blink browsers
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['link'],
                        ['insertImage'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat', true],
                        ['fullscreen']
                    ],
                    autogrow: true
                });
            </script>
        </div>
    </main>
</div>
</body>
</html>