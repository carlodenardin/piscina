<?php
include 'config/config.php';

$alert = "";
$messaggio = "";

if ($result = mysqli_query($connessione, "SELECT codice FROM dati")) {

    /* determine number of rows result set */
    $row = mysqli_num_rows($result);

    if($row!=0){
      $sql = "DELETE FROM dati";
      $connessione->query($sql);
    }
}

if(isset($_POST['aggiungi_utente'])){
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $data = $_POST['data'];
  $email = $_POST['email'];
  $cellulare = $_POST['cell'];
  $sql = "INSERT INTO bagnanti (nome,cognome,data,email,cell) VALUES ('$nome', '$cognome', '$data', '$email', '$cellulare')"; //VERIFICATA
  if($connessione->query($sql)){
    $alert = "alert alert-success";
    $messaggio = "Utente aggiunto";
  }
  else{
    $alert = "alert alert-danger";
    $messaggio = "Utente <strong>NON</strong> aggiunto";
  }
}


//stampa
$sql = "SELECT * FROM bagnanti ORDER BY cognome"; //VERIFICATA
$var = $connessione->query($sql);
$result="";
while($obj = $var->fetch_object()){
  $result.="<tr data-nome='".$obj->nome."' data-cognome='".$obj->cognome."' data-data='".$obj->data."' data-email='".$obj->email."' data-cell='".$obj->cell."'><td>".$obj->nome."</td>";
  $result.="<td>".$obj->cognome."</td>";
  $result.="<td>".$obj->data."</td>";

  $sql = "SELECT * FROM card WHERE fk_bagnante='".$obj->id_bagnante."'";
  $risultato = $connessione->query($sql);
  $row = mysqli_num_rows($risultato);

  if($row!=0){
    $result.="<td><button type='button' class='btn btn-success'>ATTIVA</button></td></tr>";
  }
  else{
    $result.="<td><button type='button' class='btn btn-danger'>NON ATTIVA</button></td></tr>";;
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

      $(function () {
        $('#viewProfilo').modal({
            keyboard: true,
            backdrop: "static",
            show: false,

          }).on('show', function () {

        });

        $(".table-striped").find('tr[data-nome]').on('click', function () {
            debugger;

            //do all your operation populate the modal and open the modal now. DOnt need to use show event of modal again
            $('#nomeProfilo').html($("<div class='col-md-4'><li class='list-group-item'><strong>Nome:</strong></li></div><div class='col-md-8'><li class='list-group-item'> "  + $(this).data('nome') +"</li></div>"));
            $('#viewProfilo').modal('show');
        });

        $(".table-striped").find('tr[data-cognome]').on('click', function () {
            debugger;

            //do all your operation populate the modal and open the modal now. DOnt need to use show event of modal again
            $('#cognomeProfilo').html($("<div class='col-md-4'><li class='list-group-item'><strong>Cognome:</strong></li></div><div class='col-md-8'><li class='list-group-item'> "  + $(this).data('cognome') +"</li></div>"));
            $('#viewProfilo').modal('show'); 
        });

        $(".table-striped").find('tr[data-data]').on('click', function () {
            debugger;
            //do all your operation populate the modal and open the modal now. DOnt need to use show event of modal again
            $('#dataProfilo').html($("<div class='col-md-4'><li class='list-group-item'><strong>Data di nascita:</strong></li></div><div class='col-md-8'><li class='list-group-item'> "  + $(this).data('data') +"</li></div>"));
            $('#viewProfilo').modal('show'); 
        });

        $(".table-striped").find('tr[data-email]').on('click', function () {
            debugger;

            //do all your operation populate the modal and open the modal now. DOnt need to use show event of modal again
            $('#emailProfilo').html($("<div class='col-md-4'><li class='list-group-item'><strong>Email:</strong></li></div><div class='col-md-8'><li class='list-group-item'> "  + $(this).data('email') +"</li></div>"));
            $('#viewProfilo').modal('show'); 
        });

        $(".table-striped").find('tr[data-cell]').on('click', function () {
            debugger;

            //do all your operation populate the modal and open the modal now. DOnt need to use show event of modal again
            $('#cellProfilo').html($("<div class='col-md-4'><li class='list-group-item'><strong>Cellulare:</strong></li></div><div class='col-md-8'><li class='list-group-item'> "  + $(this).data('cell') + "</li></div>"));
            $('#viewProfilo').modal('show'); 
        });
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
            <li><a href="login.html">Logout</a></li>
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
                <h3 class="panel-title">Utenti</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#addUtente">Aggiungi Utente</a>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class= <?php echo('"'.$alert.'"') ?> >
                      <?php echo $messaggio; ?>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtra utenti per nome...">
                      </div>
                </div>
                <br>
                <table class="table table-striped" id="myTable">
                      <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Data</th>
                        <th>Card</th>
                      </tr>
                      <?php echo $result; ?>
                </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    

    <!-- Modals -->

    <!-- addUtente -->
    <div class="modal fade" id="addUtente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="utenti.php" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Aggiungi Utente</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome">
              </div>
              <div class="form-group">
                <label>Cognome</label>
                <input type="text" class="form-control" placeholder="Cognome" name="cognome">
              </div>
              <div class="form-group">
                <label>Data Nascita</label>
                <input type="date" class="form-control" name="data">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email">
              </div>
              <div class="form-group">
                <label>Cellulare</label>
                <input type="numeric" class="form-control" placeholder="Cellulare" name="cell">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="aggiungi_utente">Aggiungi Utente</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    

    <!-- viewProfilo -->
    <div class="modal fade" id="viewProfilo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h3>Profilo</h3>
            </div>
            <div class="modal-body">
              <ul class="list-group">
                <div id="nomeProfilo"></div>
                <div id="cognomeProfilo"></div>
                <div id="dataProfilo"></div>
                <div id="emailProfilo"></div>
                <div id="cellProfilo"></div>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
        </div>
      </div>
    </div>

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
