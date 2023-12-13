<!DOCTYPE html>
<html>
<head>
    <title>Padaria</title>
    <link rel="icon" type="image/png" href="Imagens/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>

<body onload="w3_show_nav('menuPadaria')">
    <!-- Inclui MENU.PHP  -->
    <?php require 'geral/menu.php'; ?>
    <?php require 'bd/conectaBD.php'; ?>

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
            <p>
            <div class="w3-code cssHigh notranslate">
                <!-- Acesso em:-->
                <?php

                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small' > ";
                echo "Acesso em: ";
                echo $data;
                echo "</p> "
                ?>
                <div class="w3-container w3-theme" >
                    <h2>Listagem de Funcionários</h2>
                </div>
                <!-- Acesso ao BD-->
                <?php
                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $database);

                // Verifica conexão 
                if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

                // Faz Select na Base de Dados
                $sql = "SELECT ID_Funcionario, CPF, Nome, Nome_funcao AS Funcao, Foto, Dt_Nasc FROM Funcionario AS Funci INNER JOIN Funcao AS Funcao ON (Funci.ID_Funcao = Funcao.ID_Funcao) ORDER BY Funci.Nome";
                $result = $conn->query($sql);
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result->num_rows >0) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='7%'>Código</th>";
                    echo "	  <th width='16%'>CPF</th>";
                    echo "	  <th width='14%'>Foto</th>";
                    echo "	  <th width='18%'>Nome</th>";
                    echo "	  <th width='15%'>Função</th>";
                    echo "	  <th width='10%'>Nascimento</th>";
                    echo "	  <th width='8%'>Idade</th>";
                    echo "	  <th width='5%'> </th>";
                    echo "	  <th width='5%'> </th>";
                    echo "	</tr>";
                    // Apresenta cada linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        $data = $row['Dt_Nasc'];
                        list($ano, $mes, $dia) = explode('-', $data);
                        $nova_data = $dia . '/' . $mes . '/' . $ano;
                        // data atual
                        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                        // Descobre a unix timestamp da data de nascimento do fulano
                        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
                        // cálculo
                        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                        $cod = $row["ID_Funcionario"];
                        echo "<tr>";
                        echo "<td>";
                        echo $cod;
                        echo "</td><td>";
                        echo $row["CPF"];
                        if ($row['Foto']) { ?>
                            <td>
                                <div style="margin-top: -15px;">
                                    <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($row['Foto']) ?>" style="width: 50%; height: 50%;"/>
                                </div>
                            </td>
                            <td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <div style="margin-top: -15px;">
                                    <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/pessoa.jpg" style="width: 50%; height: 50%;"/>
                                </div>
                            </td>
                            <td>
                            <?php
                        }
                        echo $row["Nome"];
                        echo "</td><td>";
                        echo $row["Funcao"];
                        echo "</td><td>";
                        echo $nova_data;
                        echo "</td><td>";
                        echo $idade;
                        echo "</td>";
                        //Atualizar e Excluir registro de funcionários
                            ?>
                            <td>
                                <a href='funcioAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Funcionário' width='32'></a>
                            </td>
                            <td>
                                <a href='funcioExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Funcionário' width='32'></a>
                            </td>
                            </tr>
                    <?php
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p style='text-align:center'>Erro executando SELECT: " . $conn->connect_error . "</p>";
                }
                $conn->close();
                    ?>
            </div>
        </div>
        <?php require 'geral/sobre.php'; ?>
        <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP  -->
    <?php require 'geral/rodape.php'; ?>

</body>

</html>