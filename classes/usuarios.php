<?php

Class Usuario
{
    private $pdo;
    public $msgErro="";

    //FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS (PHP DATA OBJECT)
    public function conectar($nome,$host,$usuario,$senha){
        global $pdo;
        global $msgErro;

        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        }catch(PDOException $e){
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;

        $sql=$pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false;
        }else{
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha){
        global $pdo;

        $sql=$pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }else{
            return false;
        }
    }
}

?>