<?php
session_start();
require "../../config/app.php";
$apps = new App;
if(isset($_GET['id_sup'])){
    $id=$_GET['id_sup'];
    $sql="UPDATE utilisateur SET statutUSer=0 WHERE idUSer=$id";
    $apps->maj2($sql);
}
$results = $apps->SelectionnerTout("SELECT * FROM administrateur WHERE 1 ");
$i = sizeof($results);
require '../../config/adminHeader.php'
?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"> Liste utilisateurs</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">utilisateurs</a></li>
                                <li class="breadcrumb-item active">Liste utilisateur</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title"> Nombre utilisateurs  <span class="text-muted fw-normal ms-2">(<?php echo $i; ?>)</span></h5>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                        <div>
                                            <ul class="nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="./listAdmin.php" data-bs-toggle="tooltip" data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="./listGrid.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid"><i class="bx bx-grid-alt"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check font-size-16">
                                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th scope="col">Nom </th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nombre de Projets</th>
                                            <th scope="col">Competences</th>
                                            <th style="width: 80px; min-width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($results) && $results != null) :
                                            $i = 0;
                                            foreach ($results as $user) :
                                                $img = explode(',', $user->ImageAdmin);

                                        ?>
                                                <tr>
                                                    <th scope="row">

                                                    </th>
                                                    <td>
                                                        <img src="../../assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="avatar-sm rounded-circle me-2">
                                                        <a href="../profile/profileAdmin.php?id=<?php echo $user->idAdmin; ?>" class="text-body"><?php echo $user->nomAdmin; ?></a>
                                                    </td>
                                                    <td> <?php
                                                            echo $user->emailAdmin;
                                                            ?></td>
                                                    <td> <?php
                                                            echo $user->NombreProjetAdmin;
                                                            ?> FCFA</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="#" class="badge badge-soft-primary"><?php
                                                        echo $user->CompetenceAdmin;
                                                                                                            ?></a>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="../profile/profileAdmin.php?id=<?php echo $user->idAdmin;?>">Profile</a></li>
                                                                <li><a class="dropdown-item" href="./listAdmin.php?id_sup=<?php echo $user->idAdmin;?>">Supprimer</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                     
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                            <!-- end table responsive -->
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Dason.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by <a href="#!" class="text-decoration-underline">Themesdesign</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>





<?php
require '../../config/adminFooter.php'
?>