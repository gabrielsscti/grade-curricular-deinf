<?php
$cadeira = $_SESSION["actCadeira"];

?>

<div id = "ementa-<?php echo $cadeira->getIdCadeira(); ?>" class="modal">
    <div class="modal-content">
        <div class = "modal-header">
            <div class = "modal-title-section">
                <?php echo $cadeira->getNome(); ?>
            </div>
            <div class = "modal-close-section" onclick='closeModal(<?php echo $cadeira->getIdCadeira() ?>);'>
                <span class="close">&times;</span>
            </div>
            
        </div>
        <hr>
        <div class = "modal-body">
            <?php echo $cadeira->getEmenta(); ?>
        </div>
    </div>
</div>

