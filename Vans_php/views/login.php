<?php ob_start(); ?>

<?php
require __DIR__."/../connexion/form_login.php";

require __DIR__."/../classes/login.class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logUser = new Login ($_POST["email"], $_POST["password"]);
    $logUser->verification();
}
?>

<?php
$content = ob_get_clean();
require_once("navigation.php");
