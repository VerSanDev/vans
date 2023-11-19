<section class="connexionContainer">
    <form class="form-floating registerContainer" action="register.php" method="post" name="register">
        <h1 class="box-title connexionTitle">Inscription</h1>
        <div class="form-floating mb-3">
            <input type="text" class="form-control transparent-input connexionInput" name="lastname" placeholder="Lastname" required>
            <label>Nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control transparent-input connexionInput" name="firstname" placeholder="Firstname" required>
            <label>Prenom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control transparent-input connexionInput" name="email" placeholder="name@example.com" required>
            <label>Adresse email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control transparent-input connexionInput" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+]).{12,}" required>
            <label>Mot de passe</label>
            <p class="textPassword">*Au moins 12 caractères, un chiffre, une lettre majuscule, une minuscule et un caractère parmi !@#$%^&*_=+.</p>
        </div>
        <div class="form-group">
            <input type="submit" value="Valider" name="submit" class="btn btn-register btn-warning">
        </div>
        <div class="form-group">
        <p class="box-register">Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
        </div>
    </form>
</section>