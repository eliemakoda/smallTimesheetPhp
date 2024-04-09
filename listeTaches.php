<?php
session_start();

if (((!isset($_SESSION['idUSer'])) || $_SESSION['idUSer'] == null)) {
    header("location: ./index.php");
    exit;
}
require "./config/app.php";
$apps = new App;
if(isset($_GET['id_termine'])){
    $id=$_GET['id_termine'];
    $metadata= $apps->SelectionnerUn("SELECT * FROM projet WHERE idProjet=$id");
    $sql2=$apps->maj2("UPDATE projet SET statutProjet=2 where idProjet=$id");
    $user=$apps->SelectionnerUn("SELECT * FROM utilisateur WHERE idUSer=$metadata->idUser");
    $solde = $user->GainsUser + $metadata->PrixProjet;
    $nbPjet= $user->NombreProjetUSer + 1;
    $sql2= $apps->maj2("UPDATE utilisateur SET GainsUser=$solde, NombreProjetUSer=$nbPjet WHERE idUSer=$metadata->idUser");
    $updatedAdmin= $apps->SelectionnerUn("SELECT * FROM administrateur WHERE idAdmin= $metadata->idAdmin");
    $nbPjetAdmin= $updatedAdmin->NombreProjetAdmin+1;
    $sql3= $apps->maj2("UPDATE administrateur SET NombreProjetAdmin= $nbPjet WHERE  idAdmin=$metadata->idAdmin ");

}
if(isset($_GET['idProjet']))
{
    $idprojet= $_GET['idProjet'];
    $statut=0;
    $idclient= isset($_SESSION['idUSer'])?$_SESSION['idUSer']:1;
    $sql="INSERT INTO approbation(statutApprobation, IdClientApprob, IdProjetApprobation) VALUES(:statutApprobation, :IdClientApprob, :IdProjetApprobation)";
    $tab=[
        ":statutApprobation"=>$statut,
         ":IdClientApprob"=>$idclient,
          ":IdProjetApprobation"=>$idprojet
    ];
    $dest="./listeTaches.php";
    $apps->inserer($sql,$tab,$dest);
    // INSERT INTO `approbation`(idApprobation, statutApprobation, IdClientApprob, IdProjetApprobation) VALUES (
}
$id = isset($_SESSION['idUSer']) ? $_SESSION['idUSer'] : 1;
$libre = $apps->SelectionnerTout("SELECT * FROM projet  left join administrateur on administrateur.idAdmin=projet.idAdmin WHERE projet.statutProjet=0 AND projet.idUser=$id");
$encours = $apps->SelectionnerTout("SELECT * FROM projet left join administrateur on administrateur.idAdmin=projet.idAdmin  WHERE projet.statutProjet=1 AND projet.idUser=$id");
$terminer = $apps->SelectionnerTout("SELECT * FROM projet left join administrateur on administrateur.idAdmin=projet.idAdmin  WHERE projet.statutProjet=2 AND projet.idUser=$id");
$recent = $apps->SelectionnerTout("SELECT * FROM projet  left join administrateur on administrateur.idAdmin=projet.idAdmin  WHERE 1 ORDER BY idProjet DESC LIMIT 3 ");
$attentes=$apps->SelectionnerTout("SELECT * from approbation left join projet on approbation.IdProjetApprobation= projet.idProjet left join utilisateur on approbation.IdClientApprob = utilisateur.idUSer where approbation.statutApprobation=0 and approbation.IdClientApprob=$id");
require "./config/userHeader.php";
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Liste de Vos  Taches</h4>

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
                            <h4 class="card-title mb-4">Libre</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <?php
                                        if (isset($libre) && $libre != null) :
                                            foreach ($libre as $disp) : //tache disponibles 
                                                $img = explode(',', $disp->ImageAdmin);
                                                $id = isset($_SESSION['idUSer']) ? $_SESSION['idUSer'] : 1;
                                                $result= $apps->SelectionnerTout("SELECT * FROM approbation WHERE IdClientApprob=$id AND IdProjetApprobation=$disp->idProjet");
                                                if(!isset($result)|| $result==null):

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
                                                                <a href="./profilAdmin.php?id=<?php echo $disp->idAdmin;?>" class="d-inline-block">
                                                                    <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                            <p class="ml-4 text-muted mb-0">
                                                                <i class="mdi mdi-user"></i> <a class="btn btn-danger" href="./listeTaches.php?idProjet=<?php echo $disp->idProjet?>">Postuler</a>
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
                                        endif;
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
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">En cours</h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            <?php
                                            if (isset($encours) && $encours != null) :
                                                foreach ($encours as $disp) : //tache disponibles 
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
                                                                    <a href="./profilAdmin.php?id=<?php echo $disp->idAdmin;?>" class="d-inline-block">
                                                                        <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td>
                                                    <a href="./listeTaches.php?id_termine=<?php echo $disp->idProjet ?>" class=" btn btn-danger">Terminé</a>
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
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Terminée</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <?php
                                        if (isset($terminer) && $terminer != null) :
                                            foreach ($terminer as $disp) : //tache disponibles 
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
                                                        <p class="ml-4 text-muted mb-0">
                                                            <i class="mdi mdi-user"></i> 1
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="./profilAdmin.php?id=<?php echo $disp->idAdmin;?>" class="d-inline-block">
                                                                    <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>

                                                        </div>
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
                    <!-- </tr> --> 
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">En attente</h4>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <tbody>
                                            <?php
                                            if (isset($attentes) && $attentes != null) :
                                                foreach ($attentes as $disp) : //tache disponibles 
                                                    $img = explode(',', $disp->ImageUSer);

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
                                                                    <a href="./profilAdmin.php?id=<?php echo $disp->idAdmin;?>" class="d-inline-block">
                                                                        <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                    </a>
                                                                </div>

                                                            </div>
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
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Week Tasks</h4>

                            <div id="task-chart" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recente Taches
                            </h4>

                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <?php
                                        if (isset($recent) && $recent != null) :
                                            foreach ($recent as $disp) : //tache disponibles 
                                                $img = explode(',', $disp->ImageAdmin);

                                        ?>
                                                <tr>

                                                    <td>
                                                        <h5 class="text-truncate font-size-14 m-0"><a href="" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" class="text-dark"><?php echo $disp->nomProjet ?></a></h5>
                                                    </td>

                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="../profile/profileAdmin.php?id=<?php echo $disp->idAdmin; ?>" class="d-inline-block">
                                                                    <img src="./assets/images/<?php echo $img[array_rand($img)] ?>" alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </td>
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
                            <!-- end table responsive -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



</div>

<?php
require "./config/userFooter.php";
?>