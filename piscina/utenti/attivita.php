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
$_SESSION['id_passato']=$id;

$sql = "SELECT * FROM bagnanti WHERE id_bagnante='$id'";//VERIFICATA
$risultato = $connessione->query($sql);
$row = $risultato->fetch_array();

$nome = $row['nome'];
$cognome = $row['cognome'];

$sql2 = "SELECT * FROM attivita WHERE fk_bagnante='$id'";//VERIFICATA
$risultato2 = $connessione->query($sql2);
$stampa = "";

while($obj = $risultato2->fetch_object()){
  $data = $obj->data;
  $date = date_create($data);
  $data = date_format($date, 'd-m-Y H:i:s');
  $data = str_replace("-", "/", $data);

  $stampa.="<tr><td>".$obj->tipo."</td>";
  $stampa.="<td>".$data."</td></tr>";
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

    <script>
      function myFunction() { 
        var input, filter, table, tr, td, i;input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Utenti</h1>
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
              <a href="utenti.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Utenti </a>
              <a href="../corsi/corsi.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Corsi <span class="badge"></span></a>
            </div>

          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Utenti</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <a href="utenti.php">Utenti</a> / <a href="profilo.php?id=<?php echo $id?>"><?php echo $nome." ".$cognome ?></a> / <a href="#">Attività</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtra utenti per data...">
                      </div>
                </div>
                <br>
                <table class="table table-striped" id="myTable">
                  <tr>
                    <th>Tipo Entrata</th>
                    <th>Data</th>
                  </tr>
                  <?php echo $stampa; ?>
                </table>
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
    <script src="../bootstrapjs/bootstrap.min.js"></script>
    <script href="../bootstrap/js/jquery-1.8.3.min"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  </body>
</html>
