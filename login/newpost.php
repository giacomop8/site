<?php

$message = array();

/* HEADER */
include_once("templates/header.php");

if(!isset($_SESSION["logado"])) {
    header("Location: index.php");
}

?>
<!-- MAIN -->
<div class="main">
    <main>
        <div class="cadastro">
            <h3>Criar Post</h3>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Digite o título da postagem" autofocus>
                </div><br>

                <div class="form-group">
                    <label>Descrição breve:</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Digite um resumo">
                </div><br>
                
                <div class="form-group">
                    <label>Texto completo:</label>
                    <textarea type="text" id="trumbowyg-editor" name="texto" class="form-control" rows="10" placeholder="Digite o texto completo da postagem"></textarea>
                </div><br>

                <div class="form-group">
                    <label>Inserir imagem:</label><br>
                    <input class="form-control" type="file" name="imagem" multiple="multiple">
                </div><br>

                <div class="fomr-group">
                    <label>Data/Hora:</label><br>
                    <input class="form-control" type="datetime-local" name="" id="">
                </div><br>
                <button type="submit" name="newpost" class="btn btn-primary">Criar postagem</button>
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