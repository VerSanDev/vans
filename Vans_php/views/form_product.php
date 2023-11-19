<section class="productContainer">
<?php

$dateActuelle = date("Y-m-d");
?>
    <form class="form-floating productForm" action="product.php" method="post" name="product">
        <h1 class="box-title productTitle">Que voulez-vous vendre ?</h1>
        <div class="form-floating mb-3 formProduct1">
            <input type="text" class="form-control transparent-input productTitleInput" name="title" placeholder="name@example.com" required>
            <label>Titre de l'annonce</label>
        </div>
        <div class="boxProduct">
            <div class="formProduct2">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control transparent-input productInput" name="mark" placeholder="Marque"  required>
                    <label>Marque</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control transparent-input productInput" name="model" placeholder="Modele"  required>
                    <label>Modele</label>
                </div>
            </div>
            <div class="formProduct3">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control transparent-input productInput" name="power" placeholder="Puissance (CH)"  required>
                    <label>Puissance (CH)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control transparent-input productInput" name="year" placeholder="Annee"  required>
                    <label>Annee</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3 formProduct4">
            <textarea type="text" class="form-control transparent-input productTextarea" name="description" rows="20" placeholder="Description"  required></textarea>
            <label>Description</label>
        </div>
        <div class="formProduct5">
            <div class="form-floating mb-3">
                <input type="number" class="form-control transparent-input productInput" name="starting_price" placeholder="Prix de départ"  required>
                <label>Prix de départ</label>
            </div>
            <div class="form-floating">
                <input type="date" class="form-control transparent-input productInput"  min="<?php echo $dateActuelle; ?>" name="end_date" placeholder="Date de fin de l'enchère"  required>
                <label>Date de fin de l'enchère</label>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Poster l'annonce" name="submit" class="btn btn-login btn-warning">
        </div>
    </form>
</section>


