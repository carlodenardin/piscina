<?php
session_start();
include 'config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=logout.php");
}

$alert = "";
$messaggio = "";
$disabled = "";
$title = "";

//ricevo il valore da profilo.php
$id = $_SESSION['id_passato'];

$sql = "SELECT * FROM bagnanti WHERE id_bagnante='$id'";//VERIFICATA
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();

$nome = $row['nome'];
$cognome = $row['cognome'];

$sql2 = "SELECT * FROM card WHERE fk_bagnante='$id'";
$risultato2 = $connessione->query($sql2);
$row2 = $risultato2->fetch_array();

$card = $row2['id_card'];
$tipo = $row2['tipo'];
$entrate = $row2['entrate'];

if($card!=""){
  $disabled = "disabled";
  $title = "Carta già associata";
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <script>
      $('a[data-toggle="tooltip"]').tooltip({
          animated: 'fade',
          placement: 'bottom',
      });
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
            <li><a href="logout.php">Logout</a></li>
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
              <a href="index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
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
                        <a href="utenti.php">Utenti</a> / <a href="profilo.php?id=<?php echo $id?>"><?php echo $nome." ".$cognome ?></a> / <a href="#">Card</a>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-8">
                    <form class="form-horizontal" method="post" action="profilo.php">
                      <input type="hidden" value="<?php echo $id;?>" name="id">
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Card:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $card;?>" type="text" name="card" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Tipo:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $tipo;?>" type="text" name="tipo" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Entrate</label>
                        <div class="col-lg-3">
                          <input class="form-control" value="<?php echo $entrate;?>" type="number" name="entrate" disabled>
                        </div>
                      </div>
                    </form>
                  </div>

                <div class="col-md-4">
                  <div class="col-md-12">
                    <ul class="list-group">
                      <li class="list-group-item"><a data-toggle="tooltip" href="add_card.php" title="<?php echo $title?>"><button style="width: 100%;" type="button" class="btn btn-info" <?php echo $disabled?>>Aggiungi Card</button></a></li>
                      <li class="list-group-item"><a href="remove_card.php"><button style="width: 100%;" type="button" class="btn btn-info">Disattiva Card</button></a></li>
                      
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
    <script src="js/bootstrap.min.js"></script>
    <script href="js/jquery-1.8.3.min"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  </body>
</html>
