<?php

global $pdo;
global $payload;

try{
    $pdo = new PDO("mysql:dbname=registros;host=localhost;","root","");
}catch(PDOException $e){
    echo "Erro ao tentar se conectar com o banco de dados!".$e->getMessage();
}
catch(Exception $e){
    echo "Ocorreu um erro".$e->getMessage();
}

if(isset($_POST['nome']) && isset($_POST['empresa']) && isset($_POST['banco']) && isset($_POST['agencia']) && isset($_POST['contac'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $contac = $_POST['contac'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['id'])){
        $payload = $pdo->prepare("INSERT INTO funcionarios(nome, empresa, banco, agencia, contac) VALUES (?,?,?,?,?)");
        $payload->execute([$nome,$empresa,$banco,$agencia,$contac]);
    } else{
        $payload = $pdo->prepare("UPDATE funcionarios SET nome=?, empresa=?, banco=?, agencia=?, contac=? WHERE id=?;");
        $payload->execute([$nome,$empresa,$banco,$agencia,$contac,$id]);
    }
    
}

$id = '';
$nome = '';
$empresa = '';
$banco = '';
$agencia = '';
$contac = '';

if(!empty($_GET['method']) && $_GET['method'] == 'update'){
    //Checa se está sendo solicitado uma busca completa ou condicional
    $id = $_GET['id'];
    $payload = $pdo->prepare("SELECT * FROM funcionarios WHERE id = $id;");
    $payload->execute();
    $retornoall = $payload->fetchAll();

    if (isset($retornoall)) {
        foreach ($retornoall as $row) {
            $id = $row['id'];
            $nome = $row['nome'];
            $empresa = $row['empresa'];
            $banco = $row['banco'];
            $agencia = $row['agencia'];
            $contac = $row['contac'];
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastros</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        h1 {
            text-align: center;
        }
        
        form {
            margin: 0 auto;
            max-width: 300px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="radio"] {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }
        
        input[type="button"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        h3{
            text-align: center;
        }
        #btn{
            font-family: 'Poppins';
        }
        #redirect{
            text-align: center;
            color: red;

        }
    </style>
</head>
<body>
    <h1>Portal de Cadastramento</h1>
    <h3>Cadastros de contas salário - Folha de funcionários</h3>
    
    <form action="cadastros.php" name="cadastro" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="Conta">Nome</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>
        
        <label for="firma">Empresa</label>
        <input type="text" name="empresa" value="<?php echo $empresa; ?>" required>
        
        <label for="banco">Nome do banco</label>
        <input type="text" name="banco" value="<?php echo $banco; ?>" required>
        
        <label for="agencia">Agência</label>
        <input type="text" name="agencia" value="<?php echo $agencia; ?>" required>
        
        <label for="peso">Conta corrente</label>
        <input type="text" name="contac" value="<?php echo $contac; ?>" required>
        
        <input type="submit" value="Enviar" id="btn">
    </form>
    </br>
    <div id="redirect">
    <a href=".\registros.php">clique aqui checar ou atualizar a base cadastral</a>
    </div>
</body>
</html>
