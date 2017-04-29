<?php
session_start();
include '../config/config.php';

if($_SESSION['username']!=$u||$_SESSION['password']!=$p){
  header("Refresh:0; url=../logout.php");
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

      $(document).ready(function(){
        $("#hideGiorno").click(function(){
          if( $('#a').is(':visible') && $('#b').is(':visible') && $('#c').is(':visible') ) {
            $("#c").hide();
          }
          else if( $('#a').is(':visible') && $('#b').is(':visible') && $('#c').is(':hidden')){
            $("#b").hide();
          }
          else if( $('#a').is(':visible') && $('#b').is(':hidden') && $('#c').is(':hidden')){
            $("#a").hide();
          }
        });
        $("#showGiorno").click(function(){
          //GIORNI
          if( $('#a').is(':hidden') && $('#b').is(':hidden') && $('#c').is(':hidden') ) {
            $("#a").show();
          }
          else if( $('#a').is(':visible') && $('#b').is(':hidden') && $('#c').is(':hidden')){
            $("#b").show();
          }
          else if( $('#a').is(':visible') && $('#b').is(':visible') && $('#c').is(':hidden')){
            $("#c").show();
          }

        });
      });

      $(document).ready(function(){
        $("#hideOrario").click(function(){
          if( $('#orario1').is(':visible') && $('#orario2').is(':visible') && $('#orario3').is(':visible') && $('#orario4').is(':visible') ) {
            $("#orario4").hide();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':visible') && $('#orario3').is(':visible') && $('#orario4').is(':hidden') ) {
            $("#orario3").hide();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':visible') && $('#orario3').is(':hidden') && $('#orario4').is(':hidden') ) {
            $("#orario2").hide();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':hidden') && $('#orario3').is(':hidden') && $('#orario4').is(':hidden') ) {
            $("#orario1").hide();
          }
        });
        $("#showOrario").click(function(){
          if( $('#orario1').is(':hidden') && $('#orario2').is(':hidden') && $('#orario3').is(':hidden') && $('#orario4').is(':hidden') ) {
            $("#orario1").show();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':hidden') && $('#orario3').is(':hidden') && $('#orario4').is(':hidden') ) {
            $("#orario2").show();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':visible') && $('#orario3').is(':hidden') && $('#orario4').is(':hidden') ) {
            $("#orario3").show();
          }
          else if( $('#orario1').is(':visible') && $('#orario2').is(':visible') && $('#orario3').is(':visible') && $('#orario4').is(':hidden') ) {
            $("#orario4").show();
          }
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
                <div class="row">
                  <div class="col-md-2">
                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#addCorso">Aggiungi Corso</a>
                  </div>
                </div>
                <div class="row"> 
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FORM AGGIUNGI UTENTE id=addCorso -->
    <div class="modal fade" id="addCorso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="corsi.php" method="post">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Aggiungi Corso</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <form action="corsi.php" method="post">

                  <div class="form-group">
                    <div class="panel panel-default">
                      <div class="panel-body" style="height:62px">
                        <div class="col-md-3">
                          <label>Nome corso:</label>
                        </div>
                        <div class="col-md-9">
                          <input type="text" class="form-control" id="usr">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body" style="height:110px">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Giorni:</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <button type="button" class="btn" id="showGiorno">Aggiungi</button>
                            <button type="button" class="btn" id="hideGiorno">Togli</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-md-3">
                          <div class="form-group">
                            <select class="form-control" id="sel1">
                              <option>-</option>
                              <option value="1">lun</option>
                              <option value="2">mar</option>
                              <option value="3">mer</option>
                              <option value="4">gio</option>
                              <option value="5">ven</option>
                              <option value="6">sab</option>
                              <option value="7">dom</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" id="a" hidden>
                            <select class="form-control" id="sel2">
                              <option>-</option>
                              <option value="1">lun</option>
                              <option value="2">mar</option>
                              <option value="3">mer</option>
                              <option value="4">gio</option>
                              <option value="5">ven</option>
                              <option value="6">sab</option>
                              <option value="7">dom</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" id="b" hidden>
                            <select class="form-control" id="sel3">
                              <option>-</option>
                              <option value="1">lun</option>
                              <option value="2">mar</option>
                              <option value="3">mer</option>
                              <option value="4">gio</option>
                              <option value="5">ven</option>
                              <option value="6">sab</option>
                              <option value="7">dom</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" id="c" hidden>
                            <select class="form-control" id="sel4">
                              <option>-</option>
                              <option value="1">lun</option>
                              <option value="2">mar</option>
                              <option value="3">mer</option>
                              <option value="4">gio</option>
                              <option value="5">ven</option>
                              <option value="6">sab</option>
                              <option value="7">dom</option>
                            </select>
                          </div>
                        </div>
            
                      </div>  
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Data Inizio</label>
                            <input type="date" class="form-control" name="datai">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Data Fine</label>
                            <input type="date" class="form-control" name="dataf">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-body">

                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Orario:</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <button type="button" class="btn" id="showOrario">Aggiungi</button>
                            <button type="button" class="btn" id="hideOrario">Togli</button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Inizio</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Fine</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                      </div>

                      <div class="row" id="orario1" hidden>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Inizio</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Fine</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                      </div>

                      <div class="row" id="orario2" hidden>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Inizio</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Fine</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                      </div>

                      <div class="row" id="orario3" hidden>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Inizio</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Fine</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                      </div>

                      <div class="row" id="orario4" hidden>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Inizio</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Orario Fine</label>
                            <input type="time" class="form-control" name="">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>


                </form>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
