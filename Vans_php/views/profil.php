<?php
session_start();
if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit(); 
}

ob_start(); 

$id = $_SESSION['id'];
require __DIR__."/../dataBase.php";
$query = $dbh->prepare("SELECT * FROM `user` WHERE id_user=$id");
$query->execute();
$results = $query->fetchAll();
foreach ($results as $result) { ?>
    <section class="profilContainer">
    <form class="form-floating profilForm" action="profil.php" method="post" name="profil">
        <h1 class="box-title profilTitle">Profil</h1>
        <div class="form-floating mb-3">
            <input type="text" class="form-control transparent-input profilInput" name="lastname" value="<?php echo $result['lastname']?>" maxlength="25" required>
            <label>Nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="tex" class="form-control transparent-input profilInput" name="firstname" value="<?php echo $result['firstname']?>" maxlength="25" required>
            <label>Prenom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control transparent-input profilInput" name="email" value="<?php echo $result['email']?>" required>
            <label>Adresse email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control transparent-input profilInput" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{12,}" required>
            <label>Mot de passe (nouveau si vous voulez changer ou actuel pour confirmer)</label>
            <p class="textPassword">*Au moins 12 caractères, un chiffre, une lettre majuscule, une minuscule et un caractère parmi !@#$%^&*_=+.</p>
        </div>
        <div class="form-group">
            <input type="submit" value="Modifier" name="submit" class="btn btn-profil btn-warning" w-50>
        </div>
    </form>
</section>
<?php }
require __DIR__."/../classes/profil.class.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateUser = new Profil ($_POST["lastname"], $_POST["firstname"], $_POST["email"], password_hash($_POST["password"],PASSWORD_DEFAULT));
    $updateUser->update();
} ?>

<?php
$content = ob_get_clean();
require_once("navigation.php");