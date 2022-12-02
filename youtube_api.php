<?php

session_start();

if (!isset($_SESSION['access_token'])) {
    header('Location: login.php');
    exit();
}
$api_key = "AIzaSyD4IEp_z5AnsNZXyB1vQpvvwx8opPswNnY"; // Ingresar tu Api Key
$channel_id = $_POST['yt_id'];
//$channel_id="UCUwFc3mLJxaQqbQa-J6pueQ"; // El Id del canal
$max_results = "2"; // Resultados a mostrar

// LLamar a la API para obtener la lista de videos en JSON
$query = "https://www.googleapis.com/youtube/v3/search?key=$api_key&channelId=$channel_id&part=snippet,id&order=date&maxResults=" . $max_results;
$videoList = file_get_contents($query);

// Convertir el JSON a Array
$results = json_decode($videoList, true);

// Para debugear
// echo "<pre>";
// print_r($results); 
// echo "</pre>";


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login With Google</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Google</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>API's</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="geo.php">Geolocalizacion</a>
                        <a class="collapse-item" href="redes.php">Redes Sociales</a>
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="yt.php">Buscador de ID(YouTube)</a>
                            <a class="collapse-item" href="adminyt.php">Administrar videos</a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cerrar sesion</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>




                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Mi informacion</h1>
                    <p class="mb-4">Informacion obtenida gracias a la API de Google </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos de la cuenta</h6>
                        </div>
                        <div class="card-body">
                            <!-- EN ESTE PINCHE CUADRO VAN LAS API -->
                            <div class="center">
                                <?php

                                //recorrer resultados
                                foreach ($results['items'] as $items) {
                                    $id = $items['id']['videoId']; //  Id del video
                                    $title = $items['snippet']['title']; // Titulo del video
                                    $description = $items['snippet']['description']; // Descripcion del video
                                    $published_at = $items['snippet']['publishedAt']; // Fecha de publicacion
                                    $channel_title = $items['snippet']['channelTitle']; // Titulo del canal
                                    $thumbnail = $items['snippet']['thumbnails']['default']['url']; // Imagen miniatura, 3 valores: default, medium, high

                                    //mostrar resultados
                                    echo "<div style='display:inline-block; width:250px; margin:10px; text-align:center; vertical-align:top; border-radius: 30px; background: #bdbdbd;'>";
                                    echo "<img src='$thumbnail'>";
                                    echo "<h3>$title</h3>";
                                    echo "<p>$description</p>";
                                    echo "<p><i>$published_at</i></p>";
                                    echo "<p>Por <b>$channel_title</b></p>";
                                    echo "<p><a href=\"https://youtube.com/watch?v=$id\" target='_blank'>Ver video</a></p>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


</body>

</html>