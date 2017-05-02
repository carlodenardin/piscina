<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

if ($result = mysqli_query($connessione, "SELECT codice FROM dati")) {
    /* determine number of rows result set */
    $row = mysqli_num_rows($result);
    if($row!=0){
      $sql = "DELETE FROM dati";
      $connessione->query($sql);
    }
}

$id_turno = $_SESSION['turno'];

$sql = "SELECT fk_corso FROM turni WHERE id_turno='$id_turno'";
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();
$id_corso = $row[0];

$sql = "SELECT * FROM corsi WHERE id_corso='$id_corso'";
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();
$nome = $row[1];



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
      //OTTIENI CODICE DA DATABASE
      (function($)
      {
          $(document).ready(function()
          {
              $.ajaxSetup(
              {
                  cache: false,
                  beforeSend: function() {
                      $('#content').hide();
                      $('#content').show();
                  }
                  
              });
              var $container = $("#content");
              $container.load("../utenti/ottieni_codice.php");
              var refreshId = setInterval(function()
              {
                  $container.load('../utenti/ottieni_codice.php');
              },2000);
          });
      })(jQuery);
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Corsi</h1>
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
                <h3 class="panel-title">Aggiungi Tessera</h3>
              </div>
              <div class="panel-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <a href="utenti.php">Corsi</a> / <a href="manage_corso.php?id=<?php echo $id_turno;?>&nome=<?php echo $nome?>"><?php echo $nome; ?></a> / <a href="#">Aggiungi Partecipante</a>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-12">
                    <form action="conferma.php" method="post">
                      <div class="row">
                        <div class="col-md-4">
                          <label>Card</label>
                          <div id="content"></div>
                        </div>
                        <div class="col-md-8">
                          <br>
                          <button type="submit" class="btn btn-info" name="add_partecipante">Conferma</button>
                        </div> 
                      </div>
                    </form>
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
  </body>
</html>
