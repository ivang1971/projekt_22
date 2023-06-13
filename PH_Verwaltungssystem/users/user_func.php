<?php

function show_available_units(){
    $user = $_SESSION["user"];
    $file_cont = file_get_contents("../admin/dacs/count/HKD_$user.lim");
    echo $file_cont;  
}

function show_occupied_units (){
    $user = $_SESSION['user'];
    $file_cont = file_get_contents("../admin/dacs/count/HKD_$user.cnt");
    if(!isset($file_cont)){
        echo "/";
    }else {
        echo $file_cont;
    }
}

function show_free_units () {
    $user = $_SESSION['user'];
    $available_units = file_get_contents("../admin/dacs/count/HKD_$user.lim");
    $occupied_units = file_get_contents("../admin/dacs/count/HKD_$user.cnt");
    $free_units = $available_units - $occupied_units;
    if($free_units < 1) {
     echo "/";
    }else {
        echo $free_units;
    }
}

?>