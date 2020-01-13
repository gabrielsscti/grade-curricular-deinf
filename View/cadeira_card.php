<?php 
$cadeira = $_SESSION['actCadeira'];

?>

<div class='cadeira-container' id = 'cadeira-<?php echo $cadeira->getIdCadeira() ?>'>
    <div class='cadeira-topinfo'>
        <div class='cadeira-topinfo-left'><?php echo $cadeira->getCodigo()?></div>
        <div class='cadeira-topinfo-right'><?php echo $cadeira->getDepartamento() ?></div>
    </div>
    <div class='cadeira-midinfo'><?php echo $cadeira->getNome() ?></div>
    <div class='cadeira-botinfo'>
        <div class='cadeira-botinfo-left'>
            <?php echo $cadeira->getCreditos() ; ?>

        </div>
        <div class='cadeira-botinfo-right'>
            <div onclick='displayModal(<?php echo $cadeira->getIdCadeira() ?>)' class='cadeira-btn cadeira-btn-ementa'>E</div>
            <div onclick='highlightCards(<?php echo json_encode($cadeira->getPreReqsIds()) . ", ". $cadeira->getIdCadeira(); ?>)' class='cadeira-btn cadeira-btn-prereq'>P</div>
        </div>
    </div>
    
</div>
<?php 
    foreach($cadeira->getPreReqs() as $cadeiraPreReq){
        ?>
        <a href="#cadeira-<?php echo $cadeiraPreReq->getIdCadeira() ?>">
            <div onclick='' class='cadeira-container cadeira-dropdown' id = "cadeira-dropdown-<?php echo $cadeira->getIdCadeira() . "-" . $cadeiraPreReq->getIdCadeira()?>">
                Go to <?php echo $cadeiraPreReq->getIdCadeira() ?>
            </div>
        </a>
        <?php
    }
?>
