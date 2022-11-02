<?php

$message = array();

/* HEADER */
include_once("templates/header.php");



?>
<!-- MAIN -->
<div class="main">
    <main>
        <div class="cadastro">
            <h3>Cadastro de Usuário</h3>
            <form action="newuser.php" method="POST">
                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" name="nome"  class="form-control" placeholder="Digite o nome">
                </div><br>

                <div class="form-group">
                    <label>Endereço e-mail:</label>
                    <input type="email" name="email"  class="form-control" placeholder="Digite seu e-mail">
                </div><br>

                <div class="form-group">
                    <label>Usuário:</label>
                    <input type="text" name="usuario"  class="form-control" placeholder="Digite usuario usado para login">
                </div><br>

                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" name="senha"  class="form-control" placeholder="Digite uma senha">
                </div><br>

                <div class="form-group">
                    <label>Confirme a senha:</label>
                    <input type="password" name="confirmaSenha"  class="form-control" placeholder="Confirme a senha">
                </div><br>

                <div class="form-group">
                    <label>Privilégios de usuário:</label><br>
                    <input name="tipoUsuario" type="radio" value="true"> Administrador <br>
                    <input name="tipoUsuario" type="radio" value="false"> Comum
                </div><br>

                <button name="newuser" type="submit" class="btn btn-primary">Criar usuário</button>
            </form>                
        </div>                
    </main>
</div>
<!-- FIM MAIN -->
</body>
</html>