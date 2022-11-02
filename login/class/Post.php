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
        $date = date('Y/m/d G:i:s');

        if($this->saveImage($image, $title, $date)) {
            $insert = "INSERT INTO posts (title, description, text, date) VALUES ('$title', '$description', '$text', '$date')";
            $result = mysqli_query($conexao, $insert);
            mysqli_close($conexao);
        }
        else {
            echo 'Erro ao salvar a imagem';
        }

        
    }

    public function saveImage($image, $title, $date) {
        include RAIZ ."/conexao.php";

        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $temp = $image['tmp_name'];
        $name = $title;
        $path = $_SERVER["DOCUMENT_ROOT"].'/projetos/site_raiz/img/posts/'.$name .'.'.$extension;

        if(move_uploaded_file($temp, $path)) {
            $insert = "INSERT INTO images (name_image, path, date_image) VALUES ('$title', '$path', '$date')";
            $result = mysqli_query($conexao, $insert);
            
            mysqli_close($conexao);
            return true;
        }
        else {
            mysqli_close($conexao);
            return false;
        }
    }

    public function getPosts() {
        include RAIZ ."/conexao.php";

        $select = "SELECT * FROM posts";
        $result = mysqli_query($conexao, $select);
        $row = mysqli_num_rows($result);

    }
}