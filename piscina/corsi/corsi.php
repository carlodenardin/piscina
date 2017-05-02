<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
}

$stampa="";
$stampa2="";

if(isset($_POST['aggiungi_corso'])){
  $nome = $_SESSION['nome'];
  $turni = $_SESSION['turni'];
  $orari = $_SESSION['orari'];

  $giorni = array();
  $turniI = array();
  $turniF = array();
  $lezioni = array();
  $orariI = array();
  $orariF = array();

  $sql = "INSERT INTO corsi (nome) VALUES ('$nome')";
  $connessione->query($sql);

  for($i=1;$i<=7;$i++){
    if(isset($_POST['giorno'.$i])){
      $giorni[$i] = $_POST['giorno'.$i];
      $sql = "SELECT id_corso FROM corsi WHERE nome='$nome'";
      $risultato = $connessione->query($sql);
      $row = $risultato->fetch_array();
      $sql = "INSERT INTO rel_giorni_corsi (fk_giorno,fk_corso) VALUES ('".$_POST['giorno'.$i]."','".$row[0]."')";
      $connessione->query($sql);
    }
  }

  for($i=1;$i<=$turni;$i++){
    if(isset($_POST['turno'.$i.'i'])&&isset($_POST['turno'.$i.'f'])&&isset($_POST['lezioni'.$i])){
      $turniI[$i] = $_POST['turno'.$i.'i'];
      $turniF[$i] = $_POST['turno'.$i.'f'];
      $lezioni[$i] = $_POST['lezioni'.$i];
      $sql = "SELECT id_corso FROM corsi WHERE nome='$nome'";
      $risultato = $connessione->query($sql);
      $row = $risultato->fetch_array();
      $sql = "INSERT INTO turni (dal,al,lezioni,fk_corso) VALUES ('$turniI[$i]','$turniF[$i]','$lezioni[$i]','$row[0]')";
      $connessione->query($sql);
    }
  }

  for($i=1;$i<=$orari;$i++){
    if(isset($_POST['orario'.$i.'i'])&&isset($_POST['orario'.$i.'f'])){
      $orariI[$i] = $_POST['orario'.$i.'i'];
      $orariF[$i] = $_POST['orario'.$i.'f'];
      $sql = "SELECT id_corso FROM corsi WHERE nome='$nome'";
      $risultato = $connessione->query($sql);
      $row = $risultato->fetch_array();
      $sql = "INSERT INTO orari (dalle,alle,fk_corso) VALUES ('$orariI[$i]','$orariF[$i]','$row[0]')";
      $connessione->query($sql);
    }
  }

  
}

$sql = "SELECT * FROM corsi";
$risultato = $connessione->query($sql);
$i=1;

while($obj = $risultato->fetch_object()){
  $stampa.='<div class="panel panel-default"><div class="panel-heading main-color-bg"><h3 class="panel-title">'.$obj->nome.'</h3></div><div class="panel-body"><table class="table table-striped"><tr><th>Turno</th><th>Dal</th><th>Al</th><th>Lezioni</th><th>Gestione</th></tr>';

  $sql2 = "SELECT * FROM turni WHERE fk_corso='".$obj->id_corso."'";
  $risultato2 = $connessione->query($sql2);
  while($obj2 = $risultato2->fetch_object()){
    $datai = $obj2->dal;
    $datai = explode("-",$datai);
    $datai = $datai[2]."/".$datai[1]."/".$datai[0];
    $dataf = $obj2->al;
    $dataf = explode("-",$dataf);
    $dataf = $dataf[2]."/".$dataf[1]."/".$dataf[0];
    $stampa2.= '<tr><td>Turno '.$i.'</td><td>'.$datai.'</td><td>'.$dataf.'</td><td>'.$obj2->lezioni.'</td><td><a href="manage_corso.php?nome='.$obj->nome.'&id='.$obj2->id_turno.'"><button type="button" class="btn btn-info">Gestisci</button></a></td></tr>';
    $i++;
  }
  $stampa.=$stampa2;

  $stampa.='</table></div></div>';
  $stampa2="";
  $i=1;
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

      // FUNZIONE PER FILTRARE COGNOMI
      function myFunction() { 
        var input, filter, table, tr, td, i;input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          } 
        }
      }
   
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
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Corsi</h3>
              </div>
              <div class="panel-body">
                <form action="add_corso.php" method="post">
                  <div class="panel panel-default">
                    <div class="panel-body" style="height:62px">
                      <div class="form-inline"> 

                          <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control">
                          </div>

                          <div class="form-group">
                            <label>Turni:</label>
                            <select class="form-control" name="turni">
                              <option disabled>-</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                            </select>
                          </div>
                        
                        
                          <div class="form-group">
                            <label>Orari:</label>
                            <select class="form-control" name="orari">
                              <option disabled>-</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <button type="submit" class="btn btn-info">Aggiungi Corso</button>
                          </div>

                      </div>
                    </div>
                  </div>
                </form>
                
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
