<?php

include 'config/config.php';
    
if ($result = mysqli_query($connessione, "SELECT codice FROM dati")) {

    /* determine number of rows result set */
    $row = mysqli_num_rows($result);

    if($row==0){
		$sql = "INSERT INTO dati (codice) VALUES('".$_POST['CODICE']."')";
		$connessione->query($sql);
    }
    else{
    	$sql = "UPDATE dati SET codice='".$_POST['CODICE']."'";
    	$connessione->query($sql);
    }
}

?>