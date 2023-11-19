<?php ob_start(); ?>

<?php
require __DIR__."/../connexion/form_register.php";

require __DIR__."/../classes/register.class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myUser = new Register ($_POST["lastname"], $_POST["firstname"], $_POST["email"], password_hash($_POST["password"],PASSWORD_DEFAULT));
    $myUser->save();
} ?>

<?php
$content = ob_get_clean();
require_once("navigation.php");