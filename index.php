<?php
    session_start();
    require('config.php');

<<<<<<< HEAD
    if( isset($_GET['mail']) && isset($_GET['pswd']) ) {
      $db->where('email',$_GET['mail']);
      $db->where('password_hash',md5($_GET['pswd']));
      $db->where('userlvl',3);
      $db->where('status',1);
       if($db->get('Users')){
          echo 'OK';
          $Users =$db->get('Users');
          $_SESSION['name'] = ucfirst($Users['prenom'])." ".strtoupper($Users['nom']);
          $_SESSION['id'] = $Users['id'];

          header("location:dash.php");
        }
    }
=======
    $db->where('email',$_GET['mail']);
    $db->where('password_hash',md5($_GET['pswd']));
    $db->where('userlvl',3);
    $db->where('status',1);
    $Users =$db->get('Users');
     if($Users){
      // print_r($Users[0]);
       $LeUser = $Users[0];
        $_SESSION['nom'] = strtoupper($LeUser['nom']);
        $_SESSION['prenom'] = ucfirst($LeUser['prenom']);
        $_SESSION['id'] = $LeUser['id'];
        $_SESSION['connected'] = 1;

      header("location:dash.php");
      setcookie("Session_User",$_SESSION,time()+1800);

      }
>>>>>>> origin/YahyaAr-patch-1


?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cafette app - Administration</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  <div class='container'>
    <div class="col-md-4 col-md-offset-4">
  <div class="panel panel-primary" style="background-color:transparent;">
    <div class="panel-heading">
      <h3 class="panel-title">Connexion au panel d'Administrateur</h3>
    </div>
    <div class="panel-body">
      <form>


      <div style="margin-bottom: 12px" class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="login-username" type="text" class="form-control" name="mail" value="" placeholder="Email">
      </div>
      <div style="margin-bottom: 12px" class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="login-username" type="password" class="form-control" name="pswd" value="" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-success">Connexion</button>
    </form>
    </div>
  </div>
</div>
</div>
</body>
</html>
