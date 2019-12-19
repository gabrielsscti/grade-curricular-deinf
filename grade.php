<?php

include './Control/requires.php';
include './consts.php';

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <title>Bloco Cadeira DEINF</title>
    <link rel='stylesheet' href='styles.css' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <div class="grade">
        <div class="cadeira-table">
            <?php
            include 'helpers_functions.php';
            $cardDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . CADEIRA_FILE;

            if (strpos($cardDirectory, basename(__FILE__)) !== false)
                $cardDirectory = str_replace(basename(__FILE__), '', $cardDirectory);

            $actPeriodo = 1;
            $conn = DBConnect(); //Conecta à DB
            $data = DBRead("cadeira", "WHERE periodo IS NOT NULL ORDER BY periodo ASC"); //Pega todas as cadeiras obrigatórias

            ?>
            <div class="cadeira-periodo-column">
                <strong>PERÍODO 1</strong>

                <?php
                foreach ($data as $i) {
                    $preReqData = DBRead("cadeiracadeira", "WHERE idCadeira = {$i['idCadeira']}", "idPreRequisito");//Pega todos os pré-requisitos
                    if ($actPeriodo != $i["periodo"]) {
                ?>
            </div>
            <div class="cadeira-periodo-column">
        <?php
                        echo "<strong>PERÍODO " . $i["periodo"] . "</strong>";
                        $actPeriodo = $i["periodo"];
                    }
                    if ($preReqData) {
                        array_push($i, $preReqData);
                        $i["preReqData"] = array();
                        foreach ($i[0] as $j) {
                            array_push($i["preReqData"], $j["idPreRequisito"]);
                        }
                        $r = $i;
                    } else
                        $r = $i;
                    includeWithVariable($cardDirectory, $r);//Cria um novo card para cada cadeira obrigatória
                }
                DBClose($conn);
        ?>
            </div>
        </div>
        <?php
        $numGrupos = 2;
        $grupos = array();
        for ($i = 1; $i <= 2; $i++)
            $grupos[$i] = DBRead("cadeira", "WHERE periodo IS NULL and grupo = $i ORDER BY nome"); //Pega todas as cadeiras eletivas por grupos(1 e 2)

        ?>
        <div class="cadeira-list">
            <?php
            $grupoCont = 1;
            foreach ($grupos as $cadeiras) {//Para cada grupo de cadeira, cria uma lista de cadeiras.
            ?>
                <div class="cadeira-grupo">
                    <div onclick='displayGrupoEletiva(<?php echo $grupoCont; ?>)' class="cadeira-grupo-header">
                        <?php echo "Disciplinas Eletivas - Grupo $grupoCont";
                        $grupoCont++; ?>
                    </div>
                    <table class="cadeira-grupo-body" id="grupo-<?php echo $cont++ ?>">
                        <thead>
                            <tr>
                                <th class="column1">DEPT.</th>
                                <th class="column2">CÓDIGO</th>
                                <th class="column3">CRÉDITOS</th>
                                <th class="column4">DISCIPLINA</th>
                                <th class="column5"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cont = 0;
                            foreach ($cadeiras as $i) {
                                if ($cont % 2 == 0)
                                    echo "<tr class=\"row-light\" id=\"cadeira-" . $i["idCadeira"] . "\">";
                                else
                                    echo "<tr class=\"row-dark\" id=\"cadeira-" . $i["idCadeira"] . "\">";
                                $cont++;
                                echo "<th class=\"column1\">" . $i["departamento"] . "</th>";
                                echo "<th class=\"column2\">" . $i["codigo"] . "</th>";
                                echo "<th class=\"column3\">" . $i["creditos"] . "</th>";
                                echo "<th class=\"column4\">" . $i["nome"] . "</th>";
                                $temp = DBRead("cadeiracadeira", "WHERE idCadeira = {$i['idCadeira']}", "idPreRequisito");
                                $preReqData = array();
                                foreach ($temp[0] as $j)
                                    array_push($preReqData, $j);
                            ?>
                                <th class="column5">
                                    <div onclick='displayModal(<?php echo $i["idCadeira"]?>)' class='cadeira-btn cadeira-btn-ementa'>E</div>
                                    <div onclick='highlightCards(<?php echo json_encode($preReqData) . ", " . $idCadeira; ?>)' class='cadeira-btn cadeira-btn-prereq'>P</div>
                                </th>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    $data = DBRead("cadeira");
    foreach ($data as $i) {
        $modalDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . MODAL_FILE;
        includeWithVariable($modalDirectory, $i);
    }
    ?>
    <script src="./scripts.js"> </script>
</body>

</html>