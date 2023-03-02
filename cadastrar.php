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
                    <h2 class="cad-title">Cadastro</h2>
                    <div class="inputbox"> 
                        <input type="text" name="nome" required maxlenght="30">
                        <label for="">Nome</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="telefone" required maxlenght="30">
                        <label for="">Telefone</label>
                    </div>
                    <div class="inputbox">
                        <input type="email" name="email" required maxlenght="40">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="senha" required maxlenght="15">
                        <label for="">Senha</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="confSenha" required>
                        <label for="">Confirmar senha</label>
                    </div>
                    <button type="submit"class="button-cad">Cadastrar</button>
                </form>
            </div>
        </div>
    </section>
<?php
if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);

    if(!empty($nome)&&!empty($telefone)&&!empty($email)&&!empty($senha)){
        $bd->conectar("projeto_login_moderno","localhost","root","");
        if($bd->msgErro==""){
            if($senha == $confirmarSenha){
                if($bd->cadastrar($nome,$telefone,$email,$senha)){
                    echo '<script type="text/javascript"> window.onload = function () { alert("Cadastrado com sucesso!"); } </script>'; 
                }else{
                    echo '<script type="text/javascript"> window.onload = function () { alert("Não foi possível realizar o cadastro"); } </script>'; 
                }
            }else{
                echo '<script type="text/javascript"> window.onload = function () { alert("As senhas não correspondem"); } </script>'; 
            }
        }else{
            echo "Erro: ".$bd->msgErro;
        }
    }else{
        echo '<script type="text/javascript"> window.onload = function () { alert("Preencha todos os campos"); } </script>'; 
    }
}
?>
</body>
</html>