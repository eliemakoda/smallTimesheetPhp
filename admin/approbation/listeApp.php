<?php
session_start();
require "../../config/app.php";
$apps = new App;
if(isset($_GET['id_aprov'])){
    $id=$_GET['id_aprov'];
    $idAdmin= isset($_SESSION['idAdmin'])?$_SESSION['idAdmin']:1;
    $result= $apps->SelectionnerUn("SELECT * FROM approbation where idApprobation=$id");
    $sql1=$apps->maj2("UPDATE approbation SET statutApprobation=1, IdAdminApprobation= $idAdmin WHERE idApprobation=$id");
    $sql2=$apps->maj2("UPDATE projet SET statutProjet=1,idUser=$result->IdClientApprob where idProjet=$result->IdProjetApprobation");

}
$libre = $apps->SelectionnerTout("SELECT * FROM approbation left join projet on approbation.IdProjetApprobation = projet.idProjet  left join administrateur on administrateur.idAdmin=projet.idAdmin WHERE approbation.statutApprobation=0");
require "../../config/AdminHeader.php";
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Liste des Taches</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Taches</a></li>
                                <li class="breadcrumb-item active"> Liste Tache</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Demandes d'Approbation</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <?php
                                        if (isset($libre) && $libre != null) :
                                            foreach ($libre as $disp) : //tache disponibles 
                                                $img = explode(',', $disp->ImageAdmin);

                                        ?>
                                                <tr>

                                                    <td>
                                                        <h5 class="text-truncate font-size-14 m-0"><a href="" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" class="text-dark"><?php echo $disp->nomProjet ?></a></h5>
                                                    </td>
                                                    <td>
                                                        <p class="ml-4 text-muted mb-0">
                                                            <i class="mdi mdi-cash align-middle text-muted font-size-16 me-1"></i> <?php echo $disp->PrixProjet ?>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="ml-4 text-muted mb-0"><?php echo $disp->dateFinProjet ?></p>
                                                    </td>


                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="../../assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </td>

                                                    <td>
                                                        <p class="ml-4 text-muted mb-0">
                                                        <a class="btn btn-danger" href="./listeApp.php?id_aprov=<?php echo $disp->idApprobation?>" name="approve">Approuver</a>
                                                        </p>
                                                    </td>
                                                    <div>
                                                        <!--  Large modal example -->
                                                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myLargeModalLabel">Thème: <?php echo $disp->nomProjet ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="flex-column">
                                                                            <div class="flex flex-row">
                                                                                <div>
                                                                                    <p class="text-center">
                                                                                    <h2>Description</h2>
                                                                                    <?php echo htmlspecialchars_decode($disp->descriptionProjet) ?>

                                                                                    </p>
                                                                                </div>
                                                                                <div style="display: flex; flex-direction: row;">
                                                                                    <h3 style="text-align: center; text-transform: capitalize;"><i class="mdi mdi-calendar"></i></h3>
                                                                                    <p style="margin-left: 3%;"> <?php echo $disp->dateDebutProjet ?></p>
                                                                                </div>
                                                                                <div style="display: flex; flex-direction: row;">
                                                                                    <h3><i class="mdi mdi-calendar"></i> </h3>
                                                                                    <p style="margin-left: 3%;"> <?php echo $disp->dateFinProjet ?></p>
                                                                                </div>
                                                                                <div style="display: flex; flex-direction: row;">
                                                                                    <h3 style="text-align: justify; text-transform: capitalize;"><i class="mdi mdi-cash"></i></h3>
                                                                                    <p style="margin-left: 3%;"><?php echo $disp->PrixProjet ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                        </div>
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
                    <!-- <tr>
                        <th scope="row">
                            A Title with a Text Under
                        </th>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-title">Click me</button>
                        </td>
                    </tr> -->
                 
                    </div>

                </div>
                <!-- end col -->

              
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



</div>

<?php
require "../../config/AdminFooter.php";
?>