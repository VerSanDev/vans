<?php

class Register {

    private string $lastname;
    private string $firstname;
    private string $email;
    private string $password;

    public function __construct ($lastname, $firstname, $email, $password) {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    public function __get ($property) {
        if ($property === "lastname") {
            return $this->lastname;
        } else if ($property === "firstname") {
            return $this->firstname;
        } else if ($property === "email") {
            return $this->email;
        } else if ($property === "password") {
            return $this->password;
        } else {
            return $this->$property;
        }
    }

    public function save () {
        require __DIR__."/../dataBase.php";
        $stmt = $dbh->prepare("SELECT * FROM user WHERE email=?");
        $stmt->execute([$this->email]); 
        $user = $stmt->fetch();
        if ($user) { ?>
            <div class="alert alert-danger" role="alert">
                L'adresse mail selectionnée est deja utilisée.
            </div>
        <?php } else {
            $query = $dbh->prepare("INSERT INTO `user` (lastname, firstname, email, password) VALUES (:lastname, :firstname, :email, :password)");
            $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $query->bindValue(':email', $this->email, PDO::PARAM_STR);
            $query->bindValue(':password', $this->password, PDO::PARAM_STR);
            $results = $query->execute();
            if($results){ ?>
                <div class="alert alert-success" role="alert">
                    Vous êtes inscrit avec succès.
                </div>
                <?php header("refresh: 2, url=login.php");
            };
        }
    }
}