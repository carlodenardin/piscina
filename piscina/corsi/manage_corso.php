<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$id_turno = $_GET['id'];
$_SESSION['turno']=$id_turno;
$nome = $_GET['nome'];
$_SESSION['nome']=$nome;
$stampa="";

$sql = "SELECT * FROM iscrizioni JOIN card ON id_card=fk_card JOIN bagnanti ON fk_bagnante=id_bagnante WHERE fk_turno='$id_turno'";
if($connessione->query($sql)){
  $risultato = $connessione->query($sql);

  while($obj = $risultato->fetch_object()){
    $stampa.="<tr><td>".$obj->cognome."</td>";
    $stampa.="<td>".$obj->nome."</td>";
    $stampa.="<td><button type='button' class='btn btn-info'>Profilo</button></td>";
    $stampa.="<td><button type='button' class='btn btn-danger'>Elimina</button></td></tr>";

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

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
                <h3 class="panel-title"><?php echo $nome ?></h3>
              </div>
              <div class="panel-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <a href="corsi.php">corsi</a> / <a href="#"><?php echo $nome; ?></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                      <h3 class="panel-title">Partecipanti</h3>
                    </div>
                    <div class="panel-body">
                      <table class="table table-striped">
                        <tr>
                          <th>Cognome</th>
                          <th>Nome</th>
                          <th>Profilo</th>
                          <th>Cancella</th>
                        </tr>
                        <?php echo $stampa; ?>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="col-md-12">
                    <ul class="list-group">
                      <li class="list-group-item"><a data-toggle="tooltip" href="add_partecipante.php"><button style="width: 100%;" type="button" class="btn btn-info">Aggiungi Partecipante</button></a></li>
                    </ul>
                  </div>
                </div>

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
    <script href="../bootstrap/js/jquery-1.8.3.min"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  </body>
</html>
