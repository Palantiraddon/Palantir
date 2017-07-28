<?php

try {
    if (isset($_GET['id']) && trim($_GET['id'])!='' && isset($_GET['val']) && trim($_GET['val'])!='' && isset($_GET['type']) && trim($_GET['type'])!='') {
        if ($_GET['type'] == 'series'){
            list($serie_id, $temp_id, $capitulo_id) = explode ("-", $_GET['id']);
            $db = new SQLite3('moria.tmp');
            if (isset($capitulo_id) && trim($capitulo_id)!='') {
               $sql = "UPDATE capitulos SET quality=:qa WHERE serie_id = :serie_id AND temp_id = :temp_id AND capitulo_id = :cap_id";
               $smt = $db->prepare($sql);
               $smt->bindValue(':serie_id', $serie_id);
               $smt->bindValue(':temp_id', $temp_id);
               $smt->bindValue(':cap_id', $capitulo_id);
               $smt->bindValue(':qa', $_GET['val']);
            } elseif(isset($temp_id) && trim($temp_id)!='') {
               $sql = "UPDATE series_temp SET quality=:qa WHERE serie_id = :serie_id AND temp_id = :temp_id";
               $smt = $db->prepare($sql);
               $smt->bindValue(':serie_id', $serie_id);
               $smt->bindValue(':temp_id', $temp_id);
               $smt->bindValue(':qa', $_GET['val']);
            } elseif(isset($serie_id) && trim($serie_id)!='') {
               $sql = "UPDATE series SET quality=:qa WHERE serie_id = :serie_id";
               $smt = $db->prepare($sql);
               $smt->bindValue(':serie_id', $serie_id);
               $smt->bindValue(':qa', $_GET['val']);
            }
        } else {
            $sql = "UPDATE pelis SET quality=:qa WHERE peli_id = :peli_id";
            $smt = $db->prepare($sql);
            $smt->bindValue(':peli_id', $_GET['id']);
            $smt->bindValue(':qa', $_GET['val']);
        }

        //var_dump($row);
        //if ($_GET['val'] > $row['n_epi']) {
        $smt->execute();
        //}

        //if (isset($_GET['temp']) && trim($_GET['temp'])!='') {
        //   $row = $db->querySingle('SELECT n_epi FROM series_temp WHERE serie_id=' . $_GET['id'] . ' AND temp_id=' . $_GET['temp'], true);
        //} else {
        //   $row = $db->querySingle('SELECT n_epi FROM series WHERE serie_id=' .  $_GET['id'], true);
        //}
        //var_dump($row);
    }

} catch (Exception $e) {
    echo 'Excepcion capturada: ',  $e->getMessage(), "<br/>";
}

?>