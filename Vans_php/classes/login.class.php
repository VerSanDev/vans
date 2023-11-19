<?php

class Login {

    private string $email;
    private string $password;

    public function __construt ($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function __get ($property) {
        if ($property === "email") {
            return $this->email;
        } else if ($property === "password") {
            return $this->password;
        } else {
            return $this->$property;
        }
    }

    public function verification () {
        require __DIR__."/../dataBase.php";
        $query = $dbh->prepare("SELECT * FROM `user`");
        $query->execute();
        $results = $query->fetchAll();
        session_start();
        if (isset($_POST['email']) && isset($_POST['password'])) {
            foreach ($results as $result) {
                if ($result['email'] === $_POST['email'] && password_verify($_POST['password'], $result['password']) ) {
                    $loggedUser = ['email' => $result['email'],];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['id'] = $result['id_user'];
                } else {
                    $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier');
                }
            }
        }
        if(!isset($loggedUser)){
            if(isset($errorMessage)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
        <?php };
        } else { ?>
            <div class="alert alert-success" role="alert">
            Bonjour <?php echo $loggedUser['email']; ?> et bienvenue sur le site !
            </div>
            <?php header("refresh: 2, url=../index.php");
        };
        }
}
?>