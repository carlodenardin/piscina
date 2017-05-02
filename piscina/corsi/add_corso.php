<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$nome = $_POST['nome'];
$turni = $_POST['turni'];
$orari = $_POST['orari'];

$_SESSION['nome']=$nome;
$_SESSION['turni']=$turni;
$_SESSION['orari']=$orari;

$stampaTurni='';
$stampaOrari='';
for($i=1;$i<=$turni;$i++){
  $stampaTurni.='<div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"><strong><font color="red">Turno '.$i.':</font></strong></h3>
                    </div>
                    <div class="panel-body">

                      <div class="row">                     
                        <div class="col-md-3">
                          <label>Dal</label>
                          <div class="form-group">
                            <input type="date" name="turno'.$i.'i" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label>Al</label>
                          <div class="form-group">
                            <input type="date" name="turno'.$i.'f" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label>N° Lezioni</label>
                          <div class="form-group">
                            <input type="number" name="lezioni'.$i.'" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
}

for($i=1;$i<=$orari;$i++){
  $stampaOrari.='<div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="time" name="orario'.$i.'i" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3"> 
                      <div class="form-group">
                        <input type="time" name="orario'.$i.'f" class="form-control">
                      </div>
                    </div>
                  </div>';
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Corsi </h1>
          </div>
        </div>
      </div>
    </header> 

    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="../index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="../utenti/utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
              <a href="corsi.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Corsi <span class="badge"></span></a>
              <!-- Include the plugin's CSS and JS: -->
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Aggiungi Corso: <strong><?php echo $nome ?></strong></h3>
              </div>
              <div class="panel-body">
                
                <form action="corsi.php" method="post">
                  <div class="form-group">  
                    <label>Seleziona Giorni:</label>
                  </div>
                  <div class="form-group">  
                    <label class="checkbox-inline"><input type="checkbox" value="1" name="giorno1">Lunedì</label>
                    <label class="checkbox-inline"><input type="checkbox" value="2" name="giorno2">Martedì</label>
                    <label class="checkbox-inline"><input type="checkbox" value="3" name="giorno3">Mercoledì</label>
                    <label class="checkbox-inline"><input type="checkbox" value="4" name="giorno4">Giovedì</label>
                    <label class="checkbox-inline"><input type="checkbox" value="5" name="giorno5">Venerdì</label>
                    <label class="checkbox-inline"><input type="checkbox" value="6" name="giorno6">Sabato</label>
                    <label class="checkbox-inline"><input type="checkbox" value="7" name="giorno7">Domenica</label>
                  </div>
                  
                  <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3 class="panel-title"><strong>Inserisci Orari:</strong></h3>
                    </div>
                    <div class="panel-body">
                      <?php echo $stampaOrari; ?>
                    </div>
                  </div>
                  
                  <?php echo $stampaTurni; ?>

                  <div class="form-group">
                    <button type="submit" class="btn btn-success" name="aggiungi_corso">Aggiungi corso</button>
                  </div> 
                </form>

                
              
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
