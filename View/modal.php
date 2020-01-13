<div id = "ementa-<?php echo $idCadeira; ?>" class="modal">
    <div class="modal-content">
        <div class = "modal-header">
            <div class = "modal-title-section">
                <?php echo $nome; ?>
            </div>
            <div class = "modal-close-section" onclick='closeModal(<?php echo $idCadeira?>);'>
                <span class="close">&times;</span>
            </div>
            
        </div>
        <hr>
        <div class = "modal-body">
            <?php echo $ementa; ?>
        </div>
        </div>
    </div>
</div>
