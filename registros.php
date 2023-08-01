<?php
    global $pdo;
    global $payload;

    //Conexão com o banco de dados
    try{
        $pdo = new PDO("mysql:dbname=registros;host=localhost;","root","");
    }catch(PDOException $e){
        echo "Erro ao tentar se conectar com o banco de dados!".$e->getMessage();
    }
    catch(Exception $e){
        echo "Ocorreu um erro".$e->getMessage();
    }

    //Checa se está sendo solicitado uma busca completa ou condicional
    $payload = $pdo->prepare("SELECT * FROM funcionarios;");
    $payload->execute();
    $retornoall = $payload->fetchAll();


    if(!empty($_GET['method']) && $_GET['method'] == 'delete'){

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Base Cadastral</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        #title{
            font-family: 'Poppins';
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        table,th,td{
            border: solid 1px;
            font-family: 'Poppins';
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        button{
            font-family: 'Poppins';
        }
        label{
            font-family: 'Poppins';
        }
        a{
            font-family: 'Poppins';
            color: purple;
            text-align: center;
        }
        #redirect{
text-align: center;
        }
    </style>
</head>
<body>
    <h1 id="title">Base Cadastral</h1>
    <div id="tabela">
    <table>
        <tr>
            <th></th>
            <th></th>
            <th>Nome</th>
            <th>Empresa</th>
            <th>Banco</th>
            <th>Agência</th>
            <th>Conta Corrente</th>
        </tr>
        <?php
            if (isset($retornoall)) {
                foreach ($retornoall as $row) {
                    $nome = $row['nome'];
                    echo "<tr>";
                    echo "<td><a href='registros.php?method=delete&id=".$row['id']."'>Excluir</a></td>";
                    echo "<td><a href='cadastros.php?method=update&id=".$row['id']."'>Alterar</a></td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['empresa'] . "</td>";
                    echo "<td>" . $row['banco'] . "</td>";
                    echo "<td>" . $row['agencia'] . "</td>";
                    echo "<td>" . $row['contac'] ."</td>";
                    echo "</tr>";
                }
            }
            if(!empty($_POST['panelup'])){
                echo $_POST['panelup'];
            }
            if(!empty($_GET['method']) && $_GET['method'] == 'delete'){
                $id = $_GET['id'];
                $payload = $pdo->prepare("DELETE FROM funcionarios WHERE id = $id;");
                $payload->execute();
                echo "<h3 style='text-align: center; color:red'>". "Usuário apagado com sucesso" ."</h3>";
            }
        ?>
    </table>
    </div>
        </br>
        </br>
        <div id="redirect">
    <a href=".\cadastros.php">Voltar para o portal de cadastramentos </a>
        </div>
        </br>
        </br>
</body>
