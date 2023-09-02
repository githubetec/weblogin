<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>WebLogin</title>
</head>

<body>
    <?php
    //Conexão com banco de dados
    $conexao = new PDO(
        'mysql:host=localhost;dbname=dbapp_prof',
        'root',
        'api'
    );
    if (isset($_POST["gravar"])) {
        //string sql para inserção de dados na tabela do banco
        $sql = "INSERT INTO usuarios (nome, login, senha)
                VALUES ('" . $_POST["nome"] . "', '" . $_POST["login"] . "',
                        '" . $_POST["senha"] . "');";
        //prepara para inserção de dados
        $comando = $conexao->prepare($sql);
        //executar a inserção de dados
        $comando->execute();
    } else if(isset($_POST["alterar"])) {
        $sql = "update usuarios set nome='" . $_POST["nome"] .
                                 "', login='" . $_POST["login"] .
                                 "', senha= '" . $_POST["senha"] . 
                                 "' where id='" . $_POST['id'] .  "';";
        //prepara para alteração de dados
        $comando = $conexao->prepare($sql);
        //executar a alteração de dados
        $comando->execute();
    } else if(isset($_POST["excluir"])) {
        $sql = "delete from usuarios  where id='" . $_POST['id'] .  "';";
        //prepara para exclusão de dados
        $comando = $conexao->prepare($sql);
        //executar a exclusão de dados
        $comando->execute();
    } else if (isset($_POST["consultar"])) {
        $sql = 'SELECT * FROM usuarios where id=' . $_POST["id"] . ';';
        $resultado = $conexao->query($sql);
        $registro = $resultado->fetch();
        $id = $registro['id'];
        $nome = $registro['nome'];
        $login = $registro['login'];
        $senha = $registro['senha'];
    } else {
        $id = "";
        $nome = "";
        $login = "";
        $senha = "";
    }
    ?>
    <main class="container-fluid">
        <h3>Cadastro de usuários</h3>
        <form action="index.php" method="post">
            <div class="row">
                <div class="col-md-2">
                    <label for="id">Id:</label>
                    <input class="form-control" type="text" name="id" id="id" value="<?php echo $id ?>">
                </div>
                <div class="col-md-10">
                    <label for="nome">Nome:</label>
                    <input class="form-control" type="text" name="nome" value="<?php echo $nome ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="login">Login:</label>
                    <input class="form-control" type="text" name="login" value="<?php echo $login ?>">
                </div>
                <div class="col-md-6">
                    <label for="senha">Senha:</label>
                    <input class="form-control" type="text" name="senha" value="<?php echo $senha ?>">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit" name="gravar">Gravar</button>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit" name="excluir">Excluir</button>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit" name="consultar" id="consultar">Consultar</button>
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary" type="submit" name="limpar">Limpar</button>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id:</th>
                        <th>Nome:</th>
                        <th>Login:</th>
                        <th>Senha:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM usuarios";
                    $resultado = $conexao->query($sql);
                    while ($registro = $resultado->fetch()) {
                    ?>
                        <tr>
                            <td style="width: 10%;"><?php echo $registro["id"] ?></td>
                            <td style="width: 45%;"><?php echo $registro["nome"] ?></td>
                            <td style="width: 20%;"><?php echo $registro["login"] ?></td>
                            <td style="width: 10%;"><?php echo $registro["senha"] ?></td>
                            <td style="width: 10%;">
                            <button id="btnconsultar" class="btn btn-info" onclick="$('#id').prop('value', $(this).closest('tr').find('td:eq(0)').text());
                            $('#consultar').click();">
                                Consultar
                            </button>
                        </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>