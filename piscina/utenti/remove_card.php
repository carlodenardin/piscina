<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$alert = "";
$messaggio = "";

//ricevo il valore da profilo.php
$id = $_SESSION['id_passato'];

$sql = "SELECT * FROM bagnanti WHERE id_bagnante='$id'";//VERIFICATA
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();

$nome = $row['nome'];
$cognome = $row['cognome'];

if(isset($_POST['bottone'])){
  $sql = "DELETE FROM card WHERE fk_bagnante='$id'";//VERIFICATA
  if($connessione->query($sql)){
    $alert = "alert alert-success";
    $messaggio = "Carta eliminata";
    header("Refresh:1; url=card.php");
  }
  else{
    $alert = "alert alert-danger";
    $messaggio = "Carta <strong>NON</strong> eliminata";
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
              $container.load("ottieni_codice.php");
              var refreshId = setInterval(function()
              {
                  $container.load('ottieni_codice.php');
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
              <a href="utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
              <a href="../corsi/corsi.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Corsi <span class="badge"></span></a>
            </div>
          </div>
          <!--PANNELLO CENTRALE-->
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><?php echo $nome." ".$cognome ?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <a href="utenti.php">Utenti</a> / <a href="profilo.php?id=<?php echo $id?>"><?php echo $nome." ".$cognome ?></a> / <a href="card.php?id=<?php echo $id?>">Card</a> / <a href="#">Rimuovi Card</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class= <?php echo('"'.$alert.'"') ?> >
                      <?php echo $messaggio; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <div class="panel panel-default">
                      <div class="panel-body"><center>Sicuro di rimuovere la carta associata all'utente <strong><?php echo $nome." ".$cognome ?></strong>? </center>
                      </div>
                    </div>

                    <div class="panel panel-danger">
                        <div class="panel-heading"><h5><center>AZIONE NON REVERSIBILE</center></h5></div>
                    </div>
                    
                    <div class="col-md-6">
                      <form action="remove_card.php" method="post"><button style="width: 100%;" type="submit" class="btn btn-success" name="bottone">SI</button></form>
                    </div>
                    <div class="col-md-6">
                      <a href="card.php"><button style="width: 100%;" type="button" value="no" class="btn btn-danger" name="bottone">NO</button></a>
                    </div>
                  </div>
                  <div class="col-md-1"></div>
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
