<?php

class Profil {

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

    public function update () {
        $id = $_SESSION['id'];
        require __DIR__."/../dataBase.php";
        $query = $dbh->prepare("UPDATE `user` SET lastname=:lastname, firstname=:firstname, email=:email, password=:password WHERE id_user=$id");
        $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindValue(':email', $this->email, PDO::PARAM_STR);
        $query->bindValue(':password', $this->password, PDO::PARAM_STR);
        $results = $query->execute();
        if($results){ ?>
            <div class="alert alert-success" role="alert">
                Vos modifications ont bien été prise en compte.
            </div>
        <?php };
    }

}