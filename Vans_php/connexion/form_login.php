<section class="connexionContainer">
    <form class="form-floating loginContainer" action="login.php" method="post" name="login">
        <h1 class="box-title connexionTitle">Connexion</h1>
        <div class="form-floating mb-3">
            <input type="email" class="form-control transparent-input connexionInput" name="email" placeholder="name@example.com">
            <label>Adresse email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control transparent-input connexionInput" name="password" placeholder="Password">
            <label>Mot de passe</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Connexion" name="submit" class="btn btn-login btn-warning">
        </div>
        <div class="form-group">
            <p class="box-register">Vous êtes nouveau ici ? <a href="register.php">S'inscrire</a></p>
        </div>
    </form>
</section>
