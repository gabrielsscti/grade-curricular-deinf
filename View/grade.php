<?php
include 'view_functions.php';
$dc = new DAOCadeira();

?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <title>Bloco Cadeira DEINF</title>
    <link rel='stylesheet' href='./View/css/styles.css' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <div class="grade">
        <div class="cadeira-table">
            <?php
            

            $actPeriodo = 1;
            $cadeiras = $dc->getCadeirasObrigatorias();
            
            ?>
            <div class="cadeira-periodo-column">
                <strong>PERÍODO 1</strong>

                <?php
                foreach ($cadeiras as $cadeira) {
                    if ($actPeriodo != $cadeira->getPeriodo()) {
                ?>
            </div>
            <div class="cadeira-periodo-column">
        <?php
                        echo "<strong>PERÍODO " . $cadeira->getPeriodo() . "</strong>";
                        $actPeriodo = $cadeira->getPeriodo();
                    }
                    $_SESSION['actCadeira'] = $cadeira;
                    include getCardDirectory(basename(__FILE__));//Cria um novo card para cada cadeira obrigatória
                }
        ?>
            </div>
        </div>
        <?php
        $numGrupos = DAOCadeira::getMaxGrupos();
        $grupos = $dc->getCadeirasEletivas();
        ?>
        <div class="cadeira-list">
            <?php
            foreach ($grupos as $cadeiras) {//Para cada grupo de cadeira, cria uma lista de cadeiras.
            ?>
                <div class="cadeira-grupo">
                    <div class="cadeira-grupo-header">
                        <?php 
                        $actGrupo = $cadeiras[0]->getGrupo();
                        echo $actGrupo ? "Disciplinas Eletivas - Grupo $actGrupo" :"Complementos" ;
                        ?>
                    </div>
                    <table class="cadeira-grupo-body" id="grupo-<?php echo ($actGrupo ? $actGrupo : 0) ?>">
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
                                    echo "<tr class=\"row-light\" id=\"cadeira-" . $i->getIdCadeira() . "\">";
                                else
                                    echo "<tr class=\"row-dark\" id=\"cadeira-" . $i->getIdCadeira() . "\">";
                                $cont++;
                                echo "<td class=\"column1\">" . $i->getDepartamento() . "</td>";
                                echo "<td class=\"column2\">" . $i->getCodigo() . "</td>";
                                echo "<td class=\"column3\">" . $i->getCreditos() . "</td>";
                                echo "<td class=\"column4\">" . $i->getNome() . "</td>";
                            ?>
                                <td class="column5">
                                    <div onclick='displayModal(<?php echo $i->getIdCadeira() ?>)' class='cadeira-btn cadeira-btn-ementa'>E</div>
                                    <div onclick='highlightCards(<?php echo json_encode($i->getPreReqsIds()) . ", " . $i->getIdCadeira(); ?>)' class='cadeira-btn cadeira-btn-prereq'>P</div>
                                </td>
                                
                            <?php
                                echo "</tr>";
                                ?>
                            <?php
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
    $data = $dc->getAllCadeiras();
    foreach ($data as $i) {
        $_SESSION["actCadeira"] = $i;
        include getModalDirectory(basename(__FILE__));
    }
    ?>
    <script src="./View/js/scripts.js"> </script>
</body>

</html>