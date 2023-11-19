<?php ob_start();
session_start(); ?>


<?php
require __DIR__ . "/form_product.php";

require __DIR__ . "/../classes/products.class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myProduct = new Product(
        $_POST["title"],
        $_POST["mark"],
        $_POST["model"],
        $_POST["power"],
        $_POST["year"],
        $_POST["description"],
        $_POST["starting_price"],
        $_POST["end_date"],
    );
    $myProduct->save();
}
?>


<?php
$content = ob_get_clean();
require_once("navigation.php");
