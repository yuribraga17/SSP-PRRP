<?php
session_start();
if (!isset($_SESSION['usuario_id'])) return header('location: auth/sign-in');

$saudacao = "";
date_default_timezone_set('America/Sao_Paulo');
$hora = date('H');
if ($hora >= 6 && $hora <= 12)
    $saudacao = 'Bom dia';
else if ($hora > 12 && $hora <= 18)
    $saudacao = 'Boa tarde';
else
    $saudacao = 'Boa noite';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PR:RP | Secretária de Segurança Pública</title>
    <meta name="keywords" content="SSP, Progressive, Roleplay, GTA 5, FiveM, GTA RP, gta, rp, grota, prrp, pr:rp, pr-rp, samp, mta, sa-mp"/> <!-- Palavras chaves de busca -->
    <meta name="author" content="Yuri Braga"/> <!-- criador do site -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/ssp.png"/>
    <link rel="stylesheet" href="../assets/css/libs.min.css">
    <link rel="stylesheet" href="../assets/css/nairobi.css?v=1.0.0">
</head>
<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->
<?php include $_SERVER["DOCUMENT_ROOT"] . "/dashboard/sidebar.php" ?>
<main class="main-content">
    <div class="position-relative">
        <!--Nav Start-->
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/dashboard/navbar.php" ?>
        <!--Nav End-->
    </div>
    <div class="container-fluid content-inner pb-0">
        <div class="row">
            <div class="mb-5 d-flex justify-content-between">
                <div>
                    <h2 class="text-primary fw-bold mb-3"><?= $saudacao ?> <?= $Usuario->get("faccao_cargo"); ?> <?= $Usuario->get("nome_personagem"); ?> <?= $Usuario->get("sobrenome_personagem"); ?></h2>
                    <p>Veja algumas informações importantes para hoje.</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Ligações 190</h4>
                                <p class="mb-2">Veja as últimas ligações 190 abaixo</p>
                            </div>
                        </div>
                        <div class="card card-block card-stretch custom-scroll">
                            <div class="table-responsive rounded">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Denunciante</th>
                                        <th>Localização</th>
                                        <th>Situação</th>
                                        <th>Telefone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include $_SERVER["DOCUMENT_ROOT"] . "/system/config/mysql/connecdb.php";
                                    $query_chamados = mysqli_query($con, "SELECT * FROM last911 ORDER BY nID DESC LIMIT 10");
                                    if (mysqli_num_rows($query_chamados) > 0) {
                                        while ($dados_chamados = mysqli_fetch_assoc($query_chamados)) {
                                            $data = explode("-", $dados_chamados["nData"]);
                                            $data_final = $data[0] . "/" . $data[1] . "/" . $data[2] . " às " . $data[3];
                                            ?>
                                            <tr class="white-space-no-wrap">
                                                <td><?= $data_final ?></td>
                                                <td><?= $dados_chamados["nNome"] ?></td>
                                                <td><?= $dados_chamados["nLocalizacao"] . ", " . $dados_chamados["nRastreador"] ?></td>
                                                <td><?= $dados_chamados["nSituacao"] ?></td>
                                                <td><?= $dados_chamados["nTelefone"] ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr class="white-space-no-wrap">
                                            <td colspan="5">Nenhuma ligação 190 encontrada.</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Fichas Criminais</h4>
                                <p class="mb-2">Veja as ultimas fichas criminais adicionadas</p>
                            </div>
                        </div>
                        <div class="card card-block card-stretch custom-scroll">
                            <div class="table-responsive rounded">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                    <th>Data e Horário</th>
                                    <th>Cidadão</th>
                                    <th>Artigo</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include $_SERVER["DOCUMENT_ROOT"] . "/system/config/mysql/connecdb.php";
                                    $query_ficha = mysqli_query($con, "SELECT * FROM crimes ORDER BY CriID DESC LIMIT 50");
                                    if (mysqli_num_rows($query_ficha) > 0) {
                                        while ($dados_ficha = mysqli_fetch_assoc($query_ficha)) {
                                            ?>
                                            <tr class="white-space-no-wrap">
                                                <td><?= $dados_ficha["CriData"] ?></td>
                                                <td><?= $dados_ficha["CriOwnN"] ?></td>
                                                <td><?= $dados_ficha["CriCrime"] ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr class="white-space-no-wrap">
                                            <td colspan="5">Nenhuma ficha criminal localizada.</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/dashboard/footer.php" ?>
</main>

<!-- Wrapper End-->
<!-- offcanvas start -->

<!-- Backend Bundle JavaScript -->
<script src="../assets/js/libs.min.js"></script>
<!-- widgetchart JavaScript -->
<script src="../assets/js/charts/widgetcharts.js"></script>
<!-- dashboard JavaScript -->
<script src="../assets/js/charts/dashboard.js"></script>

<!-- fslightbox JavaScript -->
<script src="../assets/js/fslightbox.js"></script>
<!-- app JavaScript -->
<script src="../assets/js/app.js"></script>
<!-- apexchart JavaScript -->
<script src="../assets/js/charts/apexcharts.js"></script>
<!-- countdown JavaScript -->
<script src="../assets/js/countdown.js"></script>
</body>
</html>