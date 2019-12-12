<div class='cadeira-container' id = 'cadeira-<?php echo $idCadeira ?>'>
    <div class='cadeira-topinfo'>
        <div class='cadeira-topinfo-left'><?php echo $codigo?></div>
        <div class='cadeira-topinfo-right'><?php echo $departamento?></div>
    </div>
    <div class='cadeira-midinfo'><?php echo $nome ?></div>
    <div class='cadeira-botinfo'>
        <div class='cadeira-botinfo-left'>
            <?php echo $creditos;
            ?>

        </div>
        <div class='cadeira-botinfo-right'>
            <div onclick="location.href='#'" class='cadeira-btn cadeira-btn-ementa'>E</div>
            <div onclick='highlightCards(<?php echo json_encode($preReqData); ?>)' class='cadeira-btn cadeira-btn-prereq'>P</div>
        </div>
    </div>
</div>