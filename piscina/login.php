<?php
session_start();
include 'config/config.php';
$messaggio = "";
$alert = "";

if(isset($_POST['accedi'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;

  if($username==$u && $password==$p){
    $messaggio = "Autenticazione effettuata!";
    $alert = "alert alert-success";
    header("Refresh:0; url=index.php");
  }
  else{
    $messaggio = "Credenziali sbagliate!";
    $alert = "alert alert-danger";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
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

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form action="login.php" class="well" method="post">
              <div class= <?php echo('"'.$alert.'"') ?> >
                <?php echo $messaggio; ?>
              </div>
              <div class="form-group">
                <label>Nome Utente</label>
                <input type="text" class="form-control" placeholder="Utente" name="username">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <button type="submit" class="btn btn-default btn-block" name="accedi">Login</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
