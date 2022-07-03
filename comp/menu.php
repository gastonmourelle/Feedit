<!-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Dispensador M2</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header> -->

<nav id="nav_mobile" class="navbar navbar-expand-lg bg-light sticky-top">
    <div class="container-md">
        <a href="index.php">
            <img src="svg/slack.svg" alt="" width="130" height="">
        </a>
        <button style="margin-top:10px" class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span style="width: 30px; height: 30px;" data-feather="menu"></span>
        </button>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">        
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse collapse-horizontal">
            <a href="index.php">
                <img id="img_header" style="margin-left:15px;margin-bottom:40px;" src="svg/slack.svg" alt="" width="130" height="">
            </a>
            <div class="d-inline-flex p-3">
                <input class="form-control me-2" name="buscar" id="buscar" type="text" placeholder="&#xF002;  Buscar..." style="font-family:system-ui, FontAwesome" aria-label="Buscar" aria-describedby="basic-addon1">
            </div>
            <?php $actual = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); ?>
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= $actual == 'index.php' ? 'active':'' ?>" href="index.php">
                            <span data-feather="home"></span>
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $actual == 'listado.php' ? 'active':'' ?>" href="listado.php">
                            <span data-feather="file-text"></span>
                            Listado
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $actual == 'registro.php' ? 'active':'' ?>" href="registro.php">
                            <span data-feather="user-plus"></span>
                            Nuevo registro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $actual == 'verificacion.php' ? 'active':'' ?>" href="verificacion.php">
                            <span data-feather="check-square"></span>
                            Verificar código
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $actual == 'logs_diarios.php' ? 'active':'' ?>" href="logs_diarios.php">
                            <span data-feather="database"></span>
                            Logs
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="logout.php" method="post">
                            <button name="logout" type="submit" class="btn btn-dark btn-sm"><span data-feather="log-out"></span>Cerrar sesión</button>
                        </form>
                    </li>
                </ul>

                <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Logs</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                </ul> -->
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">