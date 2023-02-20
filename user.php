<?php

class User {

    // ATTRIBUTS

    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    public $bdd;

    // CONSTRUCTEUR

    public function __construct() {

        $this->bdd = mysqli_connect("localhost", "root", "", "classes");
        if (!$this->bdd) {
            die("Impossible de se connecter");
        } else {
            echo "Vous êtes connecté à la Base de Données.";
        }

    }

    // METHODES

    public function register($login, $password, $email, $firstname, $lastname) {

        if($login != '' && $password != '' && $email != '' && $firstname != '' && $lastname != '') {

            $password = sha1($password);
            $insert = mysqli_query($this->bdd, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')");
            $request = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
            $result = $request->fetch_array(MYSQLI_ASSOC);

        }

    }

    public function connect($login, $password) {

        if($login != '' && $password != '') {

            $requestConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '$login' and password = '$password'");
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            echo "Vous êtes connecté ". $_SESSION['login'];

        }
    }

    public function disconnect() {

        session_destroy();

    }

    public function delete() {

        // $this->bdd("DELETE FROM utilisateurs where 'login' = $_SESSION['login']");
        // session_destroy();

    }

    public function update($login, $password, $email, $firstname, $lastname) {

    }

    public function isConnected() {

        // return

    }

    public function getAllInfos() {

        // return

    }

    public function getLogin() {

        return $this->login;
    }

    public function getEmail() {

        return $this->email;
    }

    public function getFirstname() {

        return $this->firstname;

    }

    public function getLastname() {

        return $this->lastname;
    }

}


$testUser = new User();

$testUser->register('test', 'test', 'test', 'test', 'test');

echo $testUser->connect('test','test');

echo $testUser->getFirstname();