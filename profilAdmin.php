<?php
session_start();

require './config/app.php';
$apps = new App;
$id = $_GET['id'];
$user = $apps->SelectionnerUn("SELECT * FROM administrateur WHERE idAdmin =$id");
$projetUSer=$apps->SelectionnerTout("SELECT * FROM projet WHERE idAdmin=$id");
$commentaire=$apps->SelectionnerTout("SELECT * from commentaires left join projet on commentaires.idProjet= projet.idProjet left join utilisateur on commentaires.idUSer= utilisateur.idUSer WHERE commentaires.idUSer=$id");

if (((!isset($_SESSION['idUSer'])) || $_SESSION['idUSer'] == null)) {
    header("location: ./index.php");
    exit;
}
require "./config/userHeader.Php";
if (isset($user) && $user != null) :
    $img = explode(',', $user->ImageAdmin);

?>

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="profile-user"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="profile-content">
                        <div class="row align-items-end">
                            <div class="col-sm">
                                <div class="d-flex align-items-end mt-3 mt-sm-0">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xxl me-3">
                                            <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="img-fluid rounded-circle d-block img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="font-size-16 mb-1"><?php echo $user->nomAdmin;?></h5>
                                            <p class="text-muted font-size-13 mb-2 pb-2">Date de Naissance: <b><?php echo $user->DateNaissAdmin;?></b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex align-items-start justify-content-end gap-2 mb-2">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-transparent shadow-none">
                            <div class="card-body">
                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-2" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-bs-toggle="tab" href="#post" role="tab">Commentaire  Projets</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="tab-content">
                            <div class="tab-pane active" id="overview" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">A propos</h5>
                                    </div>

                                    <div class="card-body">
                                        <div>
                                            <div class="pb-3">
                                                <h5 class="font-size-15">Bio :</h5>
                                                <div class="text-muted">
                                               <?php
                                               echo htmlspecialchars_decode($user->BioAdmin);
                                               ?>
                                                </div>
                                            </div>

                                            <div class="pt-3">
                                                <h5 class="font-size-15">Competences :</h5>
                                                <div class="text-muted">
                                                    <p>J'ai plusieurs compétences dans plusieurs domaines. ci joint quelques Uns!</p>

                                                    <ul class="list-unstyled mb-0">
                                                        <?php
                                                        $data=  explode("#",$user->CompetenceAdmin);
                                                        foreach($data as $competence):
                                                        ?>
                                                        <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i><?php
                                                        echo $competence;
                                                        ?></li>
                                                       <?php
                                                       endforeach;
    
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="post" role="tabpanel">
                                <div class="card">
                                  
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                                <div class="card">
                                    <div class="card-body">
                                        <!-- debut -->
                                        <?php
                                        if(isset($commentaire)&& $commentaire!=null):
                                            foreach($commentaire as $cmt):
                                                $img = explode(',', $cmt->ImageAdmin);

                                        ?>
                                        <div class="blog-post">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-lg me-3">
                                                    <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="img-fluid rounded-circle d-block">
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="font-size-15 text-truncate"><a href="" class="text-dark"><?php echo $cmt->nomAdmin;?></a></h5>
                                                    <p class="font-size-13 text-muted mb-0"><?php echo $cmt->DateCommentaire;?></p>
                                                </div>
                                            </div>
                                            <div class="pt-3">
                                        
                                                <p class="text-muted">
                                                <?php echo $cmt->contenuCommentaire;?>

                                                </p>

                                            </div>
                                           
                                            <div class="pt-3">
                                                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                                   

                                                    <div>
                                                    
                                                    
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>

                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                        <!-- end blog post -->
                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4 col-lg-4">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Projets </h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <tbody>
                                            <?php
                                            if(isset($projetUSer)&& $projetUSer!=null):
                                                foreach($projetUSer as $mesproject):
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark"><?php
                                                    echo $mesproject->nomProjet;
                                                    ?></a></h5>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11"><?php
                                                        echo $mesproject->statutProjet==0?"en cours...":"terminé!";                                                        ?></a>
                                                        ?>  
                                                        <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11"><?php
                                                    echo $mesproject->PrixProjet;
                                                    echo " ";
                                                    echo " FCFA";
                                                    ?></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> <?php
                                                    echo $mesproject->dateDebutProjet;
                                                    ?>
                                                </td>
                                            </tr>
                                           <?php
                                           endforeach;
                                        endif;
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Experience</h5>
                            </div>
                            <div class="card-body">
                                <div id="overview-chart" data-colors='["#1c84ee"]' class="apex-charts" dir="ltr">
                                    <p><?php
                                    echo $user->ExperienceAdmin;
                                    ?></p>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Competences</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 font-size-16">
                                    <?php
                                    $data = explode("#",$user->CompetenceAdmin);
                                    foreach($data as $comp):
                                    ?>
                                    <a href="#" class="badge badge-soft-primary"><?php echo $comp;?></a>
                                 <?php
                                 endforeach;
                                 ?>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

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
    <!-- end main content-->

    </div>

<?php
endif;
require './config/userFooter.php'
?>