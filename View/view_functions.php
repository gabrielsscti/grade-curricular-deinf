<?php 
function includeCardWithCadeira(String $filePath, Cadeira $cadeira, $print = true){
    $output = NULL;
    if(file_exists($filePath)){
        ob_start();
        include $filePath;
        $output = ob_get_clean();
    }
    if($print)
        print $output;
    return $output;
} 
function getCardDirectory($callerFile){
    $cardDirectory = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . CADEIRA_FILE;
    if (strpos($cardDirectory, $callerFile) !== false)
        $cardDirectory = str_replace($callerFile, '', $cardDirectory);

    return $cardDirectory;
}
?>