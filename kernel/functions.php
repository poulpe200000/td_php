<?php

/**
 * Extraire les données d'un formulaire
 * @param array $datas
 * @param array $fields
 * @return array $datas_clean
 */
function extractDatasForm(array $datas, array $fields) {
//    print_r($datas);
//    print_r(array_keys($datas));
//    print_r($fields);
//    print_r(array_diff(array_keys($datas),$fields));



    $diff = array_diff(array_keys($datas),$fields);
    if(count($diff)>0) {
        return false;
    }
    $datas_clean =[];
    //print_r($datas);
    foreach($datas as $name => $value) {
        if(!empty($value)) {
            $datas_clean[$name] = trim($value);
        } else {
            $datas_clean[$name] = null;
        }
    }
    return $datas_clean;
}


function getFlash() {
    // Démarrage session
//    session_start();
    $html = null;
    if(isset($_SESSION['messages'])) {
        $html  = '<div class="alert alert-danger">';
        foreach($_SESSION['messages'] as $message) {
            $html .='<strong>';
            $html .=  $message;
            $html .='</strong><br>';
        }
        $html .='</div>';
        // Supprimer les messages de la session
        unset($_SESSION['messages']);
    }
    return $html;
}

//function setFlash() {};

//$i = 10;
//$i +=5;