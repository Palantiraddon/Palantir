<?php

try {
    if (isset($_GET['id']) && trim($_GET['id'])!='' && isset($_GET['type']) && trim($_GET['type'])!='') {
        $db = new SQLite3('moria.tmp');
        //$row = $db->querySingle('SELECT serie_id, views FROM series WHERE serie_id=1', true);
        //var_dump($row);

        //Update the record
        if ( $_GET['type'] == 'series') {
            $smt = $db->prepare("UPDATE series SET views= views + 1 WHERE serie_id = :serie_id");
            $smt->bindValue(':serie_id', $_GET['id']);

            $consulta= $smt->execute();
        } else {
            $smt = $db->prepare("UPDATE pelis SET views= views + 1 WHERE peli_id = :peli_id");
            $smt->bindValue(':peli_id', $_GET['id']);

            $consulta= $smt->execute();
        }


        //$row = $db->querySingle('SELECT serie_id, views FROM series WHERE serie_id=1', true);
        //var_dump($row);
    }

} catch (Exception $e) {
    //echo 'Excepcion capturada: ',  $e->getMessage(), "<br/>";
}

?>