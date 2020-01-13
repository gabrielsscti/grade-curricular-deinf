<?php 
function getCardDirectory($callerFile){
    $cardDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . CADEIRA_FILE;
    if (strpos($cardDirectory, $callerFile) !== false)
        $cardDirectory = str_replace($callerFile, '', $cardDirectory);

    return $cardDirectory;
}

function getModalDirectory($callerFile){
    $cardDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . MODAL_FILE;
    if (strpos($cardDirectory, $callerFile) !== false)
        $cardDirectory = str_replace($callerFile, '', $cardDirectory);

    return $cardDirectory;
}
?>