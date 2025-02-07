<?php
if (((!isset($_SESSION['ImageAdmin'])) || $_SESSION['ImageAdmin'] == null)) {
    header("location: ../index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/dason-django/layouts/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Apr 2024 07:24:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>MyTimesheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="../../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="../../assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index-2.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="../../assets/images/logo-sm.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="../../assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">MyTimesheet</span>
                            </span>
                        </a>

                        <a href="index-2.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="../../assets/images/logo-sm.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="../../assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">MyTimesheet</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>
                    <?php
                    $img = explode(',', $_SESSION['ImageAdmin']);

                    ?>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="../../assets/images/<?php echo $img[array_rand($img)] ?>" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $_SESSION['nomAdmin'] ?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="../profile/profileAdmin.php?id=<?php echo $_SESSION['idAdmin'] ?>"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                            <!-- <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Deconnexion</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">


                        <li class="menu-title" data-key="t-apps">Administrateurs</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fa fa-user"></i>
                                <span data-key="t-ecommerce">Administrateurs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="../admins/AjoutAdmin.php" key="t-products">Ajouter</a></li>
                                <li><a href="../admins/listAdmin.php" data-key="t-product-detail">Liste</a></li>

                            </ul>
                        </li>

                        <li class="menu-title" data-key="t-apps">utilisateurs Clients</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fa fa-user"></i>
                                <span data-key="t-ecommerce">utilisateurs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="../admins/AjoutAdmin.php" key="t-products">Ajouter</a></li> -->
                                <li><a href="../users/listGrid.php" data-key="t-product-detail">Liste utilisateurs</a></li>

                            </ul>
                        </li>

                        <li class="menu-title" data-key="t-apps">Taches</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fa fa-tasks"></i>
                                <span data-key="t-ecommerce">Taches</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="../admins/AjoutAdmin.php" key="t-products">Ajouter</a></li> -->
                                <li><a href="../task/listeTache.php" data-key="t-product-detail">Liste Taches</a></li>
                                <li><a href="../task/AjoutTache.php" data-key="t-product-detail">Ajouter Taches</a></li>

                            </ul>
                        </li>

                        <li class="menu-title" data-key="t-apps">Approbation</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fa fa-check"></i>
                                <span data-key="t-ecommerce">Demandes D'approbation</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <!-- <li><a href="../admins/AjoutAdmin.php" key="t-products">Ajouter</a></li> -->
                                <li><a href="../approbation/listeApp.php" data-key="t-product-detail">Liste Demandes</a></li>

                            </ul>
                        </li>

                    </ul>


                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->