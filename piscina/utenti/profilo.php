<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$alert = "";
$messaggio = "";

$id = $_GET['id'];
//passo il valore ad attivita.php
$_SESSION['id_passato']=$id;

$sql = "SELECT * FROM bagnanti WHERE id_bagnante='$id'";//VERIFICATA
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();

$nome = $row['nome'];
$cognome = $row['cognome'];
$data = $row['data'];
$email = $row['email'];
$cell = $row['cell'];

if(isset($_GET['salva'])){
  $id = $_GET['id'];
  $nome = $_GET['nome'];
  $cognome = $_GET['cognome'];
  $data = $_GET['data'];
  $email = $_GET['email'];
  $cell = $_GET['cell'];
  $sql = "UPDATE bagnanti SET nome='".$nome."',cognome='".$cognome."',data='".$data."',email='".$email."',cell='".$cell."' WHERE id_bagnante='$id'";
  if($connessione->query($sql)){
    $alert = "alert alert-success";
    $messaggio = "Utente modificato";
  }
  else{
    $alert = "alert alert-danger";
    $messaggio = "Utente <strong>NON</strong> modificato";
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
                        <a href="utenti.php">Utenti</a> / <a href="#"><?php echo $nome." ".$cognome ?></a>
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
                  <div class="col-md-8">
                    <form class="form-horizontal" method="get" action="profilo.php?id=<?php echo $id?>">
                      <input type="hidden" value="<?php echo $id;?>" name="id">
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Nome:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $nome;?>" type="text" name="nome">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Cognome:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $cognome;?>" type="text" name="cognome">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Data di nascita:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $data;?>" type="date" name="data">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                          <input class="form-control" value="<?php echo $email;?>" type="email" name="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Cellulare:</label>
                        <div class="col-md-8">
                          <input class="form-control" value="<?php echo $cell;?>" type="number" name="cell">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                          <input class="btn btn-info" value="Salva" type="submit" name="salva">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-4">
                    <div class="col-md-12">
                      <ul class="list-group">
                        <li class="list-group-item"><a href="attivita.php"><button style="width: 100%;" type="button" class="btn btn-info">Attività</button></a></li>
                        <li class=  "list-group-item"><a href="card.php"><button style="width: 100%;" type="button" class="btn btn-info">Card</button></a></li>
                      </ul>
                    </div>
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
