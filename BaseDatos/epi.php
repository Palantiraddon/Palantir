<?php

try {
    if (isset($_GET['id']) && trim($_GET['id'])!='' && isset($_GET['val']) && trim($_GET['val'])!='') {
        $db = new SQLite3('moria.tmp');
        if (isset($_GET['temp']) && trim($_GET['temp'])!='') {
           //$row = $db->querySingle('SELECT n_epi FROM series_temp WHERE serie_id=' . $_GET['id'] . ' AND temp_id=' . $_GET['temp'], true);
           $sql = "UPDATE series_temp SET n_epi=:epi WHERE serie_id = :serie_id AND temp_id = :temp_id";
           $smt = $db->prepare($sql);
           $smt->bindValue(':serie_id', $_GET['id']);
           $smt->bindValue(':temp_id', $_GET['temp']);
           $smt->bindValue(':epi', $_GET['val']);
        } else {
           //$row = $db->querySingle('SELECT n_epi FROM series WHERE serie_id=' . $_GET['id'] , true);
           $sql = "UPDATE series SET n_epi=:epi WHERE serie_id = :serie_id";
           $smt = $db->prepare($sql);
           $smt->bindValue(':serie_id', $_GET['id']);
           $smt->bindValue(':epi', $_GET['val']);
        }
        //var_dump($row);
        if ($_GET['val'] > $row['n_epi']) {
            $smt->execute();
        }

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