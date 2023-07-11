<?php
    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
    }
    if(isset($_POST['altura'])){
        $altura = $_POST['altura'];
    }
    if(isset($_POST['nacionalidade'])){
        $nacionalidade = $_POST['nacionalidade'];
    }
    if(isset($_POST['sexo'])){
        $sexo = $_POST['sexo'];
    }
    if(isset($_POST['nascimento'])){
        $nascimento = $_POST['nascimento'];
    }
    if(isset($_POST['peso'])){
        $peso = $_POST['peso'];
    }

    try{
        $pdo = new PDO("mysql:dbname=cadastros;host=localhost;","root","");
    }catch(PDOExeception $e){
        echo "Erro ao tentar se conectar com o banco de dados!".$e->getMessage();
    }
    catch(Exeception $e){
        echo "Ocorreu um erro".$e->getMensage();
    }
    //DB name >> host >> user >> password

    $payload = $pdo->prepare("INSERT INTO clients(nome, altura, nacionalidade, sexo, nascimento, peso)
    VALUES (?,?,?,?,?,?)");

    $payload->execute([$nome,$altura,$nacionalidade,$sexo,$nascimento,$peso]);
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastros</title>
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
    </style>
</head>
<body>
    <h1>Portal de Cadastramento</h1>
    <form action="cadastros.php" name="cadastro" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="altura">Altura:</label>
        <input type="text" name="altura" id="altura" required>
        
        <label for="nacionalidade">Nacionalidade:</label>
        <input type="text" name="nacionalidade" id="nacionalidade" required>
        
        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" id="sexo-m" value="M" required>
        <label for="sexo-m">M</label>
        <input type="radio" name="sexo" id="sexo-f" value="F" required>
        <label for="sexo-f">F</label>
        
        <label for="nascimento">Nascimento:</label>
        <input type="date" name="nascimento" id="nascimento" required>
        
        <label for="peso">Peso:</label>
        <input type="text" name="peso" id="peso" required>
        
        <input type="submit" value="Enviar">
    </form>

</body>
</html>
