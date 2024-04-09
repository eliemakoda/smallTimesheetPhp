<?php
session_start();
require "../../config/app.php";
$apps = new App;
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO projet( nomProjet, descriptionProjet, dateDebutProjet, dateFinProjet, statutProjet, PrixProjet, idUser, idAdmin) VALUES(:nomProjet, :descriptionProjet, :dateDebutProjet, :dateFinProjet, :statutProjet, :PrixProjet, :idUser, :idAdmin)";
    $budget = $_POST["taskbudget"];
    $debut = $_POST["start"];
    $fin = $_POST['end'];
    $description = $_POST['description'];
    $nom = $_POST['taskname'];
    $res = $apps->SelectionnerUn("SELECT * FROM utilisateur WHERE idUSer= (SELECT MAX(idUSer) FROM utilisateur) ");
    $id_user = (isset($res) && $res != null) ? $res->idUSer : 1;
    $statut = 0;
    $id_admin = isset($_SESSION["idAdmin"]) ? $_SESSION["idAdmin"] : 1;


    $tab = [
        ":nomProjet" => $nom,
        ":descriptionProjet" => $description,
        ":dateDebutProjet" => $debut,
        ":dateFinProjet" => $fin,
        ":statutProjet" => $statut,
        ":PrixProjet" => $budget,
        ":idUser" => $id_user,
        ":idAdmin" => $id_admin
    ];
    $dest="./AjoutTache.php";
    $apps->inserer($sql,$tab,$dest);
}
require "../../config/adminHeader.php";
?>
<!-- INSERT INTO `projet`(`idProjet`, `nomProjet`, `descriptionProjet`, `dateDebutProjet`, 
`dateFinProjet`, `statutProjet`, `PrixProjet`, `idUser`, 
`idAdmin`, `DateAjoutProjet`) VALUES ( -->
<!-- 
statut des taches:
0: tache non prise
1: tache prise mais pas terminée
2: tache terminée -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Creer Tache </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tâches</a></li>
                                <li class="breadcrumb-item active">Creer Tache </li>
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
                            <h4 class="card-title mb-4">Creer une Nouvelle tache</h4>
                            <form  method="POST" action="./AjoutTache.php">
                                <div data-repeater-list="outer-group" class="outer">
                                    <div data-repeater-item class="outer">
                                        <div class="form-group row mb-4">
                                            <label for="taskname" class="col-form-label col-lg-2">Nom de la Tâche</label>
                                            <div class="col-lg-10">
                                                <input id="taskname" name="taskname" type="text" class="form-control" placeholder="Nom de la Tâche...">
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>description De La tache</label>
                                                <textarea id="editor" name="description"></textarea>
                                            </div>
                                        </div>
                                        <br><br><br>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label col-lg-2"> Date</label>
                                            <div class="col-lg-10">
                                                <div class="input-daterange input-group" data-provide="datepicker">
                                                    <input type="date" class="form-control" placeholder=" Date Debut " name="start" />
                                                    <input type="date" class="form-control" placeholder=" Date fin" name="end" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="taskbudget" class="col-form-label col-lg-2">Budget</label>
                                            <div class="col-lg-10">
                                                <input id="taskbudget" name="taskbudget" type="text" placeholder="Enter Task Budget..." class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Creer La Tâche</button>
                                </div>
                            </div>
                            </form>


                        </div>
                    </div>
                </div>
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
                    </script> © Frede.
                </div>

            </div>
        </div>
    </footer>
</div>
<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/libs/metismenu/metisMenu.min.js"></script>
<script src="../../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../../assets/libs/node-waves/waves.min.js"></script>
<script src="../../assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="../../assets/libs/pace-js/pace.min.js"></script>

<!-- validation init -->
<script src="../../assets/js/pages/validation.init.js"></script>

<script src="../../assets/js/pages/feather-icon.init.js"></script>
<script src="../../assets/js/feather.min.js"></script>

<script src="../../assets/js/ckeditor.js"></script>
<script src="../../assets/js/ckeditor.js"></script>
<script src="../../assets/js/ckeditor.js"></script>
<script src="../../assets/js/ckeditor.js" defer></script>


<script src="../../assets/js/script.js"></script>

<?php
require "../../config/AdminFooter.php";
?>