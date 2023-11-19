<?php ob_start();
session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit(); 
}

class Auction {
    private int $amount;

    public function __construct ($amount) {
        $this->amount = $amount;
    }

    public function __get ($property) {
        if ($property === "amount") {
            return $this->amount;
        } else {
            return $this->$property;
        }
    }



    public function endDateF(){
        require __DIR__ . "/../dataBase.php";
        $dateActuelle = date("Y-m-d");
    //recuperation date de fin
        $endDateRecup = $dbh->prepare("SELECT end_date FROM `product`  WHERE id_product='" . $_GET['id'] . "'");
        $endDateRecup->execute();
        $endDate = $endDateRecup->fetchColumn();
    
       //recuperation dernier encherisseur
       $lastUserRecup = $dbh->prepare("SELECT id_user FROM `auction`  WHERE id_product='" . $_GET['id'] . "'");
       $lastUserRecup->execute();
       $lastUser = $lastUserRecup->fetchColumn();
        
        var_dump($dateActuelle);

        if ($endDate <= $dateActuelle ) {
            
            echo "<div class='alert alert-danger' role='alert'>
                    L'enchère est terminée. Vous ne pouvez plus enchérir.<br/>
                    Felicitations à $lastUser qui a remporté l'enchère !
                  </div>";
         
        } else {
        $this->save();
        }
    }


    public function verification() {
        require __DIR__ . "/../dataBase.php";
       //recuperation du prix de base
        $startingPriceRecup = $dbh->prepare("SELECT starting_price FROM `product` WHERE id_product='" . $_GET['id'] . "'");
        $startingPriceRecup->execute();
        $startingPrice = $startingPriceRecup->fetchColumn();

        if ($this->amount < $startingPrice) {
            ?>
            <div class="alert alert-danger" role="alert">
                Vous ne pouvez pas enchérir en dessous du prix de départ.
            </div>
            <?php
            return;
        }
       //recuperation du dernier prix
        $lastPriceRecup = $dbh->prepare("SELECT new_auction FROM `auction` WHERE id_product='" . $_GET['id'] . "' ORDER BY date_auction DESC LIMIT 1");
        $lastPriceRecup->execute();
        $lastPrice = $lastPriceRecup->fetchColumn();

        if ($lastPrice !== false && $this->amount <= $lastPrice) {
            ?>
            <div class="alert alert-danger" role="alert">
                Vous devez miser un montant superieur à la mise précédente.
            </div>
            <?php
            return;
        }

        $this->endDateF();
    }


    public function save () {
        $id = $_SESSION['id'];
        require __DIR__."/../dataBase.php";

        //Mise a jour du dernier prix de l'enchere
        $majLastPrice = $dbh->prepare("UPDATE `product` SET last_price=:last_Price WHERE id_product='" . $_GET['id'] . "'");
        $majLastPrice->bindValue(':last_Price', $this->amount, PDO::PARAM_STR);
        $results = $majLastPrice->execute();

        //recuperation des donnees de l'utilisateurs
        $dbuser = $dbh->prepare("SELECT id_user, firstname FROM `user` WHERE id_user=$id");
        $dbuser->execute();
        $users = $dbuser->fetch();

        //recuperation des donnees du produits
        $dbproduct = $dbh->prepare("SELECT id_product FROM `product` WHERE id_product='".$_GET['id']."'");
        $dbproduct->execute();
        $products = $dbproduct->fetch();

        $query = $dbh->prepare("INSERT INTO `auction` (new_auction, date_auction, id_user, id_product) VALUES (:new_auction, NOW(), :id_user, :id_product)");
        $query->bindValue(':new_auction', $this->amount, PDO::PARAM_STR);
        $query->bindValue(':id_user', $users['id_user'], PDO::PARAM_STR);
        $query->bindValue(':id_product', $products['id_product'], PDO::PARAM_STR);
        $results = $query->execute();
            if($results){ ?>
                <div class="alert alert-success" role="alert">
                    Votre enchère a bien été prise en compte.
                </div>
        <?php }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myAuction = new Auction ($_POST["amount"]);
    $myAuction->verification();
}

// AFFICHAGE DES DETAILS DU PRODUIT
echo "<div class=\"enchereContainer\">";
    require __DIR__."/../dataBase.php";

    $query = $dbh->prepare("SELECT * FROM `product` WHERE id_product='".$_GET['id']."'");
    $query->execute();
    $results = $query->fetchAll();
    foreach($results as $result) { ?>
    <div class="detailProductAuction">
        <h1 class="auctionTitle">Titre: <?php echo $result['title']?></h1>
        <div class="detailImages">
            <img src="" class="firstImage" />
            <div class="placementImages">
                <img src="" class="secondaryImage" />
                <img src="" class="secondaryImage" />
            </div>
        </div>
        <div class="infoProductAuction">
            <div class="part1">
                <p>Marque: <?php echo $result['mark']?></p>
                <p>Annee: <?php echo $result['year']?></p>
            </div>
            <div class="Part2">
                <p>Modele: <?php echo $result['model']?></p>
                <p>Puissance: <?php echo $result['power']?></p>
            </div>
        </div>
        <p class="descriptionAuction">Description: <?php echo $result['description']?></p>
    </div>
    <div class="auctionPart">
        <p class="endDateAuction">Date de fin: <?php echo $result['end_date']?></p>
        <p class="startPriceAuction">Prix de depart: <?php echo $result['starting_price']?>€</p>
        <p class="lastPriceAuction">Dernier prix: <?php echo $result['last_price']?>€</p>
    <?php } ?>

    <!-- FORMULAIRE POUR ENCHERIR -->

    <form class='formAuction' action='' method='post'>
        <div class="form-floating">
            <input type="number" class="form-control transparent-input auctionInput" name="amount" placeholder="amount de l'enchere"  required>
            <label>Montant de l'enchère</label>
        </div>
        <input type="submit" value="Encherir" name="submit" class="btn btnAuction btn-warning">
    </form>


    <?php

    // AFFICHAGE DE L'HISTORIQUE

    $historyAuction = $dbh->prepare("SELECT a.new_auction, a.date_auction, u.firstname FROM `auction` a LEFT JOIN `user` u ON u.id_user=a.id_user LEFT JOIN `product` p ON p.id_product=a.id_product WHERE p.id_product='".$_GET['id']."'");
    $historyAuction->execute();
    $results = $historyAuction->fetchAll();
    echo "<h3 class=\"historyTitle\">Enchere precedente:</h3>";
    $reversedResults = array_reverse($results);
    foreach($reversedResults as $result) { ?>
        <p class="historyAuction"><?php echo $result['new_auction']?>€, le <?php echo $result['date_auction']?> par <?php echo $result['firstname']?>.</p>
    <?php }
 echo  "</div>";
echo "</div>";
$content = ob_get_clean();
require_once("navigation.php");