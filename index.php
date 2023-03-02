<?php
require_once 'classes/usuarios.php';
$bd = new Usuario;
?>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login Moderno</title>
    <link rel="stylesheet" href="est.css">
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="POST">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="senha" required>
                        <label for="">Senha</label>
                    </div>
                    <div class="forget">
                         <label for=""><input type="checkbox">Lembrar de mim <a href="#"><strong>Esqueci minha senha</strong></a></label>
                         
                    </div>
                    <button type="submit">Log In</button>
                    <div class="register">
                        <p>Não tenho uma conta <a href="cadastrar.php">Cadastrar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php
if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    if(!empty($email) && !empty($senha)){
        $bd->conectar("projeto_login_moderno","localhost","root","");
        if($bd->msgErro==""){
            if($bd->logar($email,$senha)){
                header("location: teladeinicio.php");
            }else{
                echo '<script type="text/javascript"> window.onload = function () { alert("Email e/ou senha inválidos!"); } </script>'; 
            }
        }else{
            echo "Erro: ".$bd->msgErro;
        }
    }
}
?>
</body>
</html>