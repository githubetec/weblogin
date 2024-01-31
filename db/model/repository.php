<?php
function Conect()
{
    //Conexão com banco de dados
    return new PDO(
        'mysql:host=localhost;dbname=dbapp_prof',
        'root',
        'api'
    );
}

function Insert()
{
    $sql = "INSERT INTO usuarios (nome, login, senha)
                VALUES ('" . $_POST["nome"] . "', '" . $_POST["login"] . "',
                        '" . $_POST["senha"] . "');";
    Conect()->prepare($sql)->execute();
}

function Update()
{
    $sql = "update usuarios set nome='" . $_POST["nome"] .
        "', login='" . $_POST["login"] .
        "', senha= '" . $_POST["senha"] .
        "' where id='" . $_POST['id'] .  "';";
    Conect()->prepare($sql)->execute();
}

function Delete() {
    $sql = "delete from usuarios  where id='" . $_POST['id'] .  "';";
    Conect()->prepare($sql)->execute();
}

function Consult() {
    $sql = 'SELECT * FROM usuarios where id=' . $_POST["id"] . ';';
    $registre = Conect()->query($sql)->fetch();
    $id = $registre['id'];
    $nome = $registre['nome'];
    $login = $registre['login'];
    $senha = $registre['senha'];    
}

function Repository() {
    if (isset($_POST["gravar"])) {
        Insert();
    } else if (isset($_POST["alterar"])) {
        Update();
    } else if (isset($_POST["excluir"])) {
        Delete();
    } else if (isset($_POST["consultar"])) {
        Consult();
    } else {
        $id = "";
        $nome = "";
        $login = "";
        $senha = "";
    }
    
}
