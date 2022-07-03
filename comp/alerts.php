<?php
if (isset($_SESSION['exito'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <center><?php echo $_SESSION['exito'];
                                    unset($_SESSION['exito']); ?></center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
} else if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <center><strong>Error: </strong><?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?></center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
else if (isset($_SESSION['mensaje'])) { ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <center><?php echo $_SESSION['mensaje'];
                                    unset($_SESSION['mensaje']); ?></center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>