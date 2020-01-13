<?php

    include 'requires.php';
    $dc = new DAOCadeira();
    $data = $dc->getCadeirasEletivas();
    foreach($data as $grupo)
        foreach($grupo as $cadeira){
            echo "<h3>" . $cadeira->getNome() . "</h3><br>";
            if($cadeira->hasPreReqs()){
            echo "Pre Requisitos: ";
            echo "<ul>";
            foreach($cadeira->getPreReqs() as $preReqs)
                echo "<li>" . $preReqs->getNome() . "</li>";
                echo "</ul>";
        }
        
    }
?>