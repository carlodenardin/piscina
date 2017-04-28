<?php
session_start();
include 'config/config.php';

$sql = "SELECT * FROM dati";

$risultato = $connessione->query($sql);

$row = $risultato->fetch_array();

$_SESSION['card'] = $row['codice'];


echo "<input type='text' class='form-control' name='card' value='".$row['codice']."' disabled>";

$connessione->close();
?>
