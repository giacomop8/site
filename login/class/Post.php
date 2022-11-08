<?php

class Post {

    private $title;
    private $description;
    private $text;
    private $image;

    public function createPost($title, $description, $text, $image) {
        include RAIZ ."/conexao.php";

        $this->title = $title;
        $this->description = $description;
        $this->texto = $text;
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $title = ucfirst($title);
        $description = ucfirst($description);
        $text = ucfirst($text);
        $date = date('Y/m/d G:i');


        /* inserindo dados na tabela posts */
                    
        $insertPost = "INSERT INTO posts (title, description, text, date) VALUES ('$title', '$description', '$text', '$date')";
        mysqli_query($conexao, $insertPost); 
        mysqli_close($conexao);

        if($this->saveImage($image, $title, $date)) {
            echo 'Salvo com sucesso';
        }
        else {
            echo 'Erro ao salvar a imagem';
        }
    }

    public function editPost($id, $title, $description, $data, $text, $image) {
        include RAIZ ."/conexao.php";
        /* função para edição de post */

        date_default_timezone_set('America/Sao_Paulo');
        
        $title = ucfirst($title);
        $description = ucfirst($description);
        $text = ucfirst($text);
        $date = date('Y/m/d G:i');

        $edit = "UPDATE posts SET title='$title', description='$description', text='$text', date='$data' WHERE id_post='$id'";
        mysqli_query($conexao, $edit);
        mysqli_close($conexao);
        
        if($this->editImage($id, $image, $title, $date)) {
            echo 'Salvo com sucesso';
        }
        else {
            echo 'Erro ao salvar a imagem';
        }
        
    }

    public function editImage($idPost, $image, $title, $date) {

        /* se o input de imagem estiver vazio, fazer isso */
        if($image['type'] == '') {
            include RAIZ ."/conexao.php";

            $selectImage = "SELECT * FROM images WHERE id_post='$idPost'";
            $query = mysqli_query($conexao, $selectImage);
            $image = mysqli_fetch_assoc($query);
            $extension = $image['extension'];                        
            $name = $title;
            $path = $_SERVER["DOCUMENT_ROOT"].'/projetos/site_raiz/uploads/posts/'.$name.'.'.$extension;
    
            /* inserindo dados na tabela imagem, pegando id do ultimo post */
            $selectImage = "SELECT * FROM images WHERE id_post='$idPost'";
            $editImage = "UPDATE images SET name_image='$title', extension='$extension', path='$path', date_image='$date', id_post=$idPost";
            mysqli_query($conexao, $editImage);
            mysqli_close($conexao);

            return true;
        }

        /* caso contrario, faça isso */
        else{
            $temp = $image['tmp_name'];
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $name = $title;
            $path = $_SERVER["DOCUMENT_ROOT"].'/projetos/site_raiz/uploads/posts/'.$name.'.'.$extension;
    
            if(move_uploaded_file($temp, $path)) {
                include RAIZ ."/conexao.php";
    
                /* inserindo dados na tabela imagem, pegando id do ultimo post */
                $selectImage = "SELECT * FROM images WHERE id_post='$idPost'";
                $editImage = "UPDATE images SET name_image='$title', extension='$extension', path='$path', date_image='$date', id_post=$idPost";
                mysqli_query($conexao, $editImage);
                mysqli_close($conexao);
    
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function saveImage($image, $title, $date) {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $temp = $image['tmp_name'];
        $name = $title;
        $path = $_SERVER["DOCUMENT_ROOT"].'/projetos/site_raiz/uploads/posts/'.$name.'.'.$extension;

        if(move_uploaded_file($temp, $path)) {
            include RAIZ ."/conexao.php";

            /* Buscando ultimo post criado, o de cima */
            $select = "SELECT * FROM posts";
            $query = mysqli_query($conexao, $select);
            $linhas = mysqli_num_rows($query);
            $posts = [];

            for($i=0; $i<$linhas; $i++) {
                $posts[] = mysqli_fetch_array($query);
            }

            $lastPost = end($posts);
            $id = $lastPost['id_post'];

            /* inserindo dados na tabela imagem, pegando id do ultimo post */
            $insertImage = "INSERT INTO images (name_image, extension, path, date_image, id_post) VALUES ('$title', '$extension', '$path', '$date', $id)";
            mysqli_query($conexao, $insertImage);

            mysqli_close($conexao);

            return true;
        }
        else {
            return false;
        }
    }
}