<?php
    session_start();

    require('config.php');
    if($_SESSION['connected']==1){
    $db->orderBy("id","desc");
    $transactions = $db->get('Transactions');

    $categories = $db->get('Categories');
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

    <title>Cafette App - Transactions</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

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
                    <li>
                        <a href="Ges_users.php"><i class="fa fa-fw fa-users"></i> Gestion des utilisateurs</a>
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
                    <li class="active">
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
                            Transactions
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dash.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Transactions
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel panel-primary filterable">
                            <div class="panel-heading">
                                <h3 class="panel-title">Historique</h3>
                                <div class="pull-right">
                                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrer</button>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="filters">
                                        <th><input type="text" class="form-control" placeholder="Utilisateur" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Bénéficiaire" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Montant" disabled></th>
                                        <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include('paginator.class.php');
                                    try {
                                        foreach ($transactions as $row) {

                                            $db->where('id', $row['idUser']);
                                            $usersUtil = $db->get('Users');

                                            foreach($usersUtil as $user) {
                                                $utilisateurNom = $user['nom'];
                                                $utilisateurPrenom = $user['prenom'];
                                            }

                                            $db->where('id', $row['idBeneficiaire']);
                                            $usersBenef = $db->get('Users');

                                            foreach($usersBenef as $us) {
                                                $BeneficiaireNom = $us['nom'];
                                                $BeneficiairePrenom = $us['prenom'];
                                            }

                                                echo "<tr>";
                                                echo '<td>'.$utilisateurNom.' '.$utilisateurPrenom.'</td>';
                                                echo '<td>'.$BeneficiaireNom.' '.$BeneficiairePrenom.'</td>';
                                                echo '<td>'.$row['montant'].' € </td>';
                                                echo '<td>'.$row['date'].'</td>';
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
            <?php
                //echo '<center><span class=\"\">'.$pages->display_jump_menu().$pages->display_items_per_page().'</span></center>';
            ?>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

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

</body>

</html>
