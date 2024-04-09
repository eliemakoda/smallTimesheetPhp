<?php
session_start();
require "./config/app.php";
$apps= new App;
if (isset($_POST['enregistrer'])) {
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $datenaiss = $_POST['datenaiss'];
    $bio = $_POST['bio'];
    $experience = $_POST['experience'];
    $competences = $_POST["competences"];
    $password = $_POST["password"];

    $sql = "INSERT INTO utilisateur(nomUSer, emailUSer, DateNaissUSer, BioUSer, ExperienceUSer, CompetenceUSer, passwordUSer, statutUSer, ImageUSer) VALUES(:nomUSer, :emailUSer, :DateNaissUSer, :BioUSer, :ExperienceUSer, :CompetenceUSer, :passwordUSer, :statutUSer, :ImageUSer)";

    $dest = "./index.php";
    $uploadDirectory = "./assets/images/";
    if (!empty($_FILES["images"]["name"][0])) {
        foreach ($_FILES["images"]["name"] as $key => $imageName) {
            $imageTmpName = $_FILES["images"]["tmp_name"][$key];
            $urlsImages[] = $imageName;
            $imagePath = $uploadDirectory . $imageName;
            move_uploaded_file($imageTmpName, $imagePath);
        }
        $tab = [
            // :nomUSer, :emailUSer, :DateNaissUSer, :BioUSer, 
            // :ExperienceUSer, :CompetenceUSer, :passwordUSer,
            //  :statutUSer, :ImageUSer
            ":nomUSer" => $nom,
            ":emailUSer" => $email,
            ":DateNaissUSer" => $datenaiss,
            ":BioUSer" => $bio,
            ":ExperienceUSer" => $experience,
            ":CompetenceUSer" => $competences,
            ":passwordUSer" => $password,
            ":statutUSer"=>1,
            ":ImageUSer" => implode(",", $urlsImages)
        ];
        $apps->inserer($sql,$tab,$dest);
    }
}
// require './config/adminHeader.php';
?>
    <!-- <div class="bg-overlay" style="background-image: url(./assets/bg-1.jpg);"></div> -->
                           

    <!-- <body data-layout="horizontal"> -->
    <!doctype html>
<html lang="en">

    
<!-- Mirrored from themesdesign.in/dason-django/layouts/default/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Apr 2024 07:27:45 GMT -->
<head>

        <meta charset="utf-8" />
        <title>MyTimeSheet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="./assets/images/favicon.ico">

        <!-- preloader css -->
        <link rel="stylesheet" href="./assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="./assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="./assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="./assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="dark" style="background-image: url('./assets/images/bg-3.jpg'); z-index: -1;">
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
             
              
                <div class="col-xxl-3 col-lg-4 col-md-5 shaddow-5"  style="width: 50%; margin:5% auto; opacity:0.9;">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 w-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="./AddUser.php" class="d-block auth-logo">
                                        <img src="./assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">MyTimeSheet</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0"></h5>
                                        <p class="text-muted mt-2">Creez votre compte Maintenant!</p>
                                    </div>

                                    <form class="needs-validation mt-4 pt-2" action="./AddUser.php" method="POST" enctype="multipart/form-data">

                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="email" class="form-control" id="input-email" placeholder="Entrez votre Email" name="email" required>
                                            <div class="invalid-feedback">
                                                Email
                                            </div>
                                            <label for="input-email">Email</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="mail"></i>
                                            </div>
                                        </div>
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="text" class="form-control" id="input-name" placeholder="Entrez votre Nom" name="nom" required>
                                            <div class="invalid-feedback">
                                                Nom
                                            </div>
                                            <label for="input-name">Nom</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>


                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="date" class="form-control" id="input-date" placeholder="Entrez votre date de naissance" name="datenaiss" required>
                                            <div class="invalid-feedback">
                                                Date de Naissance
                                            </div>
                                            <label for="input-date">Date de Naissance</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="calendar"></i>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea id="editor" name="bio" ></textarea>
                                            </div>
                                        </div>
                                       <br><br><br>
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="text" class="form-control" id="input-exp" placeholder="Entrez votre Experience" name="experience" required>
                                            <div class="invalid-feedback">
                                                Experiences Professionnelles
                                            </div>
                                            <label for="input-exp"> Experiences Professionnelles</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="user-plus"></i>
                                            </div>
                                        </div>
                                      
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="text" class="form-control" id="input-comp" placeholder="Entrez votre Experience" name="competences" required>
                                            <div class="invalid-feedback">
                                                Competences Professionnelles
                                            </div>
                                            <label for="input-comp"> Competences Professionnelles</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="user-check"></i>
                                            </div>
                                        </div>

                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="password" class="form-control" id="input-password" placeholder="Entrez votre pass" name="password" required>
                                            <div class="invalid-feedback">
                                                Mot de passe Admin
                                            </div>
                                            <label for="input-password"> Mot de passe</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="file" class="form-control" id="input-file" placeholder="" name="images[]" required>
                                            <div class="invalid-feedback">
                                                Images
                                            </div>
                                            <label for="input-password"> Images</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="image"></i>
                                            </div>
                                        </div>

                                   

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" name="enregistrer">Creer</button>
                                        </div>
                                    </form>
                                    <p style="text-align: center ; font-size: 14px;">Déjà un  compte? cliquez <a href="./index.php" style="text-align: center ; font-size: 14px; color:blue">ici</a></p>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
</div>

    <!-- JAVASCRIPT -->
    <script src="./assets/libs/jquery/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="./assets/libs/simplebar/simplebar.min.js"></script>
    <script src="./assets/libs/node-waves/waves.min.js"></script>
    <script src="./assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="./assets/libs/pace-js/pace.min.js"></script>

    <!-- validation init -->
    <script src="./assets/js/pages/validation.init.js"></script>

    <script src="./assets/js/pages/feather-icon.init.js"></script>
    <script src="./assets/js/feather.min.js"></script>

<script src="./assets/js/ckeditor.js"></script>
<script src="./assets/js/ckeditor.js"></script>
<script src="./assets/js/ckeditor.js"></script>
<script src="./assets/js/ckeditor.js" defer></script>


<script src="./assets/js/script.js"></script>
</body>


<!-- Mirrored from themesdesign.in/dason-django/layouts/default/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Apr 2024 07:27:46 GMT -->

</html>