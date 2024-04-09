<?php
session_start();
require "../../config/app.php";
$apps= new App;
if(isset($_GET['id_sup'])){
    $id=$_GET['id_sup'];
    $sql="UPDATE utilisateur SET statutUSer=0 WHERE idUSer=$id";
    $apps->maj2($sql);
}
$results=$apps->SelectionnerTout("SELECT * FROM utilisateur WHERE 1 ");
$i=sizeof($results);

require "../../config/AdminHeader.php";

?>
    <!-- ============================================================== -->
    <div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Grille utilisateurs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                            <li class="breadcrumb-item active">Liste Contacts</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Liste Contact  <span class="text-muted fw-normal ms-2">(<?php echo $i;?>)</span></h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="./listUser.php" data-bs-toggle="tooltip" data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="./listGrid.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid"><i class="bx bx-grid-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                  
                 
                </div>

            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <?php
            if(isset($results)&& $results!=null):
                $i=0;
                foreach($results as $user):
                    $img = explode(',', $user->ImageUSer);

            ?>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="../profile/profile.php?id=<?php echo $user->idUSer;?>">profile</a>
                                <a class="dropdown-item" href="./listGrid.php?id_sup=<?php echo $user->idUSer;?>">Supprimer</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="../../assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="avatar-lg rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-15 mb-1"><a href="../profile/profile.php?id=<?php echo $user->idUSer;?>" class="text-dark"><?php echo $user->nomUSer;?></a></h5>
                                <p class="text-muted mb-0"> <?php
                                echo $user->CompetenceUSer;
                                ?></p>
                            </div>
                        </div>
                        <div class="mt-3 pt-1">
                            <p class="text-muted mb-0"><i class="mdi mdi-cash font-size-15 align-middle pe-2 text-primary"></i>
                                  <?php
                                echo $user->GainsUser;
                                ?> FCFA</p>
                            <p class="text-muted mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                              <?php
                                echo $user->emailUSer;
                                ?></p>
                            <p class="text-muted mb-0 mt-2"><i class="mdi mdi-calendar font-size-15 align-middle pe-2 text-primary"></i>
                            <?php
                                echo $user->DateNaissUSer;
                                ?></p>
                        </div>
                    </div>

                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-outline-light text-truncate" href="../profile/profile.php?id=<?php echo $user->idUSer;?>"><i class="uil uil-user me-1"></i> Profil</a>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <?php
            endforeach;
        endif;
            ?>
           
            
        </div>
        <!-- end row -->

        <div class="row g-0 align-items-center mb-4">
            <div class="col-sm-6">
                <div>
                </div>
            </div>
          
        </div>
        <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


</div>
<!-- end main content-->


<?php
require "../../config/AdminFooter.php";
?>