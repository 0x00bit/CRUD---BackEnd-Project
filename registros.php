<?php
    global $pdo;
    global $payload;

    //Conexão com o banco de dados
    try{
        $pdo = new PDO("mysql:dbname=registros;host=localhost;","root","");
    }catch(PDOExeception $e){
        echo "Erro ao tentar se conectar com o banco de dados!".$e->getMessage();
    }
    catch(Exeception $e){
        echo "Ocorreu um erro".$e->getMensage();
    }

    //Checa se está sendo solicitado uma busca completa ou condicional
    $payload = $pdo->prepare("SELECT * FROM funcionarios;");
    $payload->execute();
    $retornoall = $payload->fetchAll();
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
            text-align: center;
        }
        table,th,td{
            border: solid 1px;
            font-family: 'Poppins';
            margin-left: 20%;
        }
        button{
            font-family: 'Poppins';
        }
        label{
            font-family: 'Poppins';
        }
        a{
            font-family: 'Poppins';
            color: red;
        }
    </style>
</head>
<body>
    <h1 id="title">Base Cadastral</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Empresa</th>
            <th>Banco</th>
            <th>Agência</th>
            <th>Conta Corrente</th>
        </tr>
        <?php
            if (isset($retornoall)) {
                foreach ($retornoall as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['empresa'] . "</td>";
                    echo "<td>" . $row['banco'] . "</td>";
                    echo "<td>" . $row['agencia'] . "</td>";
                    echo "<td>" . $row['contac'] ."</td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
        </br>
        </br>
    <a href=".\cadastros.php" id="redirect">Voltar para o portal de cadastramentos </a>
        </br>
        </br>
</body>
