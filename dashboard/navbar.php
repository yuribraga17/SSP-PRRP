<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/system/classes/Usuario.php";
$Usuario = new Usuario();
$Usuario->ConsultarUsuario($_SESSION["usuario_id"]);
?>

<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="index.php" class="navbar-brand">
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                </svg>
            </i>
        </div>
        <div class="header-logo d-xl-none">
            <a href="index.php" class="navbar-brand dis-none">
                <img src="../assets/images/ssp.png" alt="Logo SSP" style="width: 35px;">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="navbar-toggler-bar bar1 mt-2"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto navbar-list mb-2 mb-lg-0 align-items-center">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                        <svg width="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z"
                                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M14.3889 20.8572C13.0247 22.3719 10.8967 22.3899 9.51953 20.8572"
                                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                        </svg>
                        <span class="bg-danger dots"></span>
                    </a>
                    <div class="sub-drop dropdown-menu iq-noti dropdown-menu-end p-0"
                         aria-labelledby="notification-drop">
                        <div class="card bg-transparent shadow-none m-0">
                            <div class="card-header bg-transparent d-flex justify-content-between">
                                <div class="header-title">
                                    <p class="fs-6 ">Notificações</p>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <a class="iq-sub-card">
                                    <div class="d-flex justify-content-center">
                                        Nenhuma notificação encontrada
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/avatars/01.png" alt="User-Profile"
                             class="img-fluid avatar avatar-50 avatar-rounded">
                        <div class="caption ms-3 ">
                            <h6 class="mb-0 caption-title"><?= $Usuario->get("nome_personagem") ?> <?= $Usuario->get("sobrenome_personagem") ?></h6>
                            <p class="mb-0 caption-sub-title"><?= $Usuario->get("faccao_cargo") ?></p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="border-0"><a class="dropdown-item" >Perfil</a>
                        </li>
                        <li class="border-0">
                            <hr class="m-0 dropdown-divider">
                        </li>
                        <li class="border-0"><a class="dropdown-item" href="../dashboard/auth/sign-in?logout=1">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>