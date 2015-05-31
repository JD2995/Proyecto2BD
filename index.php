<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Migración</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/tabs.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Tablas
                    </a>
                </li>
                <li>
                    <a href="#">Todas las demas opciones aqui</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <form action = "exportarTablas.php" method = "POST" role = "form">
                                <button type = "submit" class="btn btn-info">
                                    <span class = "glyphicon glyphicon-file" aria-hidden="true"></span>  Exportar Base de datos a Excel
                                </button>
                             </form>            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form action="importarTablas.php" method="POST" role = "form">
                                 <button type = "submit" class="btn btn-info">
                                    <span class = "glyphicon glyphicon-upload" aria-hidden="true"></span>  Importar Base de datos desde Excel
                                </button>
                             </form>              
                        </td>
                    </tr>
                 </table>
            </div>
        </div>                  
    </div>        
                
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
