<?php
session_start();
include 'config/config.php';

if ($result = mysqli_query($connessione, "SELECT codice FROM dati")) {

    /* determine number of rows result set */
    $row = mysqli_num_rows($result);

    if($row!=0){
      $sql = "DELETE FROM dati";
      $connessione->query($sql);
    }
}

$alert = "";
$messaggio = "";

$sql = "SELECT DISTINCT id_bagnante, cognome, nome FROM bagnanti WHERE id_bagnante NOT IN (SELECT fk_bagnante FROM card) ORDER BY cognome,nome";

$risultato=$connessione->query($sql);

$s='<option value="" disabled selected>Seleziona un utente</option>';

while($obj = $risultato->fetch_object()){
  $s.='<option value="'.$obj->id_bagnante.'">'.$obj->cognome.' '.$obj->nome.'</option>';
}

if(isset($_POST['aggiungi_card'])){
  $card = $_SESSION['card'];
  $entrate = $_POST['entrate'];
  $id = $_POST['id'];

  $sql = "INSERT INTO card (id_card,entrate,fk_bagnante) VALUES ('$card', '$entrate', '$id')"; //VERIFICATA
  if($connessione->query($sql)){
    $alert = "alert alert-success";
    $messaggio = "Carta configurata";
  }
  else{
    $alert = "alert alert-danger";
    $messaggio = "Carta <strong>NON</strong> configurata";
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <script href="js/jquery-1.8.3.min"></script>
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
            <li><a href="login.html">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Card</h1>
          </div>  
        </div>
      </div>
    </header>

    

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
              <a href="card.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Card </a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Card</h3>
              </div>

              <!-- PANNELLO ESTERNO -->
              <div class="panel-body"> 

                <!-- MENU CARD -->
                <div class="row">
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" href="card.php">Aggiungi Card</a>
                  </div>
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" href="modifica_card.php">Modifica Card</a>
                  </div>
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" href="ricerca_card.php">Ricerca Card</a>
                  </div>
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" href="disattiva_card.php">Disattiva Card</a>
                  </div>
                </div>

                <br>

                <div class="panel-heading main-color-bg">
                  <h3 class="panel-title">Aggiungi Card</h3>
                </div>

                <!-- PANNELLO INTERNO AGGIUNGI CARD -->
                <div class="panel-body"> 
                  <form action="card.php" method="post">
                    <div class="form-group">
                      <div class="row">
                        <div class= <?php echo('"'.$alert.'"') ?> >
                          <?php echo $messaggio; ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8">
                          <label>Card</label>
                          <div id="content"></div>
                        </div>
                        <div class="col-md-4">
                          <label>Nr entrate</label>
                          <select class="form-control" name="entrate">
                            <option value="" disabled selected>Aggiungi Entrate</option>
                            <option value="10">+10</option>
                            <option value="20">+20</option>
                            <option value="50">+50</option>
                          </select>
                        </div> 
                      </div>

                      <br>

                      <div class="row">
                        <div class="col-md-12">
                          <select class="form-control" name="id">
                            <?php echo $s;?>
                          </select>
                        </div>
                      </div>

                      <br>
                    
                      <button type="submit" class="btn btn-success" name="aggiungi_card">Attiva Card</button>
                    </div>
                  </form>
                </div>  
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    

    <!-- Modals -->

   

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
