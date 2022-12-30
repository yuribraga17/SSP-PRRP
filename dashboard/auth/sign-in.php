<?php
if (!isset($_SESSION)) {
    session_start();
}

include($_SERVER['DOCUMENT_ROOT'] . "/system/classes/Usuario.php");
$Usuario = new Usuario;
$erro = "";
if (isset($_GET["logout"]) and isset($_SESSION['usuario_id'])) {
    $Usuario->Deslogar();
} else if (isset($_SESSION['usuario_id'])) return header("location: /dashboard/index");
else if (isset($_POST["login_user"])) {
    if (!$Usuario->Logar($_POST["usuario"], $_POST["password"])) {
        $erro = "Usuário ou senha incorretos.";
    } else {
        return header("location: /dashboard/index");
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SP:RP - Sistema SSP</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/images/ssp.png"/>
    <link rel="stylesheet" href="../../assets/css/libs.min.css">
    <link rel="stylesheet" href="../../assets/css/nairobi.css?v=1.0.0">
</head>
<body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->
<div>
    <div class="wrapper">
        <section class="vh-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="../../assets/images/ssp.png" alt="Logo SSP">
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="auth-form">
                                    <h2 class="text-center mb-4">Login</h2>
                                    <form method="POST">
                                        <p class="text-center">Faça login para acessar o sistema</p>
                                        <div class="form-group">
                                            <label for="usuario" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="usuario" name="usuario"
                                                   aria-describedby="usuario"
                                                   placeholder=" ">
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Senha</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                       aria-describedby="password" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <?php if($erro != "") { ?><p class="text-center text-danger"><?= $erro ?></p><?php } ?>
                                            <button type="submit" id="login_user" name="login_user" class="btn btn-primary">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-bottom">
                <a href="../index.php">
                    <img src="../../assets/images/ssp.png" alt="Logo SSP" style="width: 35px">
                </a>
            </div>
        </section>
    </div>
</div>


<!-- Backend Bundle JavaScript -->
<script src="../../assets/js/libs.min.js"></script>
<!-- widgetchart JavaScript -->
<script src="../../assets/js/charts/widgetcharts.js"></script>
<!-- dashboard JavaScript -->
<script src="../../assets/js/charts/dashboard.js"></script>

<!-- fslightbox JavaScript -->
<script src="../../assets/js/fslightbox.js"></script>
<!-- app JavaScript -->
<script src="../../assets/js/app.js"></script>
<!-- apexchart JavaScript -->
<script src="../../assets/js/charts/apexcharts.js"></script>
<!-- countdown JavaScript -->
<script src="../../assets/js/countdown.js"></script>
</body>
</html>