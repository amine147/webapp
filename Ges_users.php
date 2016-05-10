<?php
session_start();
    require('config.php');
    if($_SESSION['connected']==1){

    $Users = $db->get('Users');
    $categories = $db->get('Categories');

    if(isset($_GET['action'])){
      switch ($_GET['action']) {
        case '1':
        $dt = Array('userlvl'=> 1);
        $db->where ('id', $_GET['id']);
        $db->update('Users',$dt);
        header("location: ./Ges_users.php");
          break;
        case '2':
        $dt = Array('userlvl'=>2);
        $db->where ('id', $_GET['id']);
        $db->update('Users',$dt);
        header("location: ./Ges_users.php");
          break;
        case '3':
        $dt = Array('userlvl'=>3);
        $db->where ('id', $_GET['id']);
        $db->update('Users',$dt);
        header("location: ./Ges_users.php");
          break;
        case '4':
        $dt = Array('status'=>0);
        $db->where ('id', $_GET['id']);
        $db->update('Users',$dt);
        header("location: ./Ges_users.php");
          break;
        case '5':
        $dt = Array('status'=>1);
        $db->where ('id', $_GET['id']);
        $db->update('Users',$dt);
        header("location: ./Ges_users.php");
          break;
        default:
        header("location: ./Ges_users.php");
          break;
      }
    }
  }
  else{
    header("location:index.php");
  }

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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Cafette app Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['nom']." ".$_SESSION['prenom']; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                      </li>

                      <li class="divider"></li>
                      <li>
                          <a href="<?php /*session_destroy();*/ echo 'logout.php'?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                      </li>
                  </ul>
              </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dash.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="Ges_users.php"><i class="fa fa-fw fa-users"></i> Gestion des utilisateurs </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-bar-chart-o"></i> Gestion des ventes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <?php
                                $categories = $db->get('Categories');
                                foreach($categories as $cat) {
                            ?>
                            <li>
                                <?php echo '<a href="gestion_ventes.php?cat='.$cat['id'].'">'; ?>
                                    <?php echo $cat['nom']; ?>
                                </a>
                            </li>
                            <?php
                            }
                            ?>

                        </ul>
                    </li>
                    <li>
                        <a href="transactions.php"><i class="fa fa-fw fa-table"></i> Transactions</a>
                    </li>
                    <li>
                        <a href="Ges_stocks.php"><i class="fa fa-fw fa-table"></i> Gestion des stocks </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Gestion des utilisateurs
                        </h1>
                        <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                          </li>
                            <li class="active">
                                <i class="fa fa-users"></i>  Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel panel-primary filterable">
                          <div class="panel-heading">
                              <h3 class="panel-title">Les utilisateurs</h3>
                              <div class="pull-right">
                                  <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrer</button>
                              </div>
                          </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="filters">
                                        <th><input type="text" class="form-control" placeholder="Nom complet" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Fonction" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Solde" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Niveau User" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Statut" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="" disabled></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $lvl = ['User normal','Membre du BDE','Administrateur'];
                                  $uslvl = [1,2,3];
                                  $status = ['Non actif','Actif'];
                                    include('paginator.class.php');
                                    try {
                                        foreach ($Users as $row) {

                                            //$db->where('id', $row['idUser']);
                                            $usersUtil = $db->get('Users');

                                                $utilisateurNomComplet =  ucfirst($row['prenom'])." ".strtoupper($row['nom']);
                                                $fonction = ucfirst($row['fonction']);
                                                $solde = $row['solde'];
                                                $usrlvl = $lvl[$row['userlvl']-1];
                                                $statut = $status[$row['status']];
                                                if($row['status']==1)
                                                  echo "<tr>";
                                                if($row['status']==0)
                                                  echo "<tr class='danger'>";
                                                echo '<td>'.$utilisateurNomComplet.'</td>';
                                                echo '<td>'.$fonction.'</td>';
                                                echo '<td>'.$solde.' € </td>';
                                                echo '<td>'.$usrlvl.'</td>';
                                                echo '<td>'.$statut.'</td>';
                                                echo '<td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary">Actions</button>
                                                    <button type="button" class="btn btn-primary dropdown-toggle" type="submit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <li><a href="Ges_users.php?action=1&id='.$row['id'].'">Utilisateur</a></li>
                                                    <li><a href="Ges_users.php?action=2&id='.$row['id'].'">Membre BDE</a></li>
                                                    <li><a href="Ges_users.php?action=3&id='.$row['id'].'">Administrateur</a></li>
                                                    <li role="separator" class="divider"></li>';
                                                if($row['status']==1)
                                                echo '<li><a href="Ges_users.php?action=4&id='.$row['id'].'">Désactiver utilisateur</a></li>';
                                                if($row['status']==0)
                                                echo '<li><a href="Ges_users.php?action=5&id='.$row['id'].'">Activer utilisateur</a></li>';

                                                echo '</ul>
                                                  </div>
                                              </td>';
                                                echo "</tr>";
                                            }

                                        } catch(PDOException $e) {
                                            echo 'ERROR: ' . $e->getMessage();
                                        }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');



                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                console.log("value : "+$rows);
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });
        });

    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
