<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$alert = "";
$messaggio = "";
$stampa = "";
$id_turno = $_SESSION['turno'];
$nome = $_SESSION['nome'];


if(isset($_POST['add_partecipante'])){
  $card = $_SESSION['card'];
  $sql = "SELECT * FROM card WHERE id_card='$card'";
  $risultato = $connessione->query($sql);
  $row = $risultato->fetch_array();
  $numrow = mysqli_num_rows($risultato);
  if($numrow!=1){
    $messaggio = "Errore! Nessun utente collegato a questa carta";
    $alert = "alert alert-danger";
    header("Refresh:1; url=manage_corso.php?id=1&nome=adulti(lunedi-giovedi)");
  }
  else{
    $sql = "SELECT nome,cognome FROM bagnanti WHERE id_bagnante='$row[1]'";
    $risultato = $connessione->query($sql);
    $row = $risultato->fetch_array();
    $nome = $row[0];
    $cognome = $row[1];
    $stampa='<div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <div class="panel panel-default">
                      <div class="panel-body"><center>Sicuro di aggiungere <strong>'.$nome.' '.$cognome.' </strong>al corso? </center>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <form action="conferma.php" method="post"><button style="width: 100%;" type="submit" class="btn btn-success" name="aggiunto">SI</button></form>
                    </div>
                    <div class="col-md-6">
                      <a href="manage_corso.php?id=<?php echo $id_turno;?>&nome=<?php echo $nome?>"><button style="width: 100%;" type="button" value="no" class="btn btn-danger" name="bottone">NO</button></a>
                    </div>
                  </div>
                  <div class="col-md-1"></div>
                </div> ';
  }
}

if(isset($_POST['aggiunto'])){
  $card = $_SESSION['card'];
  $id_turno = $_SESSION['turno'];

  $sql = "SELECT * FROM iscrizioni WHERE fk_card='$card'";
  $risultato = $connessione->query($sql);
  $numrow = mysqli_num_rows($risultato);
  if($numrow!=0){
    $messaggio = "Il bagnante è già iscritto a questo corso!";
    $alert = "alert alert-danger";
    header("Refresh:1; url=manage_corso.php?id=$id_turno&nome=$nome");
  }
  else{
    $sql = "INSERT INTO iscrizioni (fk_card,fk_turno) VALUES ('$card','$id_turno')";
    $connessione->query($sql);

    $messaggio = "Bagnante aggiunto con successo al Corso!";
    $alert = "alert alert-success";
    header("Refresh:1; url=manage_corso.php?id=$id_turno&nome=$nome");
  }
  

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Pages</title>
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <script href="../bootstrap/js/jquery-1.8.3.min"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

    <script>
      
    </script>

  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AdminStrap</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, admin</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Utenti</h1>
          </div>
           
        </div>
      </div>
    </header> 

    

    <section id="main">
      <div class="container">
        <div class="row">
          <!--PANNELLO LATERALE-->
          <div class="col-md-3">
            <div class="list-group">
              <a href="../index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="../utenti/utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
              <a href="corsi.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Corsi <span class="badge"></span></a>
            </div>
          </div>
          <!--PANNELLO CENTRALE-->
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Conferma</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class= <?php echo('"'.$alert.'"') ?> >
                      <?php echo $messaggio; ?>
                  </div>
                </div>
                <?php echo $stampa; ?>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
