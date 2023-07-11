<?php
    global $user;
    global $buser;
    if(isset($_POST['apag'])){
        $user = $_POST['apag'];
    }
    if(isset($_POST['busca'])){
        $buser = $_POST['busca'];
    }

    try{
        $pdo = new PDO("mysql:dbname=cadastros;host=localhost;","root","");
    }catch(PDOException $e){
        echo "Erro ao tentar se conectar com o banco de dados!".$e->getMessage();
    }
    catch(Exception $e){
        echo "Ocorreu um erro".$e->getMessage();
    }
    $payload = $pdo->prepare("DELETE FROM clients WHERE nome=:us;");
    $payload->bindValue(":us",$user);
    $payload->execute();

    // -------------- SELECT ----------------

    $show = $pdo->prepare("SELECT * FROM clients WHERE nome=:e;");
    $show->bindValue(":e",$buser);
    $show->execute();
    $result = $show->fetch();
    if(!empty($result)){
        foreach ((array) $result as $key => $value){
            echo "<pre>"."|".$key."|".":".$value."</pre>"."<br>";
            //<table><thead><tr></tr></thead><tbody></tbody><tfoot></tfoot></table>
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Clientes Cadastrados</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
            table {
                border-collapse: collapse;
                width: 100%;
                font-family: Poppins;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            h2 {
                text-align: center;
                font-family: Poppins;
            }
            h4{
                font-family: Poppins;
                text-align: center;
            }
            label{
                font-family: Poppins;
                font-size: 16px;
                align: center;
            }
            body{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h2>Apagar Usuário</h2>
        <form action="registros.php" name="apagar" method="POST">
            <label for="apagar">Apagar usuário:  </label>
            <input type="text" name="apag" id="apag-user" required>
            <input type="submit" value="Apagar">
        </form>
        </br>
        </br>
        </br>
        </br>
    <h2>Busca de usuários cadastrados</h2>
    <form action="registros.php" name="buscar" method="POST">
            <label for="buscar">Buscar usuário:  </label>
            <input type="text" name="busca" id="busca" required>
            <input type="submit" value="Buscar">
        </form>
    </body>

