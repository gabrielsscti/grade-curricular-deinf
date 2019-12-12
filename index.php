<?php 
    include './Control/requires.php';
    
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'/>
        <title>Bloco Cadeira DEINF</title>
        <link rel='stylesheet' href='styles.css'/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="cadeira-table">
        <?php
            include 'helpers_functions.php';
            $cardDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . 'cadeira_card.php';
            $actPeriodo = 1;
            $conn = DBConnect();
            $data = DBRead("cadeira", "WHERE periodo IS NOT NULL ORDER BY periodo ASC");
            
            ?>
                    <div class = "cadeira-periodo-column">
                    <strong>PERÍODO 1</strong>
                    <?php
                        foreach($data as $i){
                            $preReqData = DBRead("cadeiracadeira", "WHERE idCadeira = {$i['idCadeira']}", "idPreRequisito");
                            
                            if($actPeriodo!=$i["periodo"]){
                                ?>
                                </div>
                                <div class = "cadeira-periodo-column">
                                <?php
                                echo "<strong>PERÍODO ".$i["periodo"] . "</strong>";
                                $actPeriodo = $i["periodo"];
                            }
                            if($preReqData){
                                array_push($i, $preReqData);
                                $i["preReqData"] = array();
                                foreach($i[0] as $j){
                                    array_push($i["preReqData"], $j["idPreRequisito"]);
                                }
                                $r = $i;
                            }
                            else
                                $r = $i;
                            includeWithVariable($cardDirectory, $r);
                            
                            
                            
                            
                        }
                        DBClose($conn);
                    ?>
        </div>
        <script src="./scripts.js"> </script>
    </body>
</html>

